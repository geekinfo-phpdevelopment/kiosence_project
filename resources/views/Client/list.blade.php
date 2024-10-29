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
                        <h4 class="card-title">Client List</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <div class="card-body-padding float-end">
                            <a class="btn btn-primary btn-md text-white" href="{{ route('clients.create') }}">
                                <i class="ti-plus"></i>
                                Add Client
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
                                            Comapnay Name
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
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td class="py-1">
                                           {{$i}}
                                        </td>
                                        <td>
                                            {{$client->company_name}}
                                        </td>
                                        <td>
                                            {{$client->email}}
                                        </td>
                                        <td>
                                            {{$client->mobile}}
                                        </td>
                                        <td>
                                            {{$client->contact_person}}
                                        </td>
                                        <td>
                                            @if ($client->status == 1)
                                                        <label class="badge badge-outline-success">Active</label>
                                                    @else
                                                        <label class="badge badge-outline-danger">Disabled</label>
                                                    @endforelse
                                        </td>
                                        <td><a href="{{route('clients.edit', $client)}}"><i class="ti-pencil">Edit</i></a>
                                            @if ($client->status == 1)
                                                <a href="{{ route('clients.disable', $client) }}"><i
                                                        class="ti-lock">Disable</i></a>
                                            @else
                                                <a href="{{ route('clients.enable', $client) }}"><i
                                                        class="ti-unlock">Enable</i></a>
                                            @endforelse
                                            <form action="{{ route('clients.destroy', $client) }}" method="POST">
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