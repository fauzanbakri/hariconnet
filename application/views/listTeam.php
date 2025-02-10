
    
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
                                <h4 class="mb-sm-0">Tickets</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tickets</a></li>
                                        <li class="breadcrumb-item active">Ticket</li>
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
                                    <h5 class="card-title mb-0">List Team</h5><br>
                                    <!-- Base Buttons -->
                                     <!-- Grids in modals -->
                                <!-- Grids in modals -->
                                 <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                                            Add New Team
                                        </button>
                                        <button hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" id="toast" class="btn btn-light w-xs"></button>
                                    </div>
                                 </div>
                                <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalgridLabel">New Team</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label class="form-label">Nama Tim</label>
                                                                <input type="text" class="form-control" name="namatim" id="namatim" autocomplete="off" placeholder="Nama Tim">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Segmen</label>
                                                            <select class="form-select mb-3" name="segmen" id="segmen" aria-label="Default select example">
                                                                <option value="Retail">Retail</option>
                                                                <option value="Korporat">Korporat</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Latitude</label>
                                                                <input type="text" class="form-control" name="lat" id="lat" autocomplete="off" placeholder="Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Longitude</label>
                                                                <input type="text" class="form-control" name="longi" id="longi" autocomplete="off" placeholder="Longitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Chat ID Telegram</label>
                                                                <input type="text" class="form-control" id="chatid" name="chatid" autocomplete="off" placeholder="Chat ID">
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
                                                <h5 class="modal-title" id="exampleModalgridLabel">Edit Team</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <input type="hidden" class="form-control" name="editidtim" id="editidtim" autocomplete="off" placeholder="Nama Tim">
                                                                <label class="form-label">Nama Tim</label>
                                                                <input type="text" class="form-control" name="editnama" id="editnama" autocomplete="off" placeholder="Nama Tim">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <label for="lastName" class="form-label">Segmen</label>
                                                            <select class="form-select mb-3" name="editsegmen" id="editsegmen" aria-label="Default select example">
                                                                <option value="Retail">Retail</option>
                                                                <option value="Korporat">Korporat</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Latitude</label>
                                                                <input type="text" class="form-control" name="editlat" id="editlat" autocomplete="off" placeholder="Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Longitude</label>
                                                                <input type="text" class="form-control" name="editlongi" id="editlongi" autocomplete="off" placeholder="Longitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="lastName" class="form-label">Chat ID Telegram</label>
                                                                <input type="text" class="form-control" id="editchatid" name="editchatid" autocomplete="off" placeholder="Chat ID">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" id="editsubmitBtn">Submit</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <div class="card-body">
                                    <table id="datatim" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Team Name</th>
                                                <th>Lattitude</th>
                                                <th>Longitude</th>
                                                <th>Segment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!-- <span class="badge bg-danger">Danger</span> -->
                                        <tbody>
                                            <?php
                                            foreach ($tim as $row){
                                                echo "
                                                <tr>
                                                    <td>".$row->idTim."</td>
                                                    <td>".$row->nama."</td>
                                                    <td>".$row->lat."</td>
                                                    <td>".$row->longi."</td>
                                                    <td>".$row->segmen."</td>
                                                    <td>
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>
                                                                <li>
                                                                    <a href='#' class='dropdown-item edit-item-btn' data-editidTim='".$row->idTim."' data-editnama='".$row->nama."' data-editlat='".$row->lat."' data-editlongi='".$row->longi."' data-editsegmen='".$row->segmen."' data-editchatId='".$row->chatId."'>
                                                                        <i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href='#' class='dropdown-item remove-item-btn' data-idTim=".$row->idTim."'>
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
        document.getElementById("sa-warning") && document.getElementById("sa-warning").addEventListener("click", function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                customClass: {
                    confirmButton: "btn btn-primary w-xs me-2 mt-2",
                    cancelButton: "btn btn-danger w-xs mt-2"
                },
                confirmButtonText: "Yes, Change Shift!",
                buttonsStyling: !1,
                showCloseButton: !0
            }).then(function(t) {
                console.log(t.value);
                var response;
                if(t.value){
                    $.ajax({
                        url: "Tickets/changeShift",
                        type: 'GET',
                        success: function(res) {
                            if (res=='success'){
                                Swal.fire({
                                    title: "Success!",
                                    text: "Shift Change Successfully.",
                                    icon: "success",
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mt-2"
                                    },
                                    buttonsStyling: !1
                                }) 
                            }else{
                                Swal.fire({
                                    title: "Error!",
                                    text: "Failed to Change Shift",
                                    icon: "warning",
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mt-2"
                                    },
                                    buttonsStyling: !1
                                })
                            }
                        }
                    })
                    
                }
            })
        })
    </script>
    <script>
        const button = document.getElementById('toast');
        $(document).ready(function () {
            $('#submitBtn').on('click', function (e) {
                e.preventDefault();
                const formData = {
                    namatim: $('[name="namatim"]').val(),
                    segmen: $('[name="segmen"]').val(),
                    lat: $('[name="lat"]').val(),
                    longi: $('[name="longi"]').val(),
                    chatid: $('[name="chatid"]').val()
                   
                };
                if (!formData.namatim) {
                    button.setAttribute('data-toast-text', 'Nama Tim Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'ListTeam/insertData',
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
                e.preventDefault();
                const formData = {
                    idtim: $('[name="editidtim"]').val(),
                    namatim: $('[name="editnama"]').val(),
                    segmen: $('[name="editsegmen"]').val(),
                    lat: $('[name="editlat"]').val(),
                    longi: $('[name="editlongi"]').val(),
                    chatid: $('[name="editchatid"]').val()
                };
                if (!formData.namatim) {
                    button.setAttribute('data-toast-text', 'Nama Tim Cannot Empty!');
                    button.setAttribute('data-toast-className', 'danger');
                    button.click();
                    return;
                }
                $.ajax({
                    url: 'ListTeam/editData',
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
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.remove-item-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const idTim = this.getAttribute('data-idTim');
                    console.log(idTim);
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
                                url: 'ListTeam/deleteRow?id='+idTim,
                                type: 'GET',
                                success: function(response) {
                                    console.log(response.success);
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
                    'editidtim', 'editnama', 'editlat', 'editlongi', 'editsegmen', 'editchatid'
                ];
                fields.forEach(field => {
                    const inputElement = document.getElementById(field);
                    if (inputElement) {
                        console.log(`Setting ${field} with value:`, ticketData[field]);
                        inputElement.value = ticketData[field] || ''; // Set value or empty if no data
                    }
                });
                modal.show();
            });
        });
    });
    </script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/default/tables-datatables.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jan 2025 05:19:48 GMT -->
</html>