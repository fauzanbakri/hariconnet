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
                                <h4 class="mb-sm-0">Update Tiket</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Update Tiket</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Form Update Tiket</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="incidentInput" class="form-label">Incident</label>
                                        <input type="text" class="form-control" id="incidentInput" placeholder="Masukkan ID Incident atau Ticket" />
                                    </div>
                                    <button id="submitQueue" type="button" class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Hasil Antrian</h4>
                                    <button id="copyQueue" type="button" class="btn btn-sm btn-outline-secondary ms-2">Copy</button>
                                </div>
                                <div class="card-body" id="queueResult">
                                    <center>Data antrian akan muncul di sini setelah submit.</center>
                                </div>
                            </div>
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
            $('#submitQueue').click(function() {
                var incidentValue = $('#incidentInput').val().trim();
                if (!incidentValue) {
                    Swal.fire('Error', 'Silakan masukkan incident.', 'error');
                    return;
                }

                $.ajax({
                    url: 'UpdateTicket/search',
                    type: 'POST',
                    data: {
                        incident: incidentValue
                    },
                    beforeSend: function() {
                        $('#queueResult').html('<div class="text-center text-muted">Memproses...</div>');
                    },
                    success: function(response) {
                        $('#queueResult').html(response);
                    },
                    error: function(xhr, status, error) {
                        $('#queueResult').html('<div class="alert alert-danger">Terjadi kesalahan: ' + error + '</div>');
                    }
                });
            });

            $('#copyQueue').click(function() {
                var resultText = buildQueueCopyText();
                if (!resultText) {
                    Swal.fire('Info', 'Tidak ada hasil untuk disalin.', 'info');
                    return;
                }

                navigator.clipboard.writeText(resultText).then(function() {
                    Swal.fire('Berhasil', 'Hasil antrian berhasil disalin.', 'success');
                }).catch(function(err) {
                    Swal.fire('Error', 'Gagal menyalin hasil: ' + err, 'error');
                });
            });

            function buildQueueCopyText() {
                var lines = [];
                $('#queueResult .list-group-item').each(function() {
                    var incident = $(this).find('span').first().text().trim();
                    var queueBadge = $(this).find('.badge').first().text().trim();
                    if (incident && queueBadge) {
                        lines.push(incident + ' ' + queueBadge);
                    }
                });

                var alertText = $('#queueResult .alert-success, #queueResult .alert-warning').first().text().trim();
                if (alertText) {
                    lines.push('', alertText);
                }

                return lines.join('\n');
            }
        });
    </script>

</body>

<!-- Mirrored from themesbrand.com/velzon/html/default/forms-select.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:30 GMT -->
</html>
