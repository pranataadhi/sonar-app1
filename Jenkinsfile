pipeline {
  agent any

  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
    timestamps()
  }

  tools {
    sonarScanner 'SonarScanner' // Nama harus sama seperti di Global Tool Configuration Jenkins
  }

  stages {
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
