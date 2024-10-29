@extends('template')

@section('head')
    Create User | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New User</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <form class="form-sample" method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ old('first_name') }}" />
                                            @if ($errors->has('first_name'))
                                                <label class="form-check-label text-danger"
                                                    for="first_name">{{ $errors->first('first_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ old('last_name') }}" />
                                            @if ($errors->has('last_name'))
                                                <label class="form-check-label text-danger"
                                                    for="last_name">{{ $errors->first('last_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Employee Id</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="employee_id"
                                                value="{{ old('employee_id') }}" />
                                            @if ($errors->has('employee_id'))
                                                <label class="form-check-label text-danger"
                                                    for="employee_id">{{ $errors->first('employee_id') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date of Joining</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="joining_date" class="form-control" id="datepicker"
                                                data-date-format="dd/mm/yyyy" value="{{ old('joining_date') }}" />
                                            @if ($errors->has('joining_date'))
                                                <label class="form-check-label text-danger"
                                                    for="joining_date">{{ $errors->first('joining_date') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email"
                                                value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <label class="form-check-label text-danger"
                                                    for="email">{{ $errors->first('email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Mobile</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mobile" class="form-control"
                                                value="{{ old('mobile') }}" />
                                            @if ($errors->has('mobile'))
                                                <label class="form-check-label text-danger"
                                                    for="mobile">{{ $errors->first('mobile') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option @if (old('gender') == 'Male') selected @endif>Male</option>
                                                <option @if (old('gender') == 'Female') selected @endif>Female</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <label class="form-check-label text-danger"
                                                    for="gender">{{ $errors->first('gender') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date of Birth</label>
                                        <div class="col-sm-9">

                                            <input type="text" class="form-control" id="dob"
                                                data-date-format="dd/mm/yyyy" name="dob" value="{{ old('dob') }}">
                                            @if ($errors->has('dob'))
                                                <label class="form-check-label text-danger"
                                                    for="dob">{{ $errors->first('dob') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Role</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="role">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        @if (old('role') == $role->id) selected @endif>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role'))
                                                <label class="form-check-label text-danger"
                                                    for="role">{{ $errors->first('role') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p class="card-description">
                                Address
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address 1</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adrl1"class="form-control"
                                                value="{{ old('adrl1') }}" />
                                            @if ($errors->has('adrl1'))
                                                <label class="form-check-label text-danger"
                                                    for="adrl1">{{ $errors->first('adrl1') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">State</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="state" class="form-control"
                                                value="{{ old('state') }}" />
                                            @if ($errors->has('state'))
                                                <label class="form-check-label text-danger"
                                                    for="state">{{ $errors->first('state') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="adrl2" class="form-control"
                                                value="{{ old('adrl2') }}" />
                                            @if ($errors->has('adrl2'))
                                                <label class="form-check-label text-danger"
                                                    for="adrl2">{{ $errors->first('adrl2') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Postcode</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="pincode" class="form-control"
                                                value="{{ old('pincode') }}" />
                                            @if ($errors->has('pincode'))
                                                <label class="form-check-label text-danger"
                                                    for="pincode">{{ $errors->first('pincode') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="city" class="form-control"
                                                value="{{ old('city') }}" />
                                            @if ($errors->has('city'))
                                                <label class="form-check-label text-danger"
                                                    for="city">{{ $errors->first('city') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body-padding float-end">
                                <button type="submit" class="btn btn-primary mb-2 text-white">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#dob').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());
        $('#dob').datepicker("setDate", new Date());
    </script>
@endsection

@section('style')
<link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .datepicker {
            font-size: 0.875em;
        }

        /* solution 2: the original datepicker use 20px so replace with the following:*/

        .datepicker td,
        .datepicker th {
            width: 1.5em;
            height: 1.5em;
        }$role

        input {
            position: relative;
            width: 150px;
            height: 20px;
            color: white;
        }

        input:before {
            position: absolute;
            top: 3px;
            left: 3px;
            content: attr(data-date);
            display: inline-block;
            color: black;
        }

        input::-webkit-datetime-edit,
        input::-webkit-inner-spin-button,
        input::-webkit-clear-button {
            display: none;
        }

        input::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 3px;
            right: 0;
            color: black;
            opacity: 1;
        }
    </style>
@endsection
