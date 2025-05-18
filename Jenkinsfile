pipeline {
    agent any

    environment {
        DB_CONTAINER = 'my-mariadb'
        PHP_CONTAINER = 'php-site'
        IMAGE_NAME = 'php-site-img'
        COMPOSE_CMD = 'docker compose'
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

        stage('Start PHP Server') {
            steps {
                sh "$COMPOSE_CMD up -d --build"
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
            sh '''
                docker stop $DB_CONTAINER || true
                docker rm $DB_CONTAINER || true
                docker compose down || true
            '''
        }
    }
}
