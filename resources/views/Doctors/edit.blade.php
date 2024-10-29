@extends('template')

@section('head')
    Edit Doctor | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Doctor</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <form class="form-sample" method="POST" action="{{ route('doctors.update',$doctor) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Doctor Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') == null ? $doctor->name : old('name') }}" />
                                            @if ($errors->has('name'))
                                                <label class="form-check-label text-danger"
                                                    for="name">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Specialization</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="specialization"
                                                value="{{ old('specialization') == null ? $doctor->specialization : old('specialization') }}" />
                                            @if ($errors->has('specialization'))
                                                <label class="form-check-label text-danger"
                                                    for="specialization">{{ $errors->first('specialization') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Qualification</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="qualification"
                                                value="{{ old('qualification') == null ? $doctor->qualification : old('qualification') }}" />
                                            @if ($errors->has('qualification'))
                                                <label class="form-check-label text-danger"
                                                    for="qualification">{{ $errors->first('qualification') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Hospital</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="hospital"
                                                value="{{ old('hospital') == null ? $doctor->hospital : old('hospital') }}" />
                                            @if ($errors->has('hospital'))
                                                <label class="form-check-label text-danger"
                                                    for="hospital">{{ $errors->first('hospital') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Place</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="place"
                                                value="{{ old('place') == null ? $doctor->place : old('place') }}" />
                                            @if ($errors->has('place'))
                                                <label class="form-check-label text-danger"
                                                    for="place">{{ $errors->first('place') }}</label>
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
                                                value="{{ old('email') == null ? $doctor->email : old('email') }}" />
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
                                                value="{{ old('mobile') == null ? $doctor->mobile : old('mobile') }}" />
                                            @if ($errors->has('mobile'))
                                                <label class="form-check-label text-danger"
                                                    for="mobile">{{ $errors->first('mobile') }}</label>
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
    <link rel="stylesheet"
        href=
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
        }

        $role input {
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
