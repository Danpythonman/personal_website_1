pipeline {
    agent any

    environment {
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

        stage('Confirm Nginx is running') {
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

        stage('Confirm Jenkins has necessary permissions') {
            steps {
                script {
                    withCredentials([
                        string(credentialsId: 'NGINX_SITE_CONFIG_PATH', variable: 'NGINX_SITE_CONFIG_PATH')
                    ]) {
                        try {
                            // This command replaces nothing (the pattern
                            // '__permission_test__' should not exist in the
                            // config file), so it just opens the file for
                            // writing to make sure it has the permission to do
                            // so later.
                            sh '''
                                sudo sed -i 's/__permission_test__/__permission_test__/' "$NGINX_SITE_CONFIG_PATH"
                            '''
                        } catch (err) {
                            error 'Jenkins does not have write permissions to write to the Nginx config path'
                        }
                    }

                    try {
                        sh '''
                            sudo nginx -t
                            sudo nginx -s reload
                        '''
                    } catch (err) {
                        error 'Jenkins does not have permissions to reload Nginx'
                    }
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

        stage('Generate image and container names') {
            steps {
                script {
                    env.IMAGE_NAME = "${env.BASE_IMAGE_NAME}:${env.BUILD_NUMBER}"
                    env.CONTAINER_NAME = "${env.BASE_CONTAINER_NAME}-${env.BUILD_NUMBER}-${env.COLOR}"

                    echo "Using image name $IMAGE_NAME and container name $CONTAINER_NAME"
                }
            }
        }

        stage('Prepare files') {
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

        stage('Build image') {
            steps {
                echo "Building image $IMAGE_NAME"

                sh '''
                    docker build -t $IMAGE_NAME .
                '''

                sleep time: 5, unit: 'SECONDS'
            }
        }

        stage('Start PHP server in Docker container') {
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
                            -p $PORT_TO_USE:80 \
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
                            --label com.danieldigiovanni.personal_website.app=personal-website \
                            --restart=unless-stopped \
                            $IMAGE_NAME
                    '''
                }

                sleep time: 5, unit: 'SECONDS'
            }
        }

        stage('Health check') {
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
                    try {
                        withCredentials([
                            string(credentialsId: 'NGINX_SITE_CONFIG_PATH', variable: 'NGINX_SITE_CONFIG_PATH')
                        ]) {
                            sh '''
                                sudo sed -i "s/server 127\\.0\\.0\\.1:[0-9]\\+/server 127.0.0.1:$PORT_TO_USE/" $NGINX_SITE_CONFIG_PATH
                                sudo nginx -t
                                sudo nginx -s reload
                            '''
                        }
                    } catch (err) {
                        echo "Rerouting reverse proxy failed, stopping container: ${env.CONTAINER_NAME}"
                        sh 'docker stop $CONTAINER_NAME || true'
                        error 'Rerouting reverse proxy failed'
                    }
                }
            }
        }

        stage('Stop other container and set new container as active') {
            steps {
                script {
                    sh '''
                        old_container_id=$( \
                            docker ps -q \
                                --filter "label=com.danieldigiovanni.personal_website.app=personal-website" \
                            | grep -v "$CONTAINER_NAME" \
                            | head -n 1 \
                        )

                        if [ -n "$old_container_id" ]; then
                            echo "Stopping old container: $old_container_id"
                            docker stop $old_container_id
                        else
                            echo 'No existing container to stop'
                        fi
                    '''
                }
            }
        }
    }
}
