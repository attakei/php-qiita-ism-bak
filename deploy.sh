#!/bin/sh
echo $DOKKU_DEPLOY_KEY >> ~/.ssh/dokku_deploy_key
chmod 400 ~/.ssh/dokku_deploy_key
cat << EOS >> ~/.ssh/config

Host lab.attakei.net
    IdentityFile ~/.ssh/dokku_deploy_key
EOS

git remote add dokku dokku@lab.attakei.net:qiita
git push dokku master
