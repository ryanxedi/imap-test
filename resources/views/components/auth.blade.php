<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>{{ env('APP_NAME') }}</title>
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>
    <body id="page-top pt-4">
        <div id="wrapper pt-4">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <div class="container-fluid pt-4">
                        @if (session()->has('success'))
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="fa fa-check mr-2"></i> {{ session('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('failure'))
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="fa fa-times mr-2"></i> {{ session('failure') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        @foreach ($errors->all() as $error)
                                            <div class="mb-2">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{ $slot }}
                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>&copy; {{ date('Y') }} {{ env('APP_NAME') }}</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="/js/sb-admin-2.min.js"></script>
        <script src="/vendor/chart.js/Chart.min.js"></script>
        <script src="/js/demo/chart-area-demo.js"></script>
        <script src="/js/demo/chart-pie-demo.js"></script>
        <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="/js/demo/datatables-demo.js"></script>
    </body>
</html>