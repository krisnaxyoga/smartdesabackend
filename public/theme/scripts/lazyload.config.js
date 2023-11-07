// lazyload config
var MODULE_CONFIG = {
  chat: [
    '/theme/libs/list.js/dist/list.js',
    '/theme/libs/notie/dist/notie.min.js',
    'theme/scripts/plugins/notie.js',
    'theme/scripts/app/chat.js'
  ],
  mail: [
    '/theme/libs/list.js/dist/list.js',
    '/theme/libs/notie/dist/notie.min.js',
    'theme/scripts/plugins/notie.js',
    'theme/scripts/app/mail.js'
  ],
  user: [
    '/theme/libs/list.js/dist/list.js',
    '/theme/libs/notie/dist/notie.min.js',
    'theme/scripts/plugins/notie.js',
    'theme/scripts/app/user.js'
  ],
  screenfull: [
    '/theme/libs/screenfull/dist/screenfull.js',
    'theme/scripts/plugins/screenfull.js'
  ],
  jscroll: [
    '/theme/libs/jscroll/jquery.jscroll.min.js'
  ],
  stick_in_parent: [
    '/theme/libs/sticky-kit/jquery.sticky-kit.min.js'
  ],
  scrollreveal: [
    '/theme/libs/scrollreveal/dist/scrollreveal.min.js',
    'theme/scripts/plugins/jquery.scrollreveal.js'
  ],
  owlCarousel: [
    '/theme/libs/owl.carousel/dist/assets/owl.carousel.min.css',
    '/theme/libs/owl.carousel/dist/assets/owl.theme.css',
    '/theme/libs/owl.carousel/dist/owl.carousel.min.js'
  ],
  html5sortable: [
    '/theme/libs/html5sortable/dist/html.sortable.min.js',
    'theme/scripts/plugins/jquery.html5sortable.js',
    'theme/scripts/plugins/sortable.js'
  ],
  easyPieChart: [
    '/theme/libs/easy-pie-chart/dist/jquery.easypiechart.min.js'
  ],
  peity: [
    '/theme/libs/peity/jquery.peity.js',
    'theme/scripts/plugins/jquery.peity.tooltip.js',
  ],
  chart: [
    '/theme/libs/moment/min/moment-with-locales.min.js',
    '/theme/libs/chart.js/dist/Chart.min.js',
    'theme/scripts/plugins/jquery.chart.js',
    'theme/scripts/plugins/chartjs.js'
  ],
  bootstrapTable: [
    '/theme/libs/bootstrap-table/dist/bootstrap-table.min.css',
    '/theme/libs/bootstrap-table/dist/bootstrap-table.min.js',
    '/theme/libs/bootstrap-table/dist/extensions/export/bootstrap-table-export.min.js',
    '/theme/libs/bootstrap-table/dist/extensions/mobile/bootstrap-table-mobile.min.js',
    'theme/scripts/plugins/tableExport.min.js',
    'theme/scripts/plugins/bootstrap-table.js'
  ],
  bootstrapWizard: [
    '/theme/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js'
  ],
  dropzone: [
    '/theme/libs/dropzone/dist/min/dropzone.min.js',
    '/theme/libs/dropzone/dist/min/dropzone.min.css'
  ],
  datetimepicker: [
    '/theme/libs/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css',
    '/theme/libs/moment/min/moment-with-locales.min.js',
    '/theme/libs/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js',
    'theme/scripts/plugins/datetimepicker.js'
  ],
  datepicker: [
    "/theme/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
    "/theme/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css",
  ],
  fullCalendar: [
    '/theme/libs/moment/min/moment-with-locales.min.js',
    '/theme/libs/fullcalendar/dist/fullcalendar.min.js',
    '/theme/libs/fullcalendar/dist/fullcalendar.min.css',
    'theme/scripts/plugins/fullcalendar.js'
  ],
  parsley: [
    '/theme/libs/parsleyjs/dist/parsley.min.js'
  ],
  select2: [
    '/theme/libs/select2/dist/css/select2.min.css',
    '/theme/libs/select2/dist/js/select2.min.js',
    'theme/scripts/plugins/select2.js'
  ],
  summernote: [
    '/theme/libs/summernote/dist/summernote.css',
    '/theme/libs/summernote/dist/summernote-bs4.css',
    '/theme/libs/summernote/dist/summernote.min.js',
    '/theme/libs/summernote/dist/summernote-bs4.min.js'
  ],
  vectorMap: [
    '/theme/libs/jqvmap/dist/jqvmap.min.css',
    '/theme/libs/jqvmap/dist/jquery.vmap.js',
    '/theme/libs/jqvmap/dist/maps/jquery.vmap.world.js',
    '/theme/libs/jqvmap/dist/maps/jquery.vmap.usa.js',
    '/theme/libs/jqvmap/dist/maps/jquery.vmap.france.js',
    'theme/scripts/plugins/jqvmap.js'
  ]
};

var MODULE_OPTION_CONFIG = {
  parsley: {
    errorClass: 'is-invalid',
    successClass: 'is-valid',
    errorsWrapper: '<ul class="list-unstyled text-sm mt-1 text-muted"></ul>'
  }
}
