#!/usr/bin/env bash

DIR="$( cd "$( dirname "$0" )" && pwd )"
BASE_DIR="$(dirname "$DIR")"
PLUGIN='wp-foundation-block-adapter.php'
VERSION=$(echo $(git describe --tags) | sed -n 's/.*\([0-9]\.[0-9]\.[0-9]*\).*/\1/p')
VERSION_FILE="$BASE_DIR/VERSION"
COMPOSER_FILE="$BASE_DIR/composer.json"
PACKAGE_FILE="$BASE_DIR/package.json"

if test -r $VERSION_FILE
then
	  git describe --tags --long >$VERSION_FILE
else
    echo >&2 "unknown" >$VERSION_FILE
fi;

if test -r $PACKAGE_FILE ; then
    sed -i'' -e 's/\(\"version\"*\:*\).*$/\1 \"'"$VERSION"'\"\,/g' $PACKAGE_FILE
    rm -f $PACKAGE_FILE-e > /dev/null 2>&1
fi;

if test -r $COMPOSER_FILE ; then
    sed -i'' -e 's/\(\"version\"*\:*\).*$/\1 \"'"$VERSION"'\"\,/g' $COMPOSER_FILE
    rm -f $COMPOSER_FILE-e > /dev/null 2>&1
fi;

sed -i'' -e 's/\(Version\:*\).*$/\1 '$VERSION'/g' $PLUGIN
rm -f $PLUGIN-e

git add -f $VERSION_FILE
exit 0;
