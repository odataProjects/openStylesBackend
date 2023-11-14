pipeline {
  agent 'php-agent'

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

          //sh 'npm run build'
          sh 'composer install'

          sh 'php artisan key:generate'
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
