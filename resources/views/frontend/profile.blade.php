@extends('frontend.layouts.main')

@section('main-container')
    @if (session('prupdt'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session('prupdt') }}
        </div>
        {{ Session::forget('prupdt') }}
    @endif

    @if (session('prupdtfls'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session('prupdtfls') }}
        </div>
        {{ Session::forget('prupdtfls') }}
    @endif

    <div class="container mt-5 mb-5" id="profile">
        <div class="row">
            <div class="col-md-3 border-right">
                <div ><img class="rounded-circle mt-5"
                        width="150px" src="{{ url('frontend/images/profile_symbol.png') }}">
                    <p class="font-weight-bold"><b>{{ $data[0]['pname'] }}</b></p>
                </div>
            </div>
            <div class="col-md-5 border-right" id="prdetail">
                <div class="p-3 py-5">
                    <div>
                        <hr>
                        <h3 class="text-center">Profile Settings</h3>
                    </div>
                    <form action="/profile-update" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <input type="hidden" name="pid" value="{{ $data[0]['pid'] }}">
                                <label class="labels">Name</label>
                                <input type="text" class="form-control" placeholder="full name" name="pname"
                                    value="{{ $data[0]['pname'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Mobile</label>
                                <input type="tel" class="form-control" placeholder="Mobile" name="pmobile"
                                    maxlength="10" value="{{ $data[0]['pmobile'] }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="email" class="form-control" name="pemail" placeholder="enter email"
                                    value="{{ $data[0]['pemail'] }}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Age</label>
                                <input type="text" class="form-control" name="page" placeholder="Age"
                                    value="{{ $data[0]['page'] }}">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Gender</label>
                                <select name="pgen" class="form-control">
                                    <option value="M" @if ($data[0]['pgender'] == 'M') selected @endif>Male</option>
                                    <option value="F" @if ($data[0]['pgender'] == 'F') selected @endif>Female</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address</label>
                                <input type="text" name="paddress" class="form-control" placeholder="enter address line"
                                    value="{{ $data[0]['paddress'] }}">
                            </div>

                        </div>

                        <div class="row " id="prbtn">
                            <div class="col-md-6 col-sm-6 col-12">

                                    <a href="/dashboard" class="btn btn-primary profile-button" type="button">Back</a>

                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <button class="btn btn-primary profile-button" type="submit">Save
                                        Profile</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
