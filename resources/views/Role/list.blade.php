@extends('template')
@section('head')
    Roles List | Kiosence
@endsection
@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Role</h4>
                        @if (Session::has('message'))
                            <div class="card-header border-1">
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('message') }}
                                </p>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <form class="forms-sample" method="POST" action="{{ route('role.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Role Name</label>
                                    <input type="text" class="form-control" name="role" placeholder="Role name"
                                        required>
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
                        <h4 class="card-title">Roles List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Role</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($role->created_at)) }}</td>
                                            <td>
                                                @if ($role->status == 1)
                                                    <label class="badge badge-outline-success">Active</label>
                                                @else
                                                    <label class="badge badge-outline-danger">Disabled</label>
                                                @endforelse
                                            </td>
                                            <td><a href="{{ route('role.edit', $role) }}"><i class="ti-pencil">Edit</i></a>
                                                @if ($role->status == 1)
                                                    <a href="{{ route('role.disable', $role) }}"><i
                                                            class="ti-lock">Disable</i></a>
                                                @else
                                                    <a href="{{ route('role.enable', $role) }}"><i
                                                            class="ti-unlock">Enable</i></a>
                                                @endforelse
                                                <form action="{{ route('role.destroy', $role) }}" method="POST">
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