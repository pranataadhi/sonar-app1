pipeline {
  agent any

  stages {
    stage('Install Composer') {
      steps {
        sh '''
          curl -sS https://getcomposer.org/installer | php
          mv composer.phar /usr/local/bin/composer
          composer --version
        '''
      }
    }

    stage('Install Dependencies') {
      steps {
        sh 'composer install'
      }
    }

    stage('SAST with SonarQube') {
      environment {
        SONAR_USER_HOME = "${env.WORKSPACE}/.sonar"
      }
      steps {
        withSonarQubeEnv('SonarQube') {
          sh 'sonar-scanner'  // Tidak perlu define tools di atas
        }
      }
    }
  }
}
