@extends('template')

@section('head')
    Medicine List | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Medicine List</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <div class="card-body-padding float-end">
                            <a class="btn btn-primary btn-md text-white" href="{{ route('medicines.create') }}">
                                <i class="ti-plus"></i>
                                Add Medicine
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
                                            Name
                                        </th>
                                        <th>
                                            Brand
                                        </th>
                                        <th>
                                            Content
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($medicines as $medicine)
                                        <tr>
                                            <td class="py-1">
                                                {{ $i }}
                                            </td>
                                            <td>
                                                {{ $medicine->name }}
                                            </td>
                                            <td>
                                                {{ $medicine->brand }}
                                            </td>
                                            <td class="td-row">
                                                {{ $medicine->content }}
                                            </td>
                                            <td>
                                                @if ($medicine->status == 1)
                                                    <label class="badge badge-outline-success">Active</label>
                                                @else
                                                    <label class="badge badge-outline-danger">Disabled</label>
                                                @endforelse
                                            </td>
                                            <td><a href="{{ route('medicines.edit', $medicine) }}"><i
                                                        class="ti-pencil">Edit</i></a>
                                                @if ($medicine->status == 1)
                                                    <a href="{{ route('medicines.disable', $medicine) }}"><i
                                                            class="ti-lock">Disable</i></a>
                                                @else
                                                    <a href="{{ route('medicines.enable', $medicine) }}"><i
                                                            class="ti-unlock">Enable</i></a>
                                                @endforelse
                                                <form action="{{ route('medicines.destroy', $medicine) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <i class="ti-trash">
                                                        <button type="submit">
                                                            <span class="text">Delete</span>
                                                        </button>
                                                    </i>
                                                </form>
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
@endsection

@section('style')
    <style>
        .td-row {
            width:400px !important; 
            text-wrap:auto !important;
        }
    </style>
@endsection()
