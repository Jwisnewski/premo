#!/bin/bash
set -x

docker exec -t premo-fpm ash -c 'cd /site && ./vendor/bin/kahlan --cc=true'