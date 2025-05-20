pipeline {
    agent any

    environment {
        DB_CONTAINER = 'mariadb-jenkins'
        IMAGE_NAME = 'personal-website-image'
        BASE_CONTAINER_NAME = 'personal-website'
        NETWORK_NAME = 'personal-website-network-jenkins'
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

        stage('Prepare Docker Environment') {
            steps {
                script {
                    def shortGitCommit = sh(script: "git rev-parse --short HEAD", returnStdout: true).trim()
                    env.IMAGE_TAG = "jenkins-${shortGitCommit}"
                    env.CONTAINER_NAME = "$BASE_CONTAINER_NAME-$IMAGE_TAG"
                }

                echo 'Saving logs from containers $DB_CONTAINER and $CONTAINER_NAME'

                sh '''
                    mkdir -p logs
                    docker logs $DB_CONTAINER > logs/$DB_CONTAINER.log 2>&1 || true
                    docker logs $CONTAINER_NAME > logs/$CONTAINER_NAME.log 2>&1 || true
                '''

                echo 'Stopping and removing containers $DB_CONTAINER and $CONTAINER_NAME'

                sh '''
                    docker stop $DB_CONTAINER || true
                    docker rm $DB_CONTAINER || true
                    docker stop $CONTAINER_NAME || true
                    docker rm $CONTAINER_NAME || true
                '''

                echo 'Creating Docker network $NETWORK_NAME'

                sh 'docker network create $NETWORK_NAME || true'
            }
        }

        stage('Build Image') {
            steps {
                echo 'Building image $IMAGE_NAME:$IMAGE_TAG'

                sh '''
                    docker build -t $IMAGE_NAME:$IMAGE_TAG .
                '''

                sleep time: 5, unit: 'SECONDS'
            }
        }

        stage('Start Database') {
            steps {
                withCredentials([
                    string(credentialsId: 'DB_SERVER', variable: 'DB_SERVER'),
                    string(credentialsId: 'DB_USER', variable: 'DB_USER'),
                    string(credentialsId: 'DB_PASSWORD', variable: 'DB_PASSWORD'),
                    string(credentialsId: 'DB_NAME', variable: 'DB_NAME'),
                    string(credentialsId: 'DB_PORT', variable: 'DB_PORT')
                ]) {
                    sh '''
                        docker pull mariadb
                        docker run \
                            -d \
                            --name $DB_CONTAINER \
                            --network $NETWORK_NAME \
                            -e MARIADB_ROOT_PASSWORD=$DB_PASSWORD \
                            -e MARIADB_DATABASE=$DB_NAME \
                            -e MARIADB_USER=$DB_USER \
                            -e MARIADB_PASSWORD=$DB_PASSWORD \
                            -p $DB_PORT:3306 \
                            mariadb
                    '''
                }

                sleep time: 10, unit: 'SECONDS'
            }
        }

        stage('Initialize Database Schema') {
            steps {
                withCredentials([
                    string(credentialsId: 'DB_USER', variable: 'DB_USER'),
                    string(credentialsId: 'DB_PASSWORD', variable: 'DB_PASSWORD'),
                    string(credentialsId: 'DB_NAME', variable: 'DB_NAME')
                ]) {
                    sh '''
                        docker cp database/schema.sql $DB_CONTAINER:/schema.sql
                        docker exec -i $DB_CONTAINER mariadb -u$DB_USER -p$DB_PASSWORD $DB_NAME < database/schema.sql
                    '''
                }
            }
        }

        stage('Start PHP Server in Docker Container') {
            steps {
                echo "Running container $CONTAINER_NAME"

                withCredentials([
                    string(credentialsId: 'BASE_URL_DIRECTORY', variable: 'BASE_URL_DIRECTORY'),
                    string(credentialsId: 'ENVIRONMENT', variable: 'ENVIRONMENT'),
                    string(credentialsId: 'CDN_URL', variable: 'CDN_URL'),
                    string(credentialsId: 'DISPLAY_ERRORS', variable: 'DISPLAY_ERRORS'),
                    string(credentialsId: 'DB_SERVER', variable: 'DB_SERVER'),
                    string(credentialsId: 'DB_USER', variable: 'DB_USER'),
                    string(credentialsId: 'DB_PASSWORD', variable: 'DB_PASSWORD'),
                    string(credentialsId: 'DB_NAME', variable: 'DB_NAME'),
                    string(credentialsId: 'DB_PORT', variable: 'DB_PORT'),
                    string(credentialsId: 'WEB3FORMS_ACCESS_KEY', variable: 'WEB3FORMS_ACCESS_KEY'),
                    string(credentialsId: 'STYLE_VERSION', variable: 'STYLE_VERSION'),
                    string(credentialsId: 'OPEN_MENU_VERSION', variable: 'OPEN_MENU_VERSION'),
                    string(credentialsId: 'HOMEPAGE_SCROLL_PROMPT_VERSION', variable: 'HOMEPAGE_SCROLL_PROMPT_VERSION'),
                    string(credentialsId: 'OPEN_PROJECT_IMAGE_MODAL_VERSION', variable: 'OPEN_PROJECT_IMAGE_MODAL_VERSION'),
                    string(credentialsId: 'SCROLL_PROJECT_IMAGE_GALLERY_VERSION', variable: 'SCROLL_PROJECT_IMAGE_GALLERY_VERSION')
                ]) {
                    sh '''
                        docker run \
                            -d \
                            --name $CONTAINER_NAME \
                            --network $NETWORK_NAME \
                            -p 8080:80 \
                            -e BASE_URL_DIRECTORY=$BASE_URL_DIRECTORY \
                            -e ENVIRONMENT=$ENVIRONMENT \
                            -e CDN_URL=$CDN_URL \
                            -e DISPLAY_ERRORS=$DISPLAY_ERRORS \
                            -e DB_SERVER=$DB_SERVER \
                            -e DB_USER=$DB_USER \
                            -e DB_PASSWORD=$DB_PASSWORD \
                            -e DB_NAME=$DB_NAME \
                            -e DB_PORT=$DB_PORT \
                            -e WEB3FORMS_ACCESS_KEY=$WEB3FORMS_ACCESS_KEY \
                            -e STYLE_VERSION=$STYLE_VERSION \
                            -e OPEN_MENU_VERSION=$OPEN_MENU_VERSION \
                            -e HOMEPAGE_SCROLL_PROMPT_VERSION=$HOMEPAGE_SCROLL_PROMPT_VERSION \
                            -e OPEN_PROJECT_IMAGE_MODAL_VERSION=$OPEN_PROJECT_IMAGE_MODAL_VERSION \
                            -e SCROLL_PROJECT_IMAGE_GALLERY_VERSION=$SCROLL_PROJECT_IMAGE_GALLERY_VERSION \
                            $IMAGE_NAME:$IMAGE_TAG
                    '''
                }

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
