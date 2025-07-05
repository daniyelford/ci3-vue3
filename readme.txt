set vue3/.env
in vue3 terminal set
npm run build
npm install vue3-persian-datetime-picker
npm config set registry https://registry.npmmirror.com/
npm install vue-multiselect
npm install leaflet
npm install pinia
npm install vue3-jalali-calendar moment-jalaali
// npm install lodash.isequal
npm install @capacitor/core @capacitor/cli
npx cap init
npm install @capacitor/android
npx cap add android
npm install @capacitor/ios
npx cap add ios
npm run build
npx cap copy
npx cap sync
npx cap open android
composer require --dev phpunit/phpunit ^10.3
composer config -g --unset repos.packagist
composer config -g repo.packagist composer https://repo.packagist.org
composer clear-cache
composer require --dev kenjis/ci-phpunit-test

php vendor/kenjis/ci-phpunit-test/install.php

./vendor/bin/phpunit --migrate-configuration