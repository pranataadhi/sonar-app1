pipeline {
  agent any

  stages {
    stage('Install Composer') {
      steps {
        sh '''
          which composer || (
            apt update && apt install -y curl php-cli unzip git
            curl -sS https://getcomposer.org/installer | php
            mv composer.phar /usr/local/bin/composer
          )
          composer --version
        '''
      }
    }

    stage('Install Dependencies') {
      steps {
        sh 'composer install'
      }
    }

    stage('Static Analysis - SonarQube') {
      environment {
        SONAR_USER_HOME = "${env.WORKSPACE}/.sonar"
      }
      steps {
        withSonarQubeEnv('Sonarqube') {
          sh 'sonar-scanner'
        }
      }
    }
  }
}
