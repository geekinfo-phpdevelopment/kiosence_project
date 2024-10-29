@extends('template')

@section('head')
    Supplier List | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Supplier List</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <div class="card-body-padding float-end">
                            <a class="btn btn-primary btn-md text-white" href="{{ route('suppliers.create') }}">
                                <i class="ti-plus"></i>
                                Add Supplier
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
                                            Supplier
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Mobile
                                        </th>
                                        <th>
                                            Contact Personal
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
                                    <?php $i=1; ?>
                                    @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td class="py-1">
                                           {{$i}}
                                        </td>
                                        <td>
                                            {{$supplier->name}}
                                        </td>
                                        <td>
                                            {{$supplier->email}}
                                        </td>
                                        <td>
                                            {{$supplier->mobile}}
                                        </td>
                                        <td>
                                            {{$supplier->contact_person}}
                                        </td>
                                        <td>
                                            @if ($supplier->status == 1)
                                                        <label class="badge badge-outline-success">Active</label>
                                                    @else
                                                        <label class="badge badge-outline-danger">Disabled</label>
                                                    @endforelse
                                        </td>
                                        <td><a href="{{route('suppliers.edit', $supplier)}}"><i class="ti-pencil">Edit</i></a>
                                            @if ($supplier->status == 1)
                                                <a href="{{ route('suppliers.disable', $supplier) }}"><i
                                                        class="ti-lock">Disable</i></a>
                                            @else
                                                <a href="{{ route('suppliers.enable', $supplier) }}"><i
                                                        class="ti-unlock">Enable</i></a>
                                            @endforelse
                                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST">
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
