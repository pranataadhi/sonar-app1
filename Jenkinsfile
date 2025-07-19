pipeline {
  agent {
    docker {
      image 'php:8.2'
      args '-u root:root'
    }
  }

  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
    timestamps()
  }

  tools {
    sonarScanner 'SonarScanner'
  }

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

    stage('Static Code Analysis (SAST)') {
      environment {
        SONAR_USER_HOME = "${env.WORKSPACE}/.sonar"
      }
      steps {
        withSonarQubeEnv('SonarQube') {
          sh "${tool 'SonarScanner'}/bin/sonar-scanner"
        }
      }
    }
  }
}
