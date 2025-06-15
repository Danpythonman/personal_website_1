pipeline {
    agent any

    environment {
        DB_CONTAINER = 'mariadb-jenkins'
        BASE_IMAGE_NAME = 'personal-website-image'
        BASE_CONTAINER_NAME = 'personal-website'
        NETWORK_NAME = 'personal-website-network-jenkins'
        ACTIVE_CONTAINER_FILENAME = '/var/personal_website/active_container.txt'
        BLUE_PORT = 9001
        GREEN_PORT = 9002
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Confirm Nginx is Running') {
            steps {
                script {
                    withCredentials([
                        string(credentialsId: 'NGINX_SITE_CONFIG_PATH', variable: 'NGINX_SITE_CONFIG_PATH')
                    ]) {
                        def configExists = sh(
                            script: '[ -f "$NGINX_SITE_CONFIG_PATH" ] && echo yes || echo no',
                            returnStdout: true
                        ).trim()

                        if (configExists != 'yes') {
                            error "Nginx config file not found at: $NGINX_SITE_CONFIG_PATH"
                        }
                    }

                    def nginxRunning = sh(
                        script: "pgrep -x nginx > /dev/null && echo yes || echo no",
                        returnStdout: true
                    ).trim()

                    if (nginxRunning != 'yes') {
                        error 'Nginx is not running on the host system'
                    }

                    echo 'Nginx is running and the config file is present.'
                }
            }
        }

        stage('Check if we are blue or green') {
            steps {
                script {
                    def bluePortOutput = sh(script: "ss -tuln | grep :${env.BLUE_PORT} || true", returnStdout: true).trim()
                    def greenPortOutput = sh(script: "ss -tuln | grep :${env.GREEN_PORT} || true", returnStdout: true).trim()

                    if (bluePortOutput && greenPortOutput) {
                        error 'Both blue and green ports are in used, cannot deploy'
                    } else if (bluePortOutput) {
                        echo 'Blue port is in use, we are green'
                        env.COLOR = 'green'
                        env.OTHER_COLOR = 'blue'
                        env.PORT_TO_USE = env.GREEN_PORT
                    } else if (greenPortOutput) {
                        echo 'Green port is in use, we are blue'
                        env.COLOR = 'blue'
                        env.OTHER_COLOR = 'green'
                        env.PORT_TO_USE = env.BLUE_PORT
                    } else  {
                        echo 'Neither blue or green ports are in use, defaulting to blue'
                        env.COLOR = 'blue'
                        env.OTHER_COLOR = 'green'
                        env.PORT_TO_USE = env.BLUE_PORT
                    }
                }
            }
        }

        stage('Generate Image and Container Names') {
            steps {
                script {
                    env.IMAGE_NAME = "${env.BASE_IMAGE_NAME}:${env.BUILD_NUMBER}"
                    env.CONTAINER_NAME = "${env.BASE_CONTAINER_NAME}-${env.BUILD_NUMBER}-${env.COLOR}"

                    echo "Using image name $IMAGE_NAME and container name $CONTAINER_NAME"
                }
            }
        }

        stage('Prepare Files') {
            steps {
                echo 'Preparing env.example.php'

                sh '''
                    cp env.example.php env.php
                '''

                echo 'Preparing tag.php'

                withCredentials([file(credentialsId: 'GTAG', variable: 'GTAG')]) {
                    script {
                        def gtagContent = readFile(file: GTAG)
                        writeFile(file: 'tag.php', text: gtagContent)
                    }
                }
            }
        }

        stage('Build Image') {
            steps {
                echo "Building image $IMAGE_NAME"

                sh '''
                    docker build -t $IMAGE_NAME .
                '''

                sleep time: 5, unit: 'SECONDS'
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
                            -p $PORT_TO_USE:80 \
                            -e BASE_URL_DIRECTORY=$BASE_URL_DIRECTORY \
                            -e ENVIRONMENT=$ENVIRONMENT \
                            -e CDN_URL=$CDN_URL \
                            -e DISPLAY_ERRORS=$DISPLAY_ERRORS \
                            -e DB_SERVER=$DB_CONTAINER \
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
                            --restart=unless-stopped \
                            $IMAGE_NAME
                    '''
                }

                sleep time: 5, unit: 'SECONDS'
            }
        }

        stage('Health Check') {
            steps {
                script {
                    try {
                        sh '''
                            curl -f http://localhost:$PORT_TO_USE --max-time 5
                        '''
                        echo 'Health check passed'
                    } catch (err) {
                        echo "Health check failed, stopping container: ${env.CONTAINER_NAME}"
                        sh 'docker stop $CONTAINER_NAME || true'
                        error 'Health check failed'
                    }
                }
            }
        }

        stage('Reroute reverse proxy') {
            steps {
                script {
                    withCredentials([
                        string(credentialsId: 'NGINX_SITE_CONFIG_PATH', variable: 'NGINX_SITE_CONFIG_PATH')
                    ]) {
                        sh '''
                            sed -i "s/server 127\\.0\\.0\\.1:[0-9]\\+/server 127.0.0.1:$PORT_TO_USE/" $NGINX_SITE_CONFIG_PATH
                            nginx -t && nginx -s reload
                        '''
                    }
                }
            }
        }

        stage('Stop other container') {
            steps {
                script {
                    def exists = sh(script: '[ -f "$ACTIVE_CONTAINER_FILENAME" ] && echo yes || echo no', returnStdout: true).trim()
                    if (exists == 'yes') {
                        env.CONTAINER_TO_DESTROY = sh(script: 'cat "$ACTIVE_CONTAINER_FILENAME"', returnStdout: true).trim()

                        sh '''
                            docker stop $CONTAINER_TO_DESTROY || true
                        '''
                    }

                    sh '''
                        echo $CONTAINER_TO_DESTROY > "$ACTIVE_CONTAINER_FILENAME"
                    '''
                }
            }
        }
    }
}
