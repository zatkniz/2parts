let mix = require('laravel-mix');

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

mix.js([
				'resources/assets/js/app.js',
				'resources/assets/js/bootstrap.min.js',
				'resources/assets/js/js.cookie.min.js',
				'resources/assets/js/jquery.slimscroll.min.js',
				'resources/assets/js/jquery.blockui.min.js',
				'resources/assets/js/bootstrap-switch.min.js',
				// 'resources/assets/js/datatable.js',
				// 'resources/assets/js/datatables.min.js',
				// 'resources/assets/js/datatables.bootstrap.js',
				// 'resources/assets/js/table-datatables-responsive.js',
				'resources/assets/js/demo.min.js',
				'resources/assets/js/quick-nav.min.js',
				'resources/assets/js/quick-sidebar.min.js',
				'resources/assets/js/layout.js',
				'resources/assets/js/pdfmake.min.js',
				'resources/assets/js/toastr.min.js',
				// 'resources/assets/js/select2.full.min.js',
				// 'resources/assets/js/components-select2.min.js',
				// 'resources/assets/js/vfs_fonts.js',
				'resources/assets/js/scripts.js',
		], 'public/js')
   .styles([
   				'resources/assets/css/font-awesome.min.css',
   				'resources/assets/css/simple-line-icons.min.css',
   				'resources/assets/css/bootstrap.min.css',
   				'resources/assets/css/bootstrap-switch.min.css',
   				'resources/assets/css/components.min.css',
   				'resources/assets/css/plugins.min.css',
   				'resources/assets/css/layout.min.css',
   				'resources/assets/css/darkblue.min.css',
   				'resources/assets/css/custom.min.css',
   				'resources/assets/css/login-2.min.css',
   				'resources/assets/css/datatables.min.css',
   				'resources/assets/css/datatables.bootstrap.css',
   				'resources/assets/css/select2-bootstrap.min.css',
   				'resources/assets/css/select2.min.css',
   				'resources/assets/css/toastr.min.css',
		   ] , 'public/css/all.css')
   .sass('resources/assets/sass/app.scss', 'public/css');
