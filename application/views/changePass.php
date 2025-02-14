
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Change Password</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <!-- <div class="row gy-4"> -->
                                            <div class="col-xxl-12 col-md-12">
                                                <div>
                                                    <label for="basiInput" class="form-label">Old Password</label>
                                                    <input type="text" class="form-control" id="oldPass">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-xxl-12 col-md-12">
                                                <div>
                                                    <label for="basiInput" class="form-label">New Password</label>
                                                    <input type="text" class="form-control" id="newPass">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button class="btn btn-primary" id="submitBtn">Save</button>
                                                </div>
                                            </div><!--end col-->
                                            <!--end col-->                                 </div>
                                            <!--end col-->
                                        <!-- </div> -->
                                        <!--end row-->
                                    </div>
</div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- end main content-->

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
    <script src="js/code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- swiper js -->
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- profile init js -->
    <script src="assets/js/pages/profile.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
    $(document).ready(function() {
        // Lakukan AJAX request saat halaman dibuka
        $.ajax({
            url: 'Report/makassar', // URL yang akan dipanggil
            type: 'GET', // Tipe request (GET atau POST, tergantung kebutuhan)
            success: function(response) {
                $('#makassar-content').html(response);
                // console.log(response);
            },
            error: function(xhr, status, error) {
                $('#makassar-content').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });

        $.ajax({
            url: 'Report/kendari', // URL yang akan dipanggil
            type: 'GET', // Tipe request (GET atau POST, tergantung kebutuhan)
            success: function(response) {
                $('#kendari').html(response);
                // console.log(response);
            },
            error: function(xhr, status, error) {
                $('#makassar-content').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });

        $.ajax({
            url: 'Report/manado', // URL yang akan dipanggil
            type: 'GET', // Tipe request (GET atau POST, tergantung kebutuhan)
            success: function(response) {
                $('#manado').html(response);
                // console.log(response);
            },
            error: function(xhr, status, error) {
                $('#makassar-content').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });

        $('#copy-button').click(function() {
         var content = $('#makassar').text();
         var tempInput = document.createElement('input');
         tempInput.value = content;
         document.body.appendChild(tempInput);
         tempInput.select();
         document.execCommand('copy');
         document.body.removeChild(tempInput);
         alert('Konten telah disalin!');
        });

        $('#generate').on('click', function (e) {
            const formData = {
                makassartotal: $('[name="makassartotal"]').val(),
                makassardivision: $('[name="makassardivision"]').val(),
                kendaritotal: $('[name="kendaritotal"]').val(),
                kendaridivision: $('[name="kendaridivision"]').val(),
                manadototal: $('[name="manadototal"]').val(),
                manadodivision: $('[name="manadodivision"]').val()
            };
            $.ajax({
                url: 'Report/totaltiket',
                type: 'POST',
                data: formData,
                success: function (response) {
                    // console.log(response);
                    $('#totaltiket').html(response);
                }
            });
        });
    });
    </script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/pages-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:17:37 GMT -->
</html>