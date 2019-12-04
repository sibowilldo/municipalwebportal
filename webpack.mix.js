const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

var vendors = 'resources/assets/vendors/';
var basePublicDir = 'public/assets/v614/';
var devAssetsDir = 'resources/assets/metronic_v614/';

mix .js('resources/js/app.js', 'public/js')
    .extract(['jquery', 'bootstrap', 'perfect-scrollbar', 'bootstrap-notify'])
    .sass('resources/assets/metronic_v614/sass/style.scss', basePublicDir + 'css')
    .styles(devAssetsDir+'plugins/custom/fullcalendar/fullcalendar.bundle.css',
            basePublicDir + 'plugins/custom/fullcalendar/fullcalendar.bundle.css')
    .styles(devAssetsDir+'plugins/global/plugins.bundle.css', basePublicDir + 'plugins/global/plugins.bundle.css')
    .styles(devAssetsDir+'css/skins/header/base/light.css', basePublicDir + 'css/skins/header/menu/light.css')
    .styles(devAssetsDir+'css/skins/header/menu/light.css', basePublicDir + 'css/skins/header/base/light.css')
    .styles(devAssetsDir+'css/skins/brand/dark.css', basePublicDir + 'css/skins/brand/dark.css')
    .styles(devAssetsDir+'css/skins/aside/dark.css', basePublicDir + 'css/skins/aside/dark.css')

    .styles(devAssetsDir+'css/pages/login/login-1.css', basePublicDir + 'css/pages/login/login-1.css')





    .copyDirectory(devAssetsDir+ 'plugins/global/fonts', basePublicDir + 'plugins/global/fonts')

    // .combine([vendors + 'jquery.repeater/src/lib.js'], 'public/js/vendors.js')

    .scripts([devAssetsDir+'plugins/custom/fullcalendar/fullcalendar.bundle.js'],
        basePublicDir+'plugins/custom/fullcalendar/fullcalendar.bundle.js')
    .scripts([devAssetsDir+'js/scripts.bundle.js'], basePublicDir+'js/scripts.bundle.js')
    .scripts([devAssetsDir+'plugins/global/plugins.bundle.js'], basePublicDir+'plugins/global/plugins.bundle.js')
    .scripts([devAssetsDir+'js/pages/dashboard.js'], basePublicDir+'js/pages/dashboard.js')


    // .js('resources/js/app.js', 'public/js')

    .sourceMaps()

    .browserSync('http://municipalwebportal.test');

if (mix.inProduction()) {
    mix.version();
}
