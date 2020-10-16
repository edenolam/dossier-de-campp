#!/bin/bash

set -e
set -x

export USER_ID=$(id -u)
export USER_GID=$(id -g)

cd "$(dirname "$0")"

docker-compose down --volume

if [[ "$1" == "--clean" ]]; then
  sudo rm -rf data ../api-server/var
fi

mkdir -p ~/.yarn ~/.cache/yarn
mkdir -p data/.symfony
[[ -f ~/.yarnrc ]] || touch ~/.yarnrc

docker-compose up --build