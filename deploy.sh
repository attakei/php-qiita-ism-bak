#!/bin/sh
eval `ssh-agent`

echo $DOKKU_DEPLOY_KEY >> ~/.ssh/dokku_deploy_key
chmod 400 ~/.ssh/dokku_deploy_key

cat << EOS >> ~/.ssh/config

Host lab.attakei.net
  User dokku
  Port 22
  IdentityFile ~/.ssh/dokku_deploy_key
  IdentitiesOnly no
  StrictHostKeyChecking no
  UserKnownHostsFile=/dev/null

EOS


git remote add dokku dokku@lab.attakei.net:qiita
git push dokku master
