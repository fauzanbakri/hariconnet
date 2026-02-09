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
                                <h4 class="mb-sm-0">Dashboard Gangguan OLT Berulang</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Gangguan OLT Berulang</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Upload File Incident (XLS/XLSX)</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <p class="text-muted">Pilih file list incident (contoh terlampir). Hanya baris dengan <strong>namaPetugasBuat = VIA NGAOSS</strong> yang dihitung.</p>
                                    <div class="live-preview">
                                        <form id="uploadForm" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="file" name="file" id="fileInput" class="form-control" accept=".xls,.xlsx" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="submit" id="uploadBtn" class="btn rounded-pill btn-primary waves-effect waves-light">Upload</button>
                                                </div>
                                                <div class="col-lg-4 text-end" id="lastPulled">Tanggal terakhir: -</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Hasil</h4>
                                </div><!-- end card header -->
                                <div class="card-body" id="results">
                                    <center>Belum ada data. Silakan unggah file.</center>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
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
            $('#uploadForm').on('submit', function(e){
                e.preventDefault();
                var f = $('#fileInput').prop('files')[0];
                if(!f){
                    Swal.fire('Error','Pilih file terlebih dahulu','warning');
                    return;
                }
                var fd = new FormData();
                fd.append('file', f);
                $('#uploadBtn').prop('disabled', true).text('Processing...');
                $.ajax({
                    url: 'DashboardGangguanOlt/upload',
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(res){
                        $('#uploadBtn').prop('disabled', false).text('Upload');
                        try{
                            var j = (typeof res === 'string')? JSON.parse(res) : res;
                        }catch(err){
                            $('#results').html('<div class="text-danger">Response parsing error</div>');
                            return;
                        }
                        if (j.error){
                            Swal.fire('Error', j.error, 'error');
                            return;
                        }
                        var html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>OLT</th><th>Count Incident (VIA NGAOSS)</th><th>Penyebab Detail</th></tr></thead><tbody>';
                        if (j.data && j.data.length){
                            j.data.forEach(function(row){
                                var causes = row.causes && row.causes.length ? row.causes.join(' ; ') : '-';
                                html += '<tr><td>'+row.devicename+'</td><td>'+row.count+'</td><td>'+causes+'</td></tr>';
                            });
                        } else {
                            html += '<tr><td colspan="3">Tidak ada data</td></tr>';
                        }
                        html += '</tbody></table></div>';
                        $('#results').html(html);
                        if (j.last_datetime){
                            $('#lastPulled').text('Tanggal terakhir: '+j.last_datetime);
                        } else {
                            $('#lastPulled').text('Tanggal terakhir: -');
                        }
                    },
                    error: function(xhr, status, err){
                        $('#uploadBtn').prop('disabled', false).text('Upload');
                        Swal.fire('Error','Upload gagal','error');
                    }
                })
            });
        });
    </script>

</body>

</html>
