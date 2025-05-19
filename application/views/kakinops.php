
    
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
                                <h4 class="mb-sm-0">Kakin Ops</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Kakin Ops</a></li>
                                        <li class="breadcrumb-item active">CusEx</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Kakin Ops</h5><br>
                                    <!-- Base Buttons -->
                                     <!-- Grids in modals -->
                                <!-- Grids in modals -->
                                 <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                            Add New
                                        </button>
                                    </div>
                                    <div class="col-md-9 d-flex flex-row-reverse">

                                        <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                </div>
                                 </div>
                                <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">New Report</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="date" class="form-control" name="tgl" autocomplete="off" placeholder="----/--/--">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Nama</label>
                                                                <input type="disable" class="form-control" name="nama" id="nama" autocomplete="off" placeholder="Tiket" value="<?php echo $_SESSION['nama'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Progress Tim</label>
                                                            <select class="form-select mb-3" name="progress" aria-label="Default select example">
                                                                <option value="Deaktivasi">Deaktivasi</option>
                                                                <option value="Care For Asset">Care For Asset</option>
                                                                <option value="Lain-lain">Lain-lain</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Area Kerja</label>
                                                                <input type="text" class="form-control" name="area" id="area" autocomplete="off" placeholder="Area Kerja">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">OLT</label>
                                                                <input type="text" class="form-control" name="olt" id="olt" autocomplete="off" placeholder="OLT">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">ID Name</label>
                                                                <textarea type="text" class="form-control" name="idname" id="idname" autocomplete="off" placeholder="ID Name"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="submitBtn">Submit</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- modal edit -->
                                <div class="modal fade" id="exampleModalgrid1" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Ticket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Tanggal</label>
                                                                <input type="text" class="form-control" name="editid" autocomplete="off">
                                                                <input type="date" class="form-control" name="edittgl" autocomplete="off" placeholder="----/--/--">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Nama</label>
                                                                <input type="disable" class="form-control" name="editnama" id="editnama" autocomplete="off" placeholder="Tiket" value="<?php echo $_SESSION['nama'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Progress Tim</label>
                                                            <select class="form-select mb-3" name="editprogress" aria-label="Default select example">
                                                                <option value="Deaktivasi">Deaktivasi</option>
                                                                <option value="Care For Asset">Care For Asset</option>
                                                                <option value="Lain-lain">Lain-lain</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Area Kerja</label>
                                                                <input type="text" class="form-control" name="editarea" id="editarea" autocomplete="off" placeholder="Area Kerja">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">OLT</label>
                                                                <input type="text" class="form-control" name="editolt" id="editolt" autocomplete="off" placeholder="OLT">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">ID Name</label>
                                                                <textarea type="text" class="form-control" name="editidname" id="editidname" autocomplete="off" placeholder="ID Name"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="editsubmitBtn">Submit</button>
                                                            </div>
                                                        </div><!--end col-->
                                                       </div> 
                                                    </div><!--end row-->
                                    </div>
                                </div>
                                </div>
                                <div class="card-body">
                                    <table id="kakintable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Progress</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Area</th>
                                                <th>OLT</th>
                                                <th>ID Name</th>
                                                <th>Status</th>
                                                <th>timestamp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            date_default_timezone_set('Asia/Makassar');
                                            foreach ($data as $row){
                                                echo "
                                                <tr> 
                                                    <td>".$row->id."</td>
                                                    <td>".$row->progress."</td>
                                                    <td>".$row->tanggal."</td>
                                                    <td>".$row->nama."</td>
                                                    <td>".$row->area."</td>
                                                    <td>".$row->olt."</td>
                                                    <td>".$row->idName."</td>
                                                    <td>".$row->status."</td>
                                                    <td>".$row->timestamp."</td>
                                                    <td>
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>
                                                               <li>
                                                                    <a href='#' class='dropdown-item edit-item-btn' data-editid='".$row->id."' data-edittgl='".$row->tanggal."' data-editnama='".$row->nama."' data-editjabatan='".$row->jabatan."' data-editprogress='".$row->progress."' data-editarea='".$row->area."' data-editolt='".$row->olt."' data-editidname='".$row->idName."' data-editstatus='".$row->status."'>
                                                                        <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit
                                                                    </a>
                                                                </li>
                                                                    <a href='#' class='dropdown-item remove-item-btn' data-id=".$row->id.">
                                                                        <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td> 
                                                </tr>                                              
                                                ";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!-- container-fluid -->
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

    <!-- Modal Edit Ticket -->



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
    <!-- <script src="assets/js/plugins.js"></script> -->

    <script src="js/code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="js/cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="js/cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="js/cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="js/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- <script src="assets/js/pages/sweetalerts.init.js"></script> -->

    <!-- multi.js -->
    <script src="assets/libs/multi.js/multi.min.js"></script>
    <!-- autocomplete js -->
    <script src="assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/plugins.js"></script>

    <script src="assets/js/app.js"></script>   


    <script>
        var multiSelectBasic = document.getElementById("multiselect-basic"),
        multiSelectHeader = (multiSelectBasic && multi(multiSelectBasic, {
            enable_search: !1
        }), document.getElementById("multiselect-header")),
        multiSelectOptGroup = (multiSelectHeader && multi(multiSelectHeader, {
            non_selected_header: "Cars",
            selected_header: "Favorite Cars"
        }), document.getElementById("multiselect-optiongroup")),
        autoCompleteFruit = (multiSelectOptGroup && multi(multiSelectOptGroup, {
            enable_search: !0
        }), new autoComplete({
            selector: "#olt",
            placeHolder: "Search for OLT...",
            data: {
                src: [
                    <?php 
                        foreach ($olt as $row){
                            echo "'".$row->idOlt."',";
                        }
                    ?>
                ],
                cache: !0
            },
            resultsList: {
                element: function(e, t) {
                    var l;
                    t.results.length || ((l = document.createElement("div")).setAttribute("class", "no_result"), l.innerHTML = '<span>Found No Results for "' + t.query + '"</span>', e.prepend(l))
                },
                noResults: !0
            },
            resultItem: {
                highlight: !0
            },
            events: {
                input: {
                    selection: function(e) {
                        e = e.detail.selection.value;
                        autoCompleteFruit.input.value = e
                    }
                }
            }
        }));
    </script>
    <script>
        // $('#filterKabupaten').on('change', function() {
        //     var table = $('#example').DataTable();
        //     $.fn.dataTable.ext.search.pop(); // Hapus filter lama
        //     $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        //         var selectedKabupaten = $('#filterKabupaten').val();
        //         var kabupatenText = data[11] || '';

        //         return selectedKabupaten === "" || kabupatenText === selectedKabupaten;
        //     });
        //     $('#filterKabupaten').on('change', function() {
        //         table.draw();
        //      });

        // });
    </script>
    <script>
        const button = document.getElementById('toast');
        $(document).ready(function () {
            $('#submitBtn').on('click', function (e) {
                e.preventDefault();
                const formData = {
                    tanggal: $('[name="tgl"]').val(),
                    nama: $('[name="nama"]').val(),
                    progress: $('[name="progress"]').val(),
                    jabatan: $('[name="jabatan"]').val(),
                    area: $('[name="area"]').val(),
                    olt: $('[name="olt"]').val(),
                    idname: $('[name="idname"]').val(),
                    status: $('[name="status"]').val()
                };
                if (!formData.tanggal || !formData.nama) {
                    button.setAttribute('data-toast-text', 'Nama Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'Kakinops/insertData',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        if(response=='success'){
                            button.setAttribute('data-toast-text', 'Data Saved!');
                            button.setAttribute('data-toast-className', 'success');
                            button.click();
                            location.reload();
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

            $('#editsubmitBtn').on('click', function (e) {
                console.log('asdasdsadasd');

                e.preventDefault();
                const formData = {
                    id: $('[name="editid"]').val(),
                    tanggal: $('[name="edittgl"]').val(),
                    nama: $('[name="editnama"]').val(),
                    progress: $('[name="editprogress"]').val(),
                    jabatan: $('[name="editjabatan"]').val(),
                    area: $('[name="editarea"]').val(),
                    olt: $('[name="editolt"]').val(),
                    idname: $('[name="editidname"]').val(),
                    status: $('[name="editstatus"]').val()
                };
                if (!formData.tanggal || !formData.nama) {
                    button.setAttribute('data-toast-text', 'Nama Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'Kakinops/editData',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        if(response=='success'){
                            button.setAttribute('data-toast-text', 'Data Saved!');
                            button.setAttribute('data-toast-className', 'success');
                            button.click();
                            location.reload();
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


        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.remove-item-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    console.log(id);
                    Swal.fire({
                        title: "Are you sure?",
                        text: "This action cannot be undone!",
                        icon: "warning",
                        showCancelButton: true,
                        customClass: {
                            confirmButton: "btn btn-primary w-xs me-2 mt-2",
                            cancelButton: "btn btn-danger w-xs mt-2"
                        },
                        confirmButtonText: "Yes, Delete it!",
                        buttonsStyling: false,
                        showCloseButton: true
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                url: 'Kakinops/deleteRow?id='+id,
                                type: 'GET',
                                success: function(response) {
                                    if (response) {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "The data has been deleted.",
                                            icon: "success",
                                            customClass: {
                                                confirmButton: "btn btn-primary w-xs mt-2"
                                            },
                                            buttonsStyling: false
                                        }).then(() => {
                                            location.reload(); 
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "Error!",
                                            text: response.message || "Failed to delete the data.",
                                            icon: "error",
                                            customClass: {
                                                confirmButton: "btn btn-primary w-xs mt-2"
                                            },
                                            buttonsStyling: false
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "An error occurred while processing the request.",
                                        icon: "error",
                                        customClass: {
                                            confirmButton: "btn btn-primary w-xs mt-2"
                                        },
                                        buttonsStyling: false
                                    });
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('exampleModalgrid1');
    const modal = new bootstrap.Modal(modalElement);
    document.querySelectorAll('.edit-item-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const ticketData = this.dataset;
            console.log(ticketData);
            const fields = [
                'editid', 'edittgl', 'editnama', 'editjabatan', 'editprogress', 'editarea', 'editolt', 'editidname', 'editstatus'];
            fields.forEach(field => {
                const inputElement = document.getElementById(field);
                if (inputElement) {
                    console.log(`Setting ${field} with value:`, ticketData[field]);
                    inputElement.value = ticketData[field] || '';
                }
            });
            modal.show();
        });
    });
});
    </script>
</body>


<!-- Mirrored from Srisyaha.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>