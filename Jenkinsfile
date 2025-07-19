pipeline {
  agent any

  stages {
    stage('Install Composer & PHP Extension') {
      steps {
        sh '''
          apt update
          apt install -y php-cli php-xml unzip curl git

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

    stage('Static Analysis - SonarQube') {
      environment {
        SONAR_USER_HOME = "${env.WORKSPACE}/.sonar"
      }
      steps {
        withSonarQubeEnv('SonarQube') {
          sh 'sonar-scanner'
        }
      }
    }
  }
}
