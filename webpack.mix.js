const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

var vendors = 'resources/assets/vendors/';

mix
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory(vendors + 'socicon/font', 'public/font')
    .copyDirectory(vendors + 'line-awesome/fonts', 'public/fonts')
    .copyDirectory(vendors + 'flaticon/fonts', 'public/fonts')
    .copyDirectory(vendors + 'metronic/fonts', 'public/fonts')
    .copyDirectory(vendors + 'fontawesome5/webfonts', 'public/webfonts')
    .styles([
        'resources/assets/css/style.bundle.css'
    ], 'public/css/styles.bundle.css')
    .combine([
        // <!--begin:: Global Mandatory Vendors -->
        // vendors + 'jquery/dist/jquery.js',
        // vendors + 'popper.js/dist/umd/popper.js',
        // vendors + 'bootstrap/dist/js/bootstrap.min.js',
        vendors + 'js-cookie/src/js.cookie.js',
        vendors + 'moment/min/moment.min.js',
        vendors + 'tooltip.js/dist/umd/tooltip.min.js',
        vendors + 'perfect-scrollbar/dist/perfect-scrollbar.js',
        vendors + 'wnumb/wNumb.js',
        // <!--end:: Global Mandatory Vendors -->
    ], 'public/js/mandatory.js')
    .combine([
        // <!--begin:: Global Optional Vendors -->
        vendors + 'jquery.repeater/src/lib.js',
        vendors + 'jquery.repeater/src/jquery.input.js',
        vendors + 'jquery.repeater/src/repeater.js',
        vendors + 'jquery-form/dist/jquery.form.min.js',
        vendors + 'block-ui/jquery.blockUI.js',
        vendors + 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        vendors + 'js/framework/components/plugins/forms/bootstrap-datepicker.init.js',
        vendors + 'bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js',
        vendors + 'bootstrap-timepicker/js/bootstrap-timepicker.min.js',
        vendors + 'js/framework/components/plugins/forms/bootstrap-timepicker.init.js',
        vendors + 'bootstrap-daterangepicker/daterangepicker.js',
        vendors + 'js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js',
        vendors + 'bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
        vendors + 'bootstrap-maxlength/src/bootstrap-maxlength.js',
        vendors + 'bootstrap-switch/dist/js/bootstrap-switch.js',
        vendors + 'js/framework/components/plugins/forms/bootstrap-switch.init.js',
        vendors + 'vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js',
        vendors + 'bootstrap-select/dist/js/bootstrap-select.js',
        vendors + 'bootstrap-tagsinput/tagsinput.js',
        vendors + 'select2/dist/js/select2.full.js',
        vendors + 'typeahead.js/dist/typeahead.bundle.js',
        vendors + 'handlebars/dist/handlebars.js',
        vendors + 'inputmask/dist/jquery.inputmask.bundle.js',
        vendors + 'inputmask/dist/inputmask/inputmask.date.extensions.js',
        vendors + 'inputmask/dist/inputmask/inputmask.numeric.extensions.js',
        vendors + 'inputmask/dist/inputmask/inputmask.phone.extensions.js',
        vendors + 'nouislider/distribute/nouislider.js',
        vendors + 'owl.carousel/dist/owl.carousel.js',
        vendors + 'autosize/dist/autosize.js',
        vendors + 'clipboard/dist/clipboard.min.js',
        vendors + 'ion-rangeslider/js/ion.rangeSlider.js',
        vendors + 'dropzone/dist/dropzone.js',
        vendors + 'summernote/dist/summernote.js',
        vendors + 'markdown/lib/markdown.js',
        vendors + 'bootstrap-markdown/js/bootstrap-markdown.js',
        vendors + 'js/framework/components/plugins/forms/bootstrap-markdown.init.js',
        vendors + 'jquery-validation/dist/jquery.validate.js',
        vendors + 'jquery-validation/dist/additional-methods.js',
        vendors + 'js/framework/components/plugins/forms/jquery-validation.init.js',
        vendors + 'bootstrap-notify/bootstrap-notify.min.js',
        vendors + 'js/framework/components/plugins/base/bootstrap-notify.init.js',
        vendors + 'toastr/build/toastr.min.js',
        vendors + 'jstree/dist/jstree.js',
        vendors + 'raphael/raphael.js',
        vendors + 'morris.js/morris.js',
        vendors + 'flot/flot.bundle.js',
        vendors + 'chartist/dist/chartist.js',
        vendors + 'chart.js/dist/Chart.bundle.js',
        vendors + 'js/framework/components/plugins/charts/chart.init.js',
        vendors + 'vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js',
        vendors + 'vendors/jquery-idletimer/idle-timer.min.js',
        vendors + 'waypoints/lib/jquery.waypoints.js',
        vendors + 'counterup/jquery.counterup.js',
        vendors + 'es6-promise-polyfill/promise.min.js',
        vendors + 'sweetalert2/dist/sweetalert2.min.js',
        vendors + 'js/framework/components/plugins/base/sweetalert2.init.js',
        'resources/assets/js/bootstrap-notify.init.js',
    ], 'public/js/vendors.js')
    .scripts(['resources/assets/js/scripts.bundle.js'], 'public/js/scripts.bundle.js')
    .scripts(['resources/assets/js/dashboard.js'], 'public/js/dashboard.js')
    .scripts(['resources/assets/js/google-maps.js'], 'public/js/google-maps.js')
    .scripts(['resources/assets/js/project-mdatatable.js'], 'public/js/project-mdatatable.js')
    .js('resources/js/app.js', 'public/js')
    // .extract(['vue'])
    .sourceMaps()
    .browserSync('http://municipalwebportal.test');


// module.exports = {
//     module: {
//         rules: [
//             // ... other rules
//             {
//                 test: /\.vue$/,
//                 loader: 'vue-loader'
//             },
//             // this will apply to both plain `.js` files
//             // AND `<script>` blocks in `.vue` files
//             {
//                 test: /\.js$/,
//                 loader: 'babel-loader'
//             },
//             // this will apply to both plain `.css` files
//             // AND `<style>` blocks in `.vue` files
//             {
//                 test: /\.css$/,
//                 use: [
//                     'vue-style-loader',
//                     'css-loader'
//                 ]
//             }
//         ]
//     },
//     plugins: [
//         // make sure to include the plugin!
//         new VueLoaderPlugin()
//     ]
// }

if (mix.inProduction()) {
    mix.version();
}