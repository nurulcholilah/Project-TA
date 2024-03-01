 <link href="{{ url('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
 <!--favicon-->
 <link rel="icon" href="{{ url('assets/images/favicon-32x32.png') }}" type="image/png" />
 <!--plugins-->
 <link href="{{ url('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
 <link href="{{ url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
 <link href="{{ url('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
 <!-- loader-->
 <link href="{{ url('assets/css/pace.min.css') }}" rel="stylesheet" />
 <script src="{{ url('assets/js/pace.min.js') }}"></script>
 <!-- Bootstrap CSS -->
 <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ url('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
 <link href="{{ url('assets/css/app.css') }}" rel="stylesheet">
 <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet">

 <!-- Theme Style CSS -->
 <link rel="stylesheet" href="{{ url('assets/css/dark-theme.css') }}" />
 <link rel="stylesheet" href="{{ url('assets/css/semi-dark.css') }}" />
 <link rel="stylesheet" href="{{ url('assets/css/header-colors.css') }}" />
 <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
 <!-- datatable -->
 <link href="{{ url('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

 <style>
     /* merapikan tabel agar tidak scroll panjang ke samping */
     .dataTables_wrapper {
         position: relative;
     }

     .dataTables_filter {
         float: right;
     }

     .dataTables_paginate {
         float: right;
     }

     .table {
         table-layout: fixed;
         width: 100%;
     }

     .table th,
     .table td {
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis;
         max-width: 150px;
         /* Sesuaikan lebar maksimum sesuai kebutuhan */
     }

     .table td:hover {
         overflow: visible;
         white-space: normal;
         word-wrap: break-word;
     }
 </style>