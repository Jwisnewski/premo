#!/usr/bin/env bash
set -x

CMD='cd /site && ./vendor/bin/kahlan --cc=true --reporter=verbose --coverage=4'
docker exec -t premo-fpm ash -c "$CMD"
