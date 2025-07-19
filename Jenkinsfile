pipeline {
  agent any
  stages {
    stage('Install') {
      steps {
        sh 'composer install'
      }
    }
    stage('SAST with SonarQube') {
      environment {
        SONAR_USER_HOME = "${env.WORKSPACE}/.sonar"
        scannerHome = tool 'SonarScanner'
      }
      steps {
        withSonarQubeEnv('SonarQube') {
          sh "${scannerHome}/bin/sonar-scanner"
        }
      }
    }
  }
}
