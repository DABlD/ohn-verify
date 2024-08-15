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
                                                    <th>Created At</th>
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
                        {data: 'created_at'},
                        {data: 'actions'},
                    ],
                    pageLength: 25,
                    columnDefs: [
                        {
                            targets: [5],
                            render: date => {
                                return moment(date).format("MMM DD, YYYY H:mm:ss");
                            }
                        }
                    ],
                    // drawCallback: function(){
                    //  init();
                    // }
                });
            });

            function view(code){
                $.ajax({
                    url: '{{ route('getPayload') }}',
                    data: {
                        code: code
                    },
                    success: result => {
                        result = result;

                        let data = JSON.parse(result.data);
                        let img1 = JSON.parse(result.idImageUrl);
                        let img2 = JSON.parse(result.selfieImageUrl);

                        showDetails(data, img1, img2);
                    }
                })
            }

            function showDetails(data, img1, img2){
                Swal.fire({
                    title: 'Details',
                    html:`
                        <img src="${img2}" alt="Selfie" width="50%">
                        <img src="${img1}" alt="ID" width="50%">


                        ${input2("type", "Type", data.type, 3, 9, 'text', 'disabled')}
                        ${input2("idNumber", "ID Number", data.idNumber, 3, 9, 'text', 'disabled')}
                        ${input2("dateOfIssue", "Data of Issue", data.dateOfIssue, 3, 9, 'text', 'disabled')}
                        ${input2("dateOfExpiry", "Date of Expiry", data.dateOfExpiry, 3, 9, 'text', 'disabled')}
                        ${input2("countryCode", "Country Code", data.countryCode, 3, 9, 'text', 'disabled')}
                        ${input2("mrzString", "Mrz String", data.mrzString, 3, 9, 'text', 'disabled')}
                        ${input2("firstName", "First Name", data.firstName, 3, 9, 'text', 'disabled')}
                        ${input2("middleName", "Middle Name", data.middleName, 3, 9, 'text', 'disabled')}
                        ${input2("lastName", "Last Name", data.lastName, 3, 9, 'text', 'disabled')}
                        ${input2("fullName", "Full Name", data.fullName, 3, 9, 'text', 'disabled')}
                        ${input2("dateOfBirth", "Date of Birth", data.dateOfBirth, 3, 9, 'text', 'disabled')}
                        ${input2("address", "Address", data.address, 3, 9, 'text', 'disabled')}
                        ${input2("gender", "Gender", data.gender, 3, 9, 'text', 'disabled')}
                        ${input2("placeOfBirth", "Place of Birth", data.placeOfBirth, 3, 9, 'text', 'disabled')}
                        ${input2("placeOfIssue", "Place of Issue", data.placeOfIssue, 3, 9, 'text', 'disabled')}
                        ${input2("yearOfBirth", "Year of Birth", data.yearOfBirth, 3, 9, 'text', 'disabled')}
                        ${input2("age", "Age", data.age, 3, 9, 'text', 'disabled')}
                        ${input2("fatherName", "Father Name", data.fatherName, 3, 9, 'text', 'disabled')}
                        ${input2("motherName", "Mother Name", data.motherName, 3, 9, 'text', 'disabled')}
                        ${input2("husbandName", "Husband Name", data.husbandName, 3, 9, 'text', 'disabled')}
                        ${input2("spouseName", "Spouse Name", data.spouseName, 3, 9, 'text', 'disabled')}
                        ${input2("nationality", "Nationality", data.nationality, 3, 9, 'text', 'disabled')}
                        ${input2("homeTown", "Home Town", data.homeTown, 3, 9, 'text', 'disabled')}
                    `,
                })
            }
        </script>
    </body>
</html>