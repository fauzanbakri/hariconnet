
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard CS</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">CS</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Check Queue Ticket</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <p class="text-muted">Make Sure ID Ticket or Incident Correct</p>
                                    <div class="live-preview">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select class="form-select rounded-pill mb-3" id="search-param" aria-label="Default select example">
                                                    <option value="idTiket">ID Ticket</option>
                                                    <option value="idInsiden">Incident</option>
                                                    <option value="nama">Nama</option>
                                                    <option value="telepon">Telepon</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control" id="key" placeholder="">
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" id="search" class="btn rounded-pill btn-primary waves-effect waves-light">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body" id="results">
                                    <center>No Data</center><br><br><br><br><br><br>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div> <!-- end col -->
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © fauzanbakri.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Srisyaha
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- prismjs plugin -->
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="js/code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').click(function() {
                var selectedParam = $('#search-param').val();
                var keyValue = $('#key').val();
                $.ajax({
                    url: 'DashboardCs/search',
                    type: 'POST',
                    data: {
                        param: selectedParam,
                        key: keyValue
                    },
                    success: function(response) {
                        $('#results').html(response);
                        // console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + error);
                    }
                });
            });
        });
    </script>
    

</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/forms-select.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:30 GMT -->
</html>