@extends('template')

@section('head')
    Create Supply | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New Supply</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <form class="form-sample" method="POST" action="{{ route('supplies.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control datepicker" id="supply_date"
                                                data-date-format="dd/mm/yyyy" name="supply_date"
                                                value="{{ old('supply_date') }}" required />
                                            @if ($errors->has('supply_date'))
                                                <label class="form-check-label text-danger"
                                                    for="supply_date">{{ $errors->first('supply_date') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Head Quarters</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="hq" required>
                                                <option value="">Select Head Quarters</option>
                                                @foreach ($hqs as $hq)
                                                    <option value="{{ $hq->id }}"
                                                        @if (old('hq') == $hq->id) selected @endif>
                                                        {{ $hq->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('hq'))
                                                <label class="form-check-label text-danger"
                                                    for="hq">{{ $errors->first('hq') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Client</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="client" required>
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}"
                                                        @if (old('client') == $client->id) selected @endif>
                                                        {{ $client->company_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('client'))
                                                <label class="form-check-label text-danger"
                                                    for="client">{{ $errors->first('client') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Due date</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datepicker" id="due_date"
                                                data-date-format="dd/mm/yyyy" name="due_date"
                                                value="{{ old('due_date') }}" />
                                            @if ($errors->has('due_date'))
                                                <label class="form-check-label text-danger"
                                                    for="due_date">{{ $errors->first('due_date') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Payment Mode</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="payment_mode" required>
                                                <option value="">Select Payment Mode</option>
                                                <option @if (old('payment_mode') == 'Cash') selected @endif>Cash</option>
                                                <option @if (old('payment_mode') == 'Credit') selected @endif>Credit</option>
                                            </select>
                                            @if ($errors->has('payment_mode'))
                                                <label class="form-check-label text-danger"
                                                    for="payment_mode">{{ $errors->first('payment_mode') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Discount Type</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" onchange="updateData()" name="discount_type"
                                                id="discount_type">
                                                <option value="amount" @if (old('discount_type') == 'Amount') selected @endif>
                                                    Amount</option>
                                                <option value="percent" @if (old('discount_type') == 'Percentage') selected @endif>
                                                    Percentage
                                                </option>
                                            </select>
                                            @if ($errors->has('discount_type'))
                                                <label class="form-check-label text-danger"
                                                    for="discount_type">{{ $errors->first('discount_type') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Discount</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" onchange="updateData()"
                                                id="discount" name="discount"
                                                value="{{ old('discount') == null ? 0 : old('discount') }}" />
                                            @if ($errors->has('discount'))
                                                <label class="form-check-label text-danger"
                                                    for="discount">{{ $errors->first('discount') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>
                                            Sl No
                                        </td>
                                        <td>
                                            Item
                                        </td>
                                        <td>
                                            Quantity
                                        </td>
                                        <td>
                                            Subtotal
                                        </td>
                                        <td>
                                            SGst
                                        </td>
                                        <td>
                                            CGst
                                        </td>
                                        <td>
                                            Total GSt
                                        </td>
                                        <td>
                                            Total
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-rounded btn-icon"
                                                id="add_item">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="tble_item">
                                    <tr id="tr1">
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <select class="form-control" name="medicine[]" onchange="medicineChange(1)"
                                                id="medicine1">
                                                <option value="">Select Medicine</option>
                                                @foreach ($medicines as $medicine)
                                                    <option value="{{ $medicine->id }}" name="{{ $medicine->amount }}"
                                                        id="{{ $medicine->amount }}"
                                                        @if (old('medicine') == $medicine->id) selected @endif>
                                                        {{ $medicine->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" onchange="quantityChange(1)"
                                                id="quantity1" name="quantity[]" value="1" min="1" />
                                        </td>
                                        <td id="sub_total1">

                                        </td>
                                        <td id="sgst1">

                                        </td>
                                        <td id="cgst1">

                                        </td>
                                        <td id="tgst1">
                                        </td>
                                        <td id="total1">

                                        </td>
                                        <td>
                                            <button type="button" value="1"
                                                class="btn btn-danger btn-rounded btn-icon" id="remove_item"
                                                onclick="removeItem(this.value)">
                                                <i class="ti-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfooter>
                                    <tr id="bottom_tr">
                                        <td colspan="3" class="text-end">
                                            Total
                                        </td>
                                        <td id="sub_total">

                                        </td>
                                        <td id="sgst">

                                        </td>
                                        <td id="cgst">

                                        </td>
                                        <td id="tgst">
                                        </td>
                                        <td id="total">

                                        </td>

                                    </tr>
                                </tfooter>
                            </table>

                            <div class="row mb-4 mt-4">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-sm-3 col-md-5">Sub Total :</label>
                                        <p class="col-md-3" id="t_subtotal">0</p>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-md-5">Discount :</label>
                                        <p class="col-md-3" id="discount_value">0</p>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-md-5">After Discount :</label>
                                        <p class="col-md-3" id="discounted_amt">0</p>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-md-5">Tax Amount :</label>
                                        <p class="col-md-3" id="tax_amount">0</p>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <label class="col-sm-3 col-md-5">
                                            <h5><b>Grand Total : </b></h5>
                                        </label>
                                        <p class="col-md-3" id="grand_total">0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body-padding float-end">
                                <button type="submit" class="btn btn-primary mb-2 text-white">Add Supply</button>
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
        $('#supply_date').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#due_date').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#supply_date').datepicker("setDate", new Date());
        $('#due_date').datepicker("setDate", new Date());
    </script>
    <script>
        var table = document.getElementById('tble_item');
        var tax = 2.5;

        function removeItem(value) {
            document.getElementById("tr" + value).remove();
            updateData();
        }

        function medicineChange(value) {
            var count = table.childElementCount;
            d = document.getElementById("medicine" + value);
            var amount = d.options[d.selectedIndex].id;
            var quantity_item = document.getElementById("quantity" + value);
            var subtotalelement = document.getElementById("sub_total" + value);
            var sgst_element = document.getElementById("sgst" + value);
            var cgst_element = document.getElementById("cgst" + value);
            var tgst_element = document.getElementById("tgst" + value);
            var total_element = document.getElementById("total" + value);
            var quantity = quantity_item.value;
            var subtotal = amount * quantity;
            subtotalelement.innerHTML = subtotal;
            var sgst = subtotal * tax / 100;
            var cgst = subtotal * tax / 100;
            var tgst = sgst + cgst;
            sgst_element.innerHTML = sgst;
            cgst_element.innerHTML = cgst;
            tgst_element.innerHTML = tgst;
            var total = subtotal + tgst;
            total_element.innerHTML = total;
            updateData();

        }

        function quantityChange(value) {
            var quantity_item = document.getElementById("quantity" + value);
            var quantity = quantity_item.value;
            var subtotalelement = document.getElementById("sub_total" + value);
            var sgst_element = document.getElementById("sgst" + value);
            var cgst_element = document.getElementById("cgst" + value);
            var tgst_element = document.getElementById("tgst" + value);
            var total_element = document.getElementById("total" + value);
            var sel = document.getElementById("medicine" + value);
            var amount = sel.options[sel.selectedIndex].id;
            var subtotal = amount * quantity;
            var sgst = subtotal * tax / 100;
            var cgst = subtotal * tax / 100;
            var tgst = sgst + cgst;
            sgst_element.innerHTML = sgst;
            cgst_element.innerHTML = cgst;
            tgst_element.innerHTML = tgst;
            var total = subtotal + tgst;
            total_element.innerHTML = total;
            subtotalelement.innerHTML = subtotal;
            updateData();
        }

        function updateData() {
            var discount_element = document.getElementById("discount");
            var discount = discount_element.value;
            var discount_type_element = document.getElementById("discount_type");
            var discount_type = discount_type_element.options[discount_type_element.selectedIndex].value;

            var count = table.childElementCount;
            var m_subtotal = 0;
            var m_sgst = 0;
            var m_cgst = 0;
            var m_tgst = 0;
            var m_total = 0;
            console.log('count:' + count);
            for (let i = 1; i <= count; i++) {
                var subtotalelement1 = document.getElementById("sub_total" + i);
                var sgst_element1 = document.getElementById("sgst" + i);
                var cgst_element1 = document.getElementById("cgst" + i);
                var tgst_element1 = document.getElementById("tgst" + i);
                var total_element1 = document.getElementById("total" + i);
                let subT = subtotalelement1.innerHTML;
                m_subtotal += parseFloat(subT);
                m_sgst += parseFloat(sgst_element1.innerHTML);
                m_cgst += parseFloat(cgst_element1.innerHTML);
                m_tgst += parseFloat(tgst_element1.innerHTML);
                m_total += parseFloat(total_element1.innerHTML);
            }
            document.getElementById("sub_total").innerHTML = m_subtotal;
            document.getElementById("sgst").innerHTML = m_sgst;
            document.getElementById("cgst").innerHTML = m_cgst;
            document.getElementById("tgst").innerHTML = m_tgst;
            document.getElementById("total").innerHTML = m_total;
            var discount_amount = 0;
            if (discount_type == "amount") {
                discount_amount = discount;
            } else {
                discount_amount = parseFloat(m_subtotal) / 100 * parseFloat(discount);
            }
            document.getElementById("discount_value").innerHTML = "₹" + discount_amount;
            document.getElementById("t_subtotal").innerHTML = "₹" + m_subtotal;
            var discounted_amount = parseFloat(m_subtotal) - discount_amount;
            var tax_amount = parseFloat(tax) * 2 * discounted_amount / 100;
            document.getElementById("discounted_amt").innerHTML = "₹" + discounted_amount;
            document.getElementById("tax_amount").innerHTML = "₹" + tax_amount;
            var grand_total = discounted_amount + tax_amount;
            document.getElementById("grand_total").innerHTML = "<h5><b> ₹" + grand_total + "</b></h5>";
        }
        $(document).ready(function() {
            add_item.addEventListener('click', function() {
                var count = table.childElementCount;
                var index = count + 1;
                bmcontainer = document.getElementById("bottom_tr");
                table.insertAdjacentHTML("beforeend",
                    '<tr id="tr' + index + '"><td>' + index +
                    '</td> <td ><select class = "form-control" name = "medicine[]" id = "medicine' +
                    index +
                    '" onchange="medicineChange(' + index +
                    ')" ><option value = "" > Select Medicine </option> @foreach ($medicines as $medicine)    <option value = "{{ $medicine->id }}"    name = "{{ $medicine->amount }}"    id = "{{ $medicine->amount }}"    @if (old('medicine') == $medicine->id) selected @endif >        {{ $medicine->name }} </option> @endforeach </select> </td> <td ><input type = "number" onchange="quantityChange(' +
                    index + ')" class = "form-control"id = "quantity' +
                    index + '" name = "quantity[]" value = "1" min = "1" / ></td> <td id = "sub_total' +
                    index + '" ></td> <td id = "sgst' + index + '" ></td> <td id = "cgst' + index +
                    '" ></td> <td id = "tgst' + index + '" ></td> <td id = "total' + index +
                    '" ></td> <td ><button type = "button" value="' +
                    index +
                    '" class = "btn btn-danger btn-rounded btn-icon" id = "remove_item" onclick="removeItem(this.value)" ><i class = "ti-close" > </i> </button> </td> </tr>'
                );
            }, true);
        });
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
