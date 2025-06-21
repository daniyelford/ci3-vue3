set vue3/.env
in vue3 terminal set
npm run build
npm install @kyvg/vue3-notification

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

