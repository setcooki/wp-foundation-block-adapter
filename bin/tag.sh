#!/usr/bin/env bash

DIR="$( cd "$( dirname "$0" )" && pwd )"
BASE_DIR="$(dirname "$DIR")"

V="$1"
M="$2"

if [ $# -lt 1 ]
then
    echo "Usage: $0 (version number as x.x.x)"
    exit 1
fi;

gulp build --prod

git tag -a v$V -m "Version $V $M"
git push --tags
sh $DIR/version.sh
composer update
grunt dist
sleep 5
git commit -a -m "bump $V"
git push
