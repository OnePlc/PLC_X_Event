#!/bin/bash

DIR=$1
if [ "${DIR}" == "" ]; then
  echo "Please specify plc docroot (e.G /var/www/plc)"
  exit
fi

apt install unzip

if [ ! -d "${DIR}/vendor/oneplace/oneplace-event/public/lib" ]; then
  mkdir "${DIR}/vendor/oneplace/oneplace-event/public/lib"
  mkdir "${DIR}/vendor/oneplace/oneplace-event/public/lib/@fullcalendar"
  cd "${DIR}/vendor/oneplace/oneplace-event/public/lib/@fullcalendar"
  wget "https://github.com/fullcalendar/fullcalendar/releases/download/v5.6.0/fullcalendar-5.6.0.zip"
  unzip fullcalendar-5.6.0.zip
  mv lib/* .
  rm -rf lib/
fi

ln -s "${DIR}/vendor/oneplace/oneplace-event/public/" "${DIR}/public/vendor/oneplace-event"
echo "Please add this softlink manually if it did not work"
echo "ln -s ${DIR}/vendor/oneplace/oneplace-event/public/ ${DIR}/public/vendor/oneplace-event"

cd "${DIR}"
yarn add bootstrap-colorpicker