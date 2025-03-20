
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
                                    <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <!-- <div class="row gy-4"> -->
                                            <div class="col-xxl-12 col-md-12">
                                                <div>
                                                    <label for="basiInput" class="form-label">Old Password</label>
                                                    <input type="text" class="form-control" id="oldPass" name="oldPass">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-xxl-12 col-md-12">
                                                <div>
                                                    <label for="basiInput" class="form-label">New Password</label>
                                                    <input type="text" class="form-control" id="newPass"  name="newPass">
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
                            <script>document.write(new Date().getFullYear())</script> © fauzanbakri.
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
    $('#submitBtn').on('click', function (e) {
        console.log('asdasdsadasd');
        const button = document.getElementById('toast');
        e.preventDefault();
        const formData = {
            oldPass: $('[name="oldPass"]').val(),
            newPass: $('[name="newPass"]').val()
        };
        if (!formData.oldPass || !formData.newPass) {
            button.setAttribute('data-toast-text', 'Please Fill the Field!');
            button.setAttribute('data-toast-className', 'danger');
            button.click();
            return;
        }
        $.ajax({
            url: 'ChangePass/change',
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log(response);
                if(response=='success'){
                    button.setAttribute('data-toast-text', 'Data Saved!');
                    button.setAttribute('data-toast-className', 'success');
                    button.click();
                    // location.reload();
                }else{
                    button.setAttribute('data-toast-text', response);
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();   
                }
            },
            error: function (xhr, status, error) {
                button.setAttribute('data-toast-text', error);
                button.setAttribute('data-toast-className', 'danger');
                button.click();
            }
        });
        console.log('asdasdsadasd');
    });
    </script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/pages-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:17:37 GMT -->
</html>