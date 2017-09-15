#!/bin/bash
set -x

./vendor/bin/phpcs --standard=PSR2 --ignore=*/vendor/* --report=json . | jq