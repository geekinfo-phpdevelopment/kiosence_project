@extends('template')
@section('head')
    Stocks List | Kiosence
@endsection
@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Stocks</h4>
                        <div class="table-responsive">
                            <form class="forms-sample" method="POST" action="{{ route('stocks.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label">Medicine</label>
                                    <div class="col-sm-11">
                                        <select class="form-control" name="medicine">
                                            <option value="">Select Medicine</option>
                                            @foreach ($medicines as $medicine)
                                                <option value="{{ $medicine->id }}"
                                                    @if (old('medicine') == $medicine->id) selected @endif>
                                                    {{ $medicine->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('medicine'))
                                            <label class="form-check-label text-danger"
                                                for="medicine">{{ $errors->first('medicine') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Quantity</label>
                                    <div class="col-sm-11">
                                        <input type="number" name="quantity" class="form-control"
                                            value="{{ old('quantity') }}" />
                                        @if ($errors->has('quantity'))
                                            <label class="form-check-label text-danger"
                                                for="quantity">{{ $errors->first('quantity') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label">Exp Date</label>
                                    <input type="text" class="form-control" id="exp_date" data-date-format="dd/mm/yyyy"
                                        name="exp_date" value="{{ old('exp_date') }}">
                                    @if ($errors->has('exp_date'))
                                        <label class="form-check-label text-danger"
                                            for="exp_date">{{ $errors->first('exp_date') }}</label>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stocks List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Medicine</th>
                                        <th>Qauantity</th>
                                        <th>Stock Added</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($stocks as $stock)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $stock->medicine }}</td>
                                            <td>{{ $stock->quantity }}</td>
                                            <td>{{ date('d-m-Y', strtotime($stock->created_at)) }}</td>
                                            <td>
                                                @if ($stock->status == 1)
                                                    <label class="badge badge-outline-success">Active</label>
                                                @else
                                                    <label class="badge badge-outline-danger">Disabled</label>
                                                @endforelse
                                            </td>
                                            <td><a href="{{ route('stocks.edit', $stock) }}"><i
                                                        class="ti-pencil">Edit</i></a>
                                                @if ($stock->status == 1)
                                                    <a href="{{ route('stocks.disable', $stock) }}"><i
                                                            class="ti-lock">Disable</i></a>
                                                @else
                                                    <a href="{{ route('stocks.enable', $stock) }}"><i
                                                            class="ti-unlock">Enable</i></a>
                                                @endforelse
                                                <form action="{{ route('stocks.destroy', $stock) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <i class="ti-trash">
                                                        <button type="submit">
                                                            <span class="text">Delete</span>
                                                        </button>
                                                    </i>
                                                </form>

                                        </tr>
                                        <?php
                                        $i++;
                                        ?>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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
        $('#exp_date').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });

        $('#exp_date').datepicker("setDate", new Date());
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
