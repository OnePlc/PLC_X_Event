#!/bin/bash

DIR="/var/www/plc"

echo "${DIR}/vendor/oneplace/oneplace-event/public/ ${DIR}/public/vendor/oneplace-event"
ln -s "${DIR}/public/vendor/@fullcalendar/" "${DIR}/vendor/oneplace/oneplace-event/public/lib/@fullcalendar"
ln -s "${DIR}/vendor/oneplace/oneplace-event/public/" "${DIR}/public/vendor/oneplace-event"

cd "${DIR}"
yarn add bootstrap-colorpicker