<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ "List" }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('fonts/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/temposdusmus-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icheck-boostrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/overlayScrollbar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables.bundle.min.css') }}">

        <style>
            .main-header, .content-wrapper{
                margin-left: 0px !important;
            }

            #table td, #table th{
                text-align: center;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="preloader"></div>

            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                {{-- <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul> --}}

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" role="button" href="{{ url('/') }}">
                            <i class="fa-solid fa-right-from-bracket">
                                Go back
                            </i>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">List</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="breadcrumb-item active">List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <section class="col-lg-12 connectedSortable">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-table mr-1"></i>
                                            List
                                        </h3>

                                        {{-- @include('users.includes.toolbar') --}}
                                    </div>

                                    <div class="card-body table-responsive">
                                        <table id="table" class="table table-hover" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Birthday</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                </section>
            </div>
        </div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script>$.widget.bridge('uibutton', $.ui.button)</script>
        <script src="{{ asset('js/bootstrap-bundle.min.js') }}"></script>
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/temposdusmus-bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/overlayScrollbar.min.js') }}"></script>
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.bundle.min.js') }}"></script>

        <script>
            $(document).ready(()=> {
                var table = $('#table').DataTable({
                    ajax: {
                        url: "{{ route('getList') }}",
                        dataType: "json",
                        dataSrc: "",
                    },
                    columns: [
                        {data: 'id'},
                        {data: 'code'},
                        {data: 'name'},
                        {data: 'gender'},
                        {data: 'birthday'},
                        {data: 'actions'},
                    ],
                    pageLength: 25,
                    // drawCallback: function(){
                    //  init();
                    // }
                });
            });
        </script>
    </body>
</html>

{{-- type
idNumber
dateOfIssue
dateOfExpiry
countryCode
mrzString
firstName
middleName
lastName
fullName
dateOfBirth
address
gender
placeOfBirth
placeOfIssue
yearOfBirth
age
fatherName
motherName
husbandName
spouseName
nationality
homeTown --}}