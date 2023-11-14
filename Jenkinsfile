pipeline {
    agent { label 'php-agent' }

    stages {
        stage('Git') {
            steps {
                // Clone the repository into a specific directory
                git url: 'https://github.com/odataProjects/openStylesBackend', branch: 'main'
            }
        }

        stage('Build & Test') {
            steps {
                script {
                    // Install dependencies
                    sh 'npm install'
                    sh 'composer install'
                    sh 'cp .env.server .env'
                    sh 'php artisan key:generate'

                    // Stash the files to be copied to the master
                    stash includes: '**/*', name: 'openStylesBackend'
                }
            }
        }

        stage('Copy to Master') {
            steps {
                // Unstash the files on the master
                script {
                    dir('/var/lib/jenkins/workspace/openStylesBackend/') {
                        unstash 'openStylesBackend'

                        // List the contents of the unstashed directory for debugging
                        sh 'ls -al'
                    }
                }
            }
        }

        stage('Deploy') {
            steps {
                script {
                    sh 'ansible-playbook -i inventory.ini playbook.yml'
                }
            }
        }
    }

    post {
        success {
            emailext body: 'The pipeline succeeded. Here is the link to the build: https://[odataPort].serveo.net',
                     subject: 'Pipeline Success',
                     to: 'kelysaina@gmail.com',
                     from: 'nalyvalisoa0510@gmail.com'
        }
        failure {
            emailext body: 'The pipeline failed. Please check the Jenkins console output for details: https://jenkins_ks.serveo.net/job/$PROJECT_NAME/$BUILD_NUMBER/console',
                     subject: 'Pipeline Failure',
                     to: 'kelysaina@gmail.com',
                     from: 'nalyvalisoa0510@gmail.com'
        }
    }
}
