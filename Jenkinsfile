pipeline {
  agent any

  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
    timestamps()
  }

  tools {
    sonarScanner 'SonarScanner' // Sesuai nama di Global Tool Configuration
  }

  stages {
    stage('Install') {
      steps {
        sh 'composer install'
      }
    }

    stage('SAST with SonarQube') {
      environment {
        SONAR_USER_HOME = "${env.WORKSPACE}/.sonar"
      }
      steps {
        withSonarQubeEnv('Sonarqube') {
          sh "${tool 'SonarScanner'}/bin/sonar-scanner"
        }
      }
    }
  }
}
