pipeline {
    agent any

    environment {
        DB_CONTAINER = 'my-mariadb-jenkins'
        IMAGE_NAME = 'personal-website-image'
        BASE_CONTAINER_NAME = 'personal-website'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Prepare Files') {
            steps {
                sh '''
                    cp env.example.php env.php
                    cp tag.example.php tag.php
                '''
            }
        }

        stage('Build Image') {
            steps {
                script {
                    def shortGitCommit = sh(script: "git rev-parse --short HEAD", returnStdout: true).trim()
                    env.IMAGE_TAG = "jenkins-${shortGitCommit}"
                    env.CONTAINER_NAME = "$BASE_CONTAINER_NAME-$IMAGE_TAG"
                }

                echo "Using image $IMAGE_NAME:$IMAGE_TAG and container name $CONTAINER_NAME"

                sh '''
                    docker build -t $IMAGE_NAME:$IMAGE_TAG .
                '''

                sleep time: 5, unit: 'SECONDS'
            }
        }

        stage('Start Database') {
            steps {
                sh '''
                    docker pull mariadb
                    docker run --name $DB_CONTAINER \
                        -e MARIADB_ROOT_PASSWORD=my-secret-pw \
                        -e MARIADB_DATABASE=mydb \
                        -e MARIADB_USER=myuser \
                        -e MARIADB_PASSWORD=mypassword \
                        -p 3306:3306 -d mariadb
                '''

                sleep time: 10, unit: 'SECONDS'
            }
        }

        stage('Initialize Database Schema') {
            steps {
                sh '''
                    docker cp database/schema.sql $DB_CONTAINER:/schema.sql
                    docker exec -i $DB_CONTAINER mariadb -umyuser -pmypassword mydb < database/schema.sql
                '''
            }
        }

        stage('Start PHP Server in Docker Container') {
            steps {
                echo "Ensuring $CONTAINER_NAME does not conflict with other containers"

                sh '''
                    mkdir -p logs
                    docker logs $CONTAINER_NAME > logs/$CONTAINER_NAME.log || true
                    docker stop $CONTAINER_NAME || true
                    docker rm $CONTAINER_NAME || true
                '''

                echo "Running container $CONTAINER_NAME"

                sh '''
                    docker run -d --name $CONTAINER_NAME -p 8080:80 $IMAGE_NAME:$IMAGE_TAG
                '''

                sleep time: 5, unit: 'SECONDS'
            }
        }

        stage('Health Check') {
            steps {
                sh "curl -f http://localhost:8080 || (echo 'Health check failed!' && exit 1)"
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: 'logs/*.log', allowEmptyArchive: true
        }

        failure {
            sh '''
                docker stop $DB_CONTAINER || true
                docker stop $CONTAINER_NAME || true
            '''
        }
    }
}
