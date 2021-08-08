#!/bin/sh

mkdir build libs
cp -r src resources plugin.yml build/

#Download pmp libs
wget -q -O php_libs.tar.gz https://jenkins.pmmp.io/job/PHP-7.4-Aggregate/lastSuccessfulBuild/artifact/PHP-7.4-Linux-x86_64.tar.gz
tar -xf php_libs.tar.gz -C libs/

#Download and make executalbe build script
wget -q -O BuildScript.php https://gist.githubusercontent.com/Alemiz112/189c16ee19aa6a7c1e4238ace2eff7a9/raw/aa78f374bf7c2620a5d96a15b6a355d3ef1bf11e/pmmp-devtools
chmod +x BuildScript.php

#Build phar
libs/bin/php7/bin/php -dphar.readonly=0 BuildScript.php --make build --out RestartMe.phar
