pipeline {
         agent any
         options {
             buildDiscarder(logRotator(artifactNumToKeepStr: '10'))
         }
         stages {
             stage ('BuildPMMP') {
                steps {
                    sh 'chmod +x scripts/build-pmmp.sh'
                    sh 'scripts/build-pmmp.sh'
                }
                 post {
                      success {
                          archiveArtifacts artifacts: 'RestartMe.phar', fingerprint: true
                      }
                  }
             }
         }
         post {
             always {
                 deleteDir()
                 discordSend(webhookURL: "https://discordapp.com/api/webhooks/711941575193919628/nT1VCvEftD_1KWdsOeOS1mYOBfB6bGepfGkahXYGWO8ijdY3YpcU17C-at9UGt-zbMbQ", description: "**Build:** ${env.BUILD_NUMBER}\n**Status:** Success\n\n**Changes:**\n${env.BUILD_URL}", footer: "Fallentech Build System", link: "${env.BUILD_URL}", successful: true, title: "Build Success: RestartMe", unstable: false, result: "SUCCESS")
             }
         }
     }