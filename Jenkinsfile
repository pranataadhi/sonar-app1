pipeline {
  agent {
    docker {
      image 'php:8.2'
      args '-u root:root'
    }
  }

  stages {
    stage('Install Composer') {
      steps {
        sh '''
          apt-get update && apt-get install -y unzip curl git
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
          sh 'sonar-scanner'
        }
      }
    }
  }
}
