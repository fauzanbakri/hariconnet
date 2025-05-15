
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Over SLA</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th scope="col">Incident</th>
                                                    <th scope="col">Tiket</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">OLT</th>
                                                    <th scope="col">Tim</th>
                                                    <th scope="col">Kabupaten</th>
                                                    <th scope="col">Durasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    date_default_timezone_set('Asia/Makassar');
                                                    $no = 1;
                                                    foreach ($data as $datas){
                                                        $tanggalSekarang = new DateTime();
                                                        $durasi1 = new DateTime($datas->tanggal);
                                                        $selisih = $durasi1->diff($tanggalSekarang);
                                                        $durasi = $selisih->d." Hari ".$selisih->h." Jam ".$selisih->i." Menit";
                                                        if ($selisih->d == 3 || $selisih->d == 4){
                                                            $class="badge bg-warning";
                                                        }else if ($selisih->d == 5 || $selisih->d == 6){
                                                            $class="badge bg-danger";
                                                        }else if ($selisih->d > 6){
                                                            $class="badge bg-dark";
                                                        }else{
                                                            $class="badge bg-info";
                                                        }
                                                        echo'
                                                        <tr>
                                                            <td>'.$no.'</td>
                                                            <td>'.$datas->idInsiden.'</td>
                                                            <td>'.$datas->idTiket.'</td>
                                                            <td>'.$datas->nama.'</td>
                                                            <td>'.$datas->idOlt.'</td>
                                                            <td>'.$datas->tim.'</td>
                                                            <td>'.$datas->kabupaten.'</td>
                                                            <td><span class="'.$class.'">'.$durasi.'</span></span></td>
                                                        </tr>
                                                        ';
                                                        $no++;  
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
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
                                Design & Develop by Srisyaha
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


<!-- Mirrored from Srisyaha.com/velzon/html/default/pages-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:17:37 GMT -->
</html>