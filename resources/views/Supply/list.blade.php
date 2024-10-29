@extends('template')

@section('head')
    Client List | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Supply List</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <div class="card-body-padding float-end">
                            <a class="btn btn-primary btn-md text-white" href="{{ route('supplies.create') }}">
                                <i class="ti-plus"></i>
                                Add Supply
                            </a>
                        </div>

                        <div class="table-responsive table-nxt">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Sl. No
                                        </th>
                                        <th>
                                            Client
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Total
                                        </th>
                                        <th>
                                            Due Date
                                        </th>
                                        <th>
                                            Payment Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($supplies as $supply)
                                        <tr>
                                            <td class="py-1">
                                                {{ $i }}
                                            </td>
                                            <td>
                                                {{ $supply->client }}
                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($supply->supply_date)) }}
                                            </td>
                                            <td>
                                                {{ $supply->total }}
                                            </td>
                                            <td>
                                                {{ date('d/m/Y', strtotime($supply->due_date)) }}
                                            </td>
                                            <td>
                                                @if ($supply->payment_status == 1)
                                                    <label class="badge badge-outline-success">Paid</label>
                                                @else
                                                    <label class="badge badge-outline-danger">Unpaid</label>
                                                @endforelse
                                            </td>
                                            <td>
                                                <div class="row">
                                                    {{-- <a class="btn btn-danger btn-rounded btn-icon text-light col-lg-6"
                                                        href="{{ route('supplies.edit', $supply) }}"><i
                                                            class="ti-pencil"></i></a> --}}
                                                    @if ($supply->payment_status == 1)
                                                        <button type="button"
                                                            class="btn btn-warning btn-rounded btn-md  text-light col-md-4"
                                                            onclick="confirmUnpayment('{{ route('supplies.unpaid', $supply->id) }}')">
                                                            <span class="text"><i class="ti-wallet"> Mark
                                                                    unpaid</i></span>
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                            onclick="confirmPayment('{{ route('supplies.paid', $supply->id) }}')"
                                                            class="btn btn-success btn-rounded btn-md text-light col-md-4">
                                                            <span class="text"><i class="ti-wallet"> Mark Paid</i></span>
                                                        </button>
                                                    @endforelse
                                                    <form action="{{ route('supplies.show', $supply) }}" class="col-md-2">
                                                        <button type="submit"
                                                            class="btn btn-success btn-rounded btn-md btn-icon text-light">
                                                            <span class="text"><i class="ti-eye"></i></span>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('supplies.edit', $supply) }}" class="col-md-2">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning btn-rounded btn-icon text-light">
                                                            <span class="text"><i class="ti-pencil"></i></span>
                                                        </button>

                                                    </form>
                                                    <form action="{{ route('supplies.destroy', $supply) }}" method="POST"
                                                        class="col-md-2">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="btn btn-danger btn-rounded btn-icon text-light">
                                                            <span class="text"><i class="ti-trash"></i></span>
                                                        </button>

                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Mark the Supply As paid?
                </div>
                <div class="modal-body">
                    Confiirm Payment!
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_paid" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="mark_paid" class="btn btn-success btn-ok text-light">Mark as paid</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_unpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Mark the Supply As Not Paid?
                </div>
                <div class="modal-body">
                    Confiirm not paid!
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_unpaid" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="mark_unpaid" class="btn btn-danger btn-ok text-light">Mark as not paid</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap.js"></script>
@endsection


@section('script')
    <script>
        function confirmPayment(value) {
            var modal = $("#confirm_payment");
            modal.modal("show");
            $("#close_paid").on("click", function() {
                modal.modal("hide");
            });
            var quantity_item = document.getElementById("mark_paid");
            quantity_item.href = value;
        }

        function confirmUnpayment(value) {
            var modal = $("#confirm_unpayment");
            modal.modal("show");
            $("#close_unpaid").on("click", function() {
                modal.modal("hide");
            });
            var quantity_item = document.getElementById("mark_unpaid");
            quantity_item.href = value;
        }
    </script>
@endsection
