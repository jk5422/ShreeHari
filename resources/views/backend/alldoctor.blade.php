@extends('backend.layouts.main')

@section('doctor-container')
    @if (session('dtrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('dtrue') }}
        </div>
        {{ Session::forget('dtrue') }}
    @endif


    @if (session('dfalse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('dfalse') }}
        </div>
        {{ Session::forget('dfalse') }}
    @endif


    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="empadd">
                <fieldset class="form-control" style="background-color: aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-success"><i class="fas fa-user-plus"></i><a href="" class="text-white ms-2" data-bs-toggle="modal"
                            data-bs-target="#adddoctor">Add Doctor</a>
                    </span>

                    <span class="btn btn-warning"><i class="fas fa-user-edit"></i><a href="" class="text-dark ms-2" data-bs-toggle="modal"
                            data-bs-target="#updatedoctor">Update Doctor</a>
                    </span>

                    <span class="btn btn-danger"><i class='fas fa-user-alt-slash'></i>
                        <a href="" class="text-dark ms-2" data-bs-toggle="modal" data-bs-target="#deletedoctor">Delete
                            Doctor</a>
                    </span>

                    <span class="btn btn-info"><i class='fas fa-user-lock'></i>
                        <a href="" class="text-dark ms-2" data-bs-toggle="modal" data-bs-target="#changepass">Change
                            Password</a>
                    </span>
                </fieldset>
            </div>


            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Doctors</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>Dr.ID</th>
                                        <th>Dr.Name</th>
                                        <th>Dr.Gender</th>
                                        <th>Dr.Mobile</th>
                                        <th>Dr.Email</th>
                                        <th>Dr.Qualification</th>
                                        <th>Dr.Address</th>
                                        <th>Assoc.Dr.Clinic</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->did }}</td>
                                    <td>{{ $item->dname }}</td>
                                    <td>{{ $item->dgender }}</td>
                                    <td>{{ $item->dmobile }}</td>
                                    <td>{{ $item->demail }}</td>
                                    <td>{{ $item->dqualification }}</td>
                                    <td>{{ $item->daddress }}</td>
                                    <td>{{ $item->cname }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
                <div class="empadd">
                    <span><i class="fa fa-arrow-left" aria-hidden="true"></i><a href="{{ url('doctor/dashboard') }}"
                            style="margin-left: 1rem;" type="button">Go Back</a></span>
                </div>
            </div>




        </div>


        {{-- update doctor Modal  --}}
        <div class="modal fade" id="updatedoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Doctor Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('alldoctor/udoc') }}" method="POST">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="did" id="udocnm" class="form-control bg-white"
                                            onchange="getdocdata(this.value)">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control dname" name="dname"
                                            placeholder="name@example.com">
                                        <label>Dr.Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control demail" name="demail"
                                            placeholder="name@example.com">
                                        <label>Dr.Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control dmobile" name="dmobile" maxlength="10"
                                            placeholder="9574245123">
                                        <label>Dr.Mobile</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control dqual" name="dqual"
                                            placeholder="MBBS">
                                        <label>Dr.Qualification</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="mb-3">
                                        <fieldset class="form-control gender bg-white">
                                            <legend style="font-size: 15px;">Select Gender</legend>
                                            <input type="radio" class="dgenm" name="dgen" id="male"
                                                value="M">
                                            <label for="male">Male</label>
                                            <input type="radio" class="dgenf" name="dgen" id="female"
                                                value="F">
                                            <label for="female">Female</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="mb-3">
                                        <select name="dclinic" id="dclinic" class="form-control dclinic bg-white">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <textarea name="daddress" class="form-control daddress" id="dadd" cols="20" rows="5"></textarea>
                                        <label for="dadd">Dr.Address</label>
                                    </div>
                                </div>


                            </div>


                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- add doctor modal --}}

    <div class="modal fade" id="adddoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('adddoctor/dadd') }}" method="POST">
                        @csrf
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="dname" placeholder="Full Name">
                                    <label>Doctor Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="demail"
                                        placeholder="name@example.com">
                                    <label>Doctor Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" name="dmobile" maxlength="10"
                                        placeholder="9574245123">
                                    <label>Doctor Mobile</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="dqual" placeholder="MBBS">
                                    <label>Doctor Qualification</label>
                                </div>
                            </div>
                        </div>

                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="mb-3">
                                    <fieldset class="form-control bg-white">
                                        <legend style="font-size: 15px;">Select Gender</legend>
                                        <input type="radio" name="dgen" id="male" value="M">
                                        <label for="male">Male</label>
                                        <input type="radio" name="dgen" id="female" value="F">
                                        <label for="female">Female</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="dpass" class="form-control" id="password"
                                        placeholder="Password">
                                    <label for="">Password</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="dcpass" class="form-control" id="cpassword"
                                        placeholder="Confirm password">
                                    <label for="">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center justify-content-center">

                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="mb-3">
                                    <select name="dclnc" id="dclnc" class="form-control bg-white">
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <textarea name="daddress" class="form-control" id="dadd" cols="20" rows="5"></textarea>
                                    <label for="dadd">Doctor Address</label>
                                </div>
                            </div>


                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="showpass()">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>

                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Register</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- delete doctor modal --}}
    <div class="modal fade" id="deletedoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('alldoctor/deldoc') }}" method="POST">
                        @csrf
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <select name="did" id="deldocnm" class="form-control bg-white"
                                        onchange="getdocdata(this.value)">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control dname" name="dname" disabled>
                                    <label>Dr.Name</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- change password modal --}}

    <div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('alldoctor/changepass') }}" method="POST">
                        @csrf

                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <select name="did" id="chngpass" class="form-control bg-white"
                                        onchange="getdocdata(this.value)">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <input type="password" name="dopass" class="form-control" id="dopass"
                                        placeholder="Password">
                                    <label for="">Old Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <input type="password" name="dnpass" class="form-control" id="dnpass"
                                        placeholder="New password">
                                    <label for="">New Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <input type="password" name="dcpass" class="form-control" id="dcpass"
                                        placeholder="Confirm password">
                                    <label for="">ConfirmPassword</label>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                    onclick="showdpass()">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>



    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/getclinic',
                type: 'get',
                success: function(res) {
                    $('#dclinic').html(res);
                }
            });

            $.ajax({
                url: '/getdoctor',
                type: 'get',
                // data: 'did=' + dctr + '&_token={{ csrf_token() }}',
                success: function(res) {
                    $('#udocnm').html(res);
                }
            });

            $.ajax({
                url: '/getdoctor',
                type: 'get',
                // data: 'did=' + dctr + '&_token={{ csrf_token() }}',
                success: function(res) {
                    $('#chngpass').html(res);
                }
            });

            $.ajax({
                url: '/getdoctor',
                type: 'get',
                // data: 'did=' + dctr + '&_token={{ csrf_token() }}',
                success: function(res) {
                    $('#deldocnm').html(res);
                }
            });

            $.ajax({
                url: '/getclinic',
                type: 'get',
                // data: 'pid=' + id + '&_token={{ csrf_token() }}',
                success: function(res) {
                    $('#dclnc').html(res);
                }
            });
        });

        function getdocdata(did) {
            $.ajax({
                url: '/getdocdetails',
                type: 'post',
                data: 'did=' + did + '&_token={{ csrf_token() }}',
                success: function(res) {
                    if (res) {
                        // alert(res['data']['dname']);
                        $('.dname').val(res['data'][0]['dname']);
                        $('.demail').val(res['data'][0]['demail']);
                        $('.dmobile').val(res['data'][0]['dmobile']);
                        $('.dqual').val(res['data'][0]['dqualification']);

                        if (res['data'][0]['dgender'] == 'M') {
                            $('.dgenm').attr('checked', true);
                        } else {
                            $('.dgenf').attr('checked', true);
                        }
                        $('.daddress').val(res['data'][0]['daddress']);
                        $('.dclinic').val(res['data'][0]['cname']).prop('selectedIndex', res['data'][0]['cid']);
                    }
                }
            });
        }
    </script>
@endsection
