@extends('template')

@section('head')
    User List | Kiosence
@endsection

@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User List</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <div class="card-body-padding float-end">
                            <a class="btn btn-primary btn-md text-white" href="{{ route('users.create') }}">
                                <i class="ti-plus"></i>
                                Add User
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
                                            Email
                                        </th>
                                        <th>
                                            Mobile
                                        </th>
                                        <th>
                                            Role
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
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="py-1">
                                           {{$i}}
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->mobile}}
                                        </td>
                                        <td>
                                            {{$user->role}}
                                        </td>
                                        <td>
                                            @if ($user->status == 1)
                                                        <label class="badge badge-outline-success">Active</label>
                                                    @else
                                                        <label class="badge badge-outline-danger">Disabled</label>
                                                    @endforelse
                                        </td>
                                        <td><a href="{{route('users.edit', $user)}}"><i class="ti-pencil">Edit</i></a>
                                            @if ($user->status == 1)
                                                <a href="{{ route('users.disable', $user) }}"><i
                                                        class="ti-lock">Disable</i></a>
                                            @else
                                                <a href="{{ route('users.enable', $user) }}"><i
                                                        class="ti-unlock">Enable</i></a>
                                            @endforelse
                                            <form action="{{ route('users.destroy', $user) }}" method="POST">
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
