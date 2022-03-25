<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Employees</title>
  </head>
  <body>
    <style>
        .dataTables_filter, .dataTables_info { 
            display: none; 
        }
    </style>
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Create</button>
            <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="formCreate" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="first_name" class="form-control form-control-sm" id="first_name" placeholder="insert firts name..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="last_name" class="form-control form-control-sm" id="last_name" placeholder="insert last name..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email_address" class="form-control form-control-sm" id="email_address" placeholder="insert email..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone Number</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="phone_number" class="form-control form-control-sm" id="phone_number" placeholder="insert phone number..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">DOB</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="date_of_birth" class="form-control form-control-sm" id="date_of_birth" autocomplete="off" placeholder="dd/mm/yyyy" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Province</label>
                                    <div class="col-sm-8">
                                        <select name="province_id" id="province_id" class="form-control form-control-sm" required>
                                            <option value="" selected disabled hidden>--- Select Province ---</option>
                                            @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="province_address" id="province_address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">City</label>
                                    <div class="col-sm-8">
                                        <select name="city_address" id="city_address" class="form-control form-control-sm" required>
                                            <option value="" selected disabled hidden>--- Select City ---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Street</label>
                                    <div class="col-sm-8">
                                        <textarea name="street_address" class="form-control form-control-sm" id="street_address" placeholder="insert street..." rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Zip Code</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="zip_code" class="form-control form-control-sm" id="zip_code" placeholder="insert zip code..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Position</label>
                                    <div class="col-sm-8">
                                        <select name="current_position_bank_account" id="current_position_bank_account" class="form-control form-control-sm" required>
                                            <option value="" selected disabled hidden>--- Select Position ---</option>
                                            <option value="manager">Manager</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bank Account</label>
                                    <div class="col-sm-8">
                                        <select name="bank_account" id="bank_account" class="form-control form-control-sm" required>
                                            <option value="" selected disabled hidden>--- Select Bank ---</option>
                                            <option value="BCA">BCA</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="BRI">BRI</option>
                                            <option value="BNI">BNI</option>
                                            <option value="Bank Mega">Bank Mega</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bank Account Number</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="bank_account_number" class="form-control form-control-sm" id="bank_account_number" placeholder="insert account number..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">KTP Number</label>
                                    <div class="col-sm-8">
                                    <input type="number" name="ktp_number" class="form-control form-control-sm" id="ktp_number" placeholder="insert ktp number..." required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                    <div class="col-sm-8">
                                        <img id="previewKtp" width="140px;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Attach KTP</label>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" name="ktp_file" class="custom-file-input" id="ktp_file" onchange="previewKTP(this);" required>
                                            <label class="custom-file-label" id="label-ktp" for="validatedCustomFile">Choose KTP...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <select id="searchName" class="form-control mr-2" style="width: 200px">
                    <option value="" hidden>--- Select Name ---</option>
                    <option value="">All names</option>
                    @foreach ($names as $name)
                    <option value="{{ $name->first_name }}">{{ $name->first_name }}</option>
                    @endforeach
                </select>
                <select id="searchCurrentPosition" class="form-control" style="width: 200px">
                    <option value="" hidden>-- search position --</option>
                    <option value="">All position</option>
                    <option value="manager">Manager</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="table-responsive">
                <table class="display" id="employeeTable" width="100%;">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Name</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Address</th>
                            <th>Current Position</th>
                            <th>KTP File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="emodalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">KTP View</h5>
                    </div>
                    <div class="modal-body">
                        <img id="ktp" style="display:block; width:100%; height:auto;" />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="formUpdate" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">First Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="first_name" class="form-control form-control-sm" id="first_name_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Last Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_name" class="form-control form-control-sm" id="last_name_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email_address" class="form-control form-control-sm" id="email_address_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Phone Number</label>
                                <div class="col-sm-8">
                                    <input type="number" name="phone_number" class="form-control form-control-sm" id="phone_number_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">DOB</label>
                                <div class="col-sm-8">
                                    <input type="text" name="date_of_birth" class="form-control form-control-sm" id="date_of_birth_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Province</label>
                                <div class="col-sm-8">
                                    <select name="province_id" id="province_id_edit" class="form-control form-control-sm" required>
                                        <option></option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="province_address" id="province_address_text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">City</label>
                                <div class="col-sm-8">
                                    <select name="city_address" id="city_address_edit" class="form-control form-control-sm" required>
                                        <option selected></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Street</label>
                                <div class="col-sm-8">
                                    <textarea name="street_address" class="form-control form-control-sm" id="street_address_edit" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Zip Code</label>
                                <div class="col-sm-8">
                                    <input type="number" name="zip_code" class="form-control form-control-sm" id="zip_code_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Position</label>
                                <div class="col-sm-8">
                                    <select name="current_position_bank_account" id="current_position_bank_account_edit" class="form-control form-control-sm" required>
                                        <option value="manager">manager</option>
                                        <option value="supervisor">supervisor</option>
                                        <option value="staff">staff</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bank Account</label>
                                <div class="col-sm-8">
                                    <select name="bank_account" id="bank_account_edit" class="form-control form-control-sm" required>       
                                        <option value="BCA">BCA</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BRI">BRI</option>
                                        <option value="BNI">BNI</option>
                                        <option value="Bank Mega">Bank Mega</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bank Account Number</label>
                                <div class="col-sm-8">
                                    <input type="number" name="bank_account_number" class="form-control form-control-sm" id="bank_account_number_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">KTP Number</label>
                                <div class="col-sm-8">
                                    <input type="number" name="ktp_number" class="form-control form-control-sm" id="ktp_number_edit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm"></label>
                                <div class="col-sm-8">
                                    <img id="image-preview" width="140px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Attach KTP</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" name="ktp_file_edit" class="custom-file-input" id="ktp_file_edit" onchange="previewEditKTP(this);" required>
                                        <label class="custom-file-label" id="label-ktp-edit" for="validatedCustomFile">Choose KTP...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="buttonUpdate" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
        <script>
            $(document).ready( function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                var table = $('#employeeTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('employees.index') }}",
                        type: 'GET',
                        data: function (d) {
                            d.current_position_bank_account = $('#searchCurrentPosition').val(),
                            d.first_name = $('#searchName').val(),
                            d.search = $('input[type="search"]').val()
                        }
                    },
                    columns: [
                        // { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        { data: 'first_name', name: 'first_name' },
                        { data: 'phone_number', name: 'phone_number' },
                        { data: 'date_of_birth', name: 'date_of_birth' },
                        { data: 'street_address', name: 'street_address' },
                        { data: 'current_position_bank_account', name: 'current_position_bank_account' },
                        { data: 'view', name: 'view' },
                        { data: 'action', name: 'action', orderable: false },
                    ],
                    order: [[0, 'desc']]
                });

                $("#searchCurrentPosition").change(function(){
                    table.draw();
                });

                $("#searchName").change(function(){
                    table.draw();
                });

                $('#date_of_birth').datepicker({
                    format: 'dd/mm/yyyy'
                });

                $('#date_of_birth_edit').datepicker({
                    format: 'dd/mm/yyyy'
                });

                $('select[name="province_id"]').on('change', function() {
                    var provinceId = $(this).val();
                    var selected = $(this).find("option:selected").text();
                    var province_address = $('#province_address').val(selected); 
                    if(provinceId) {
                        $.ajax({
                            url: '/employees/city/'+provinceId,
                            type: "GET",
                            dataType: "json",
                            success:function(data) {
                                $('select[name="city_address"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="city_address"]').append('<option value="'+ value.name_city +'">'+ value.name_city +'</option>');
                                });
                            }
                        });
                    }else{
                        $('select[name="city_address"]').empty();
                    }
                });

                $('#ktp_file').on('change',function(){
                    var fileName = $(this).val().replace("C:\\fakepath\\", "");
                    $(this).next('.custom-file-label').html(fileName);
                })

                $('#ktp_file_edit').on('change',function(){
                    var fileName = $(this).val().replace("C:\\fakepath\\", "");
                    $(this).next('.custom-file-label').html(fileName);
                })

                $(document).on('submit', '#formCreate', function(event){  
                    event.preventDefault();  
                    var first_name = $('#first_name').val();    
                    var last_name = $('#last_name').val(); 
                    var email_address = $('#email_address').val(); 
                    var phone_number =$('#phone_number').val();
                    var date_of_birth = $('#date_of_birth').val(); 
                    var province_id = $('#province_id :selected').val(); 
                    var city_address = $('#city_address').val(); 
                    var street_address = $('#street_address').val(); 
                    var zip_code = $('#zip_code').val(); 
                    var current_position_bank_account = $('#current_position_bank_account :selected').val(); 
                    var bank_account = $('#bank_account :selected').val(); 
                    var bank_account_number = $('#bank_account_number').val(); 
                    var ktp_number = $('#ktp_number').val(); 
                    var ktp_file = $('#ktp_file').val(); 
                    var formData = new FormData($(this)[0]);
                    $.ajax({
                        url: "{{ url('/employees/create') }}",
                        cache: false,  
                        method:'POST',  
                        contentType:false,  
                        processData:false,
                        data:  formData,
                        success: function(data){
                            Swal.fire({
                                title: 'your submit is success',
                                text: "sukses",
                                icon: 'success',
                                confirmButtonColor: '#004028',
                                confirmButtonText: 'Yes',
                                allowOutsideClick: false
                            });
                            $('#formCreate')[0].reset(); 
                            $("#previewKtp").attr("src",'');
                            $('#label-ktp').text('Choose KTP...');
                            $('#modalCreate').modal('hide');  
                            $('#employeeTable').DataTable().ajax.reload( null, false ); 
                        },
                        error: function(response){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                 text: 'Something went wrong!',
                            })
                        }
                    })
                }); 

                
                $(document).on("click", ".editEmployee", function () {
                    var id = $(this).data('id');
                    $.ajax({
                        type:"POST",
                        url: "{{ url('/employees/edit') }}"+'/'+id,
                        data: { id: id },
                        dataType: 'json',
                        success: function(res){
                            $('#modalEdit').modal('show');
                            $('#id').val(res.id);
                            $('#first_name_edit').val(res.first_name);
                            $('#last_name_edit').val(res.last_name);
                            $('#email_address_edit').val(res.email_address);
                            $('#phone_number_edit').val(res.phone_number);
                            $('#date_of_birth_edit').val(moment(res.date_of_birth).format("DD/MM/YYYY"));
                            $('#province_id_edit :selected').val(res.province_id).text(res.province_address);
                            $('#province_address_text').val(res.province_address);
                            $('#city_address_edit :selected').val(res.city_address).text(res.city_address);
                            $('#street_address_edit').text(res.street_address);
                            $('#zip_code_edit').val(res.zip_code);
                            $('#current_position_bank_account_edit :selected').val(res.current_position_bank_account).text(res.current_position_bank_account);
                            $('#bank_account_edit :selected').val(res.bank_account).text(res.bank_account);
                            $('#bank_account_number_edit').val(res.bank_account_number);
                            $('#ktp_number_edit').val(res.ktp_number);
                            $("#image-preview").attr("src",'../ktp_directory/' + res.ktp_file +'');
                            $("#label-ktp-edit").text(res.ktp_file);
                        }
                    });
                });


                $(document).on('click', '#buttonUpdate', function(event){  
                    event.preventDefault(); 
                    var first_name = $('#first_name_edit').val(); 
                    var last_name = $('#last_name_edit').val(); 
                    var email_address = $('#email_address_edit').val(); 
                    var phone_number =$('#phone_number_edit').val();
                    var date_of_birth = $('#date_of_birth_edit').val(); 
                    var province_id = $('#province_id_edit :selected').val(); 
                    var province_address =  $('#province_id_edit :selected').text();
                    var city_address = $('#city_address_edit :selected').val(); 
                    var street_address = $('#street_address_edit').val(); 
                    var zip_code = $('#zip_code_edit').val(); 
                    var current_position_bank_account = $('#current_position_bank_account_edit').val(); 
                    var bank_account = $('#bank_account_edit').val(); 
                    var bank_account_number = $('#bank_account_number_edit').val(); 
                    var ktp_number = $('#ktp_number_edit').val(); 
                    var ktp_file = $('[name="ktp_file_edit"]').val();  
                    var id = $('#id').val();  
                    var formData = new FormData($('#formUpdate')[0]);
                    $.ajax({
                        url: "{{ url('/employees/update') }}"+'/'+id,
                        cache: false,
                        method:"POST",
                        contentType:false,  
                        processData:false,  
                        data: formData,
                        success: function(data){
                            Swal.fire({
                                title: 'data berhasil diupdate',
                                text: "sukses",
                                icon: 'success',
                                confirmButtonColor: '#004028',
                                confirmButtonText: 'Oke',
                                allowOutsideClick: false
                            });
                            $('#formUpdate')[0].reset(); 
                            $('#modalEdit').modal('hide');
                            $('#employeeTable').DataTable().ajax.reload( null, false );      
                        },
                        error: function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }
                    })
                });  


                $(document).on('click', '.delete', function(){  
                    var id = $(this).attr("data-id");  
                    Swal.fire({
                        title: 'Apakah anda yakin untuk menghapus data ini ?',
                        text: "data akan dihapus secara permanen !",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#004028',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "{{ url('/employees/delete') }}"+'/'+id,
                                cache: false,
                                method:"DELETE",  
                                data: { id: id },
                                success: function(data){
                                    $('#employeeTable').DataTable().ajax.reload( null, false );       
                                },
                                error: function(){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Maaf...',
                                        text: 'Ada Kesalahan !',
                                    })
                                }
                            }),
                            Swal.fire({
                                title: 'Terhapus',
                                text: "Data berhasil dihapus",
                                icon: 'success',
                                confirmButtonColor: '#004028',
                                allowOutsideClick: false
                            })
                        }
                    });
                }); 
                
                $(document).on("click", ".ktpView", function () {
                    var ktp_file = $(this).attr('data-ktp');
                    $("#ktp").attr("src",'../ktp_directory/' + ktp_file +'');
                });
            });

            function previewKTP(input){
                var file = $("#ktp_file").get(0).files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload = function(){
                        $("#previewKtp").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }

            function previewEditKTP(input){
                var file = $("#ktp_file_edit").get(0).files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload = function(){
                        $("#image-preview").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    </body>
</html>