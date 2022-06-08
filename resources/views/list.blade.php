<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.Name', 'API KEY')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
</head>

<body class="sidebar-mini">
    <div class="wrapper"></div>
    <div class="card">
        <div class="card-body">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div style="text-align: center;">
                                <button class="add-key btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Add Api key</button>
                            </div>
                            <br>
                        </div>
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: left;">
                                            <h3 class="card-title">List <small>Key</small></h3>
                                        </div>
                                        <div class="col-md-6" style="text-align: right;">
                                            <button type="button" class="btn-refresh btn btn-success btn-sm"><i class="fas fa-spinner fa-spin"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="tableKey" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5px;">No.</th>
                                                <th style="width: 20%;">Remain</th>
                                                <th style="width: 30%;">Key</th>
                                                <th style="width: 5px;">Copy</th>
                                                <th style="width: 30%;">Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 5px;">No.</th>
                                                <th style="width: 20%;">Remain</th>
                                                <th style="width: 30%;">Key</th>
                                                <th style="width: 5px;">Copy</th>
                                                <th style="width: 30%;">Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-danger">Are you sure ?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" id="del-id-key">
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                            <button type="button" class="confirm-delete-key btn btn-primary">Xoá</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-add">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Key</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" id="form-add-key">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Key</span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="key" placeholder="Enter Key">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="add-key btn btn-primary">Save key</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span></span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Contact
                        </h6>
                        <p><i class="fas fa-home me-3"></i> 22 Le Loi, Hai Phong, Viet Nam</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            vinhhp2620@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> 096 233 4135</p>
                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Ngo Quang Vinh</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetchData();

            function fetchData() {
                $.ajax({
                    type: 'GET',
                    url: '/api/list',
                    dataType: 'json',
                    success: function(res) {
                        $('#tableKey').DataTable().destroy();
                        $('tbody').html('');
                        $.each(res.data, function(index, item) {
                            $('tbody').append(
                                '<tr>\
                                <td>' + parseInt(index + 1) + '</td>\
                                <td>' + item.remain + '</td>\
                                <td>' + item.key + '</td>\
                                <td>\
                                    <button type="button" class="copy-key btn btn-secondary btn-sm" value="' + item.key + '"><i class="fas fa-copy"></i></button>\
                                </td>\
                                <td>' + item.created_at + '</td>\
                                <td>\
                                    <button type="button" class="delete-key btn btn-danger btn-sm" value="' + item.id + '"><i class="fas fa-trash"></i></button>\
                                </td>\
                            </tr>'
                            );
                        });
                        $("#tableKey").DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        })
                    }
                });
            }
            $(document).on('click', '.delete-key', function(e) {
                e.preventDefault();
                var val = $(this).val();
                $('#del-id-key').val(val);
                $('#modal-default').modal('show');
            });
            $(document).on('click', '.confirm-delete-key', function(e) {
                e.preventDefault();
                var id_product = $('#del-id-key').val();
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/delete/' + id_product,
                    dataType: 'json',
                    success: function(res) {
                        Toast.fire({
                            icon: res.status,
                            title: res.message
                        });
                        $('#modal-default').modal('hide');
                        fetchData();
                    }
                })
            });

            $(document).on('click', '.add-key', function(e) {
                $('#modal-add').modal('show');
            })

            $('#form-add-key').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '/admin/add',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $("#form-add-key")[0].reset();
                        $('#modal-add').modal('hide');
                        fetchData();
                        Toast.fire({
                            icon: res.status,
                            title: res.message,
                        });
                    },
                    error: function(error) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Error',
                        });
                    }
                });
            });

            $(document).on('click', '.btn-refresh', function(e) {
                $.ajax({
                    type: 'GET',
                    url: 'refresh',
                    success: function(res) {
                        fetchData();
                        Toast.fire({
                            icon: res.status,
                            title: res.message,
                        });
                    },
                    error: function(error) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Error',
                        });
                    }
                });
            })

            $(document).on('click', '.copy-key', function(e) {
                e.preventDefault();
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(this).val()).select();
                document.execCommand("copy");
                $temp.remove();
                Toast.fire({
                    icon: 'success',
                    title: 'Đã copy khóa',
                });
            })
        });
    </script>
</body>

</html>