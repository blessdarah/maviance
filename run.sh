#!/bin/bash
cd /myapp
composer install -o
vendor/bin/phpunit tests
