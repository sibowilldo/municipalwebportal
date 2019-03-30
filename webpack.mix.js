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

// var plugin =  'resources/js/plugins/';
var vendors = 'resources/assets/vendors/';
// var fonts =  'resources/fonts/';

mix
    .styles([
        vendors + 'perfect-scrollbar/css/perfect-scrollbar.css',
        vendors + 'tether/dist/css/tether.css',
        vendors + 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
        vendors + 'bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css',
        vendors + 'bootstrap-timepicker/css/bootstrap-timepicker.min.css',
        vendors + 'bootstrap-daterangepicker/daterangepicker.css',
        vendors + 'bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css',
        vendors + 'bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
        vendors + 'bootstrap-select/dist/css/bootstrap-select.css',
        vendors + 'select2/dist/css/select2.css',
        vendors + 'nouislider/distribute/nouislider.css',
        vendors + 'owl.carousel/dist/assets/owl.carousel.css',
        vendors + 'owl.carousel/dist/assets/owl.theme.default.css',
        vendors + 'ion-rangeslider/css/ion.rangeSlider.css',
        vendors + 'ion-rangeslider/css/ion.rangeSlider.skinFlat.css',
        vendors + 'dropzone/dist/dropzone.css',
        vendors + 'summernote/dist/summernote.css',
        vendors + 'bootstrap-markdown/css/bootstrap-markdown.min.css',
        vendors + 'animate.css/animate.css',
        vendors + 'toastr/build/toastr.css',
        vendors + 'jstree/dist/themes/default/style.css',
        vendors + 'morris.js/morris.css',
        vendors + 'chartist/dist/chartist.min.css',
        vendors + 'sweetalert2/dist/sweetalert2.min.css',
        vendors + 'socicon/css/socicon.css',
        vendors + 'line-awesome/css/line-awesome.css',
        vendors + 'flaticon/css/flaticon.css',
        vendors + 'metronic/css/styles.css',
        vendors + 'datatables/datatables.bundle.css',
        vendors + 'fontawesome5/css/all.min.css'
    ], 'public/css/vendors.css')
    .copyDirectory(vendors + 'socicon/font', 'public/font')
    .copyDirectory(vendors + 'line-awesome/fonts', 'public/fonts')
    .copyDirectory(vendors + 'flaticon/fonts', 'public/fonts')
    .copyDirectory(vendors + 'metronic/fonts', 'public/fonts')
    .copyDirectory(vendors + 'fontawesome5/webfonts', 'public/webfonts')
    .styles([
        vendors + 'tether/dist/css/tether.css',
        'resources/assets/css/style.bundle.css'
    ], 'public/css/styles.css')
    .combine([
        // <!--begin:: Global Mandatory Vendors -->
        vendors + 'jquery/dist/jquery.js',
        vendors + 'popper.js/dist/umd/popper.js',
        vendors + 'bootstrap/dist/js/bootstrap.min.js',
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
    ], 'public/js/vendors.js')
    .scripts(['resources/assets/js/scripts.bundle.js'], 'public/js/scripts.bundle.js')
    .scripts(['resources/assets/js/dashboard.js'], 'public/js/dashboard.js')
    .scripts(['resources/assets/js/google-maps.js'], 'public/js/google-maps.js')
    .scripts(['resources/assets/js/project-mdatatable.js'], 'public/js/project-mdatatable.js')
    .sourceMaps()
    .browserSync('http://municipalwebportal.test');

if (mix.inProduction()) {
    mix.version();
}




// mix.js('resources/js/app.js', 'public/js/app.js')
//     .combine([
//         plugin + 'jquery/dist/jquery.min.js',
//         plugin + 'popper/popper.min.js',
//         plugin + 'bootstrap/bootstrap.min.js',
//         plugin + 'moment/moment.min.js',
//         plugin + 'toastr/toastr.min.js',
//         plugin + 'slimscroll/jquery.slimscroll.js',
//         plugin + 'perfect-scrollbar/perfect-scrollbar.js',
//         plugin + 'waves/waves.js',
//         plugin + 'sidebarmenu.js',
//         plugin + 'sticky-kit/sticky-kit.min.js',
//         plugin + 'scripts.bundle.js',
//                  'resources/js/custom.js',
//                  'public/js/app.js', ],'public/js/bundle.min.js')
//     .sass('resources/sass/style.scss', 'public/css')
//     .browserSync('http://localhost:8000');