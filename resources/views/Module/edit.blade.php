@extends('template')
@section('head')
    Modules List | Kiosence
@endsection
@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Module</h4>
                        <div class="table-responsive">
                            <form class="forms-sample" method="POST" action="{{ route('module.update', $edit_module) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Module Name</label>
                                    <input type="text" class="form-control" name="module"
                                        value="{{ $edit_module->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Slug </label>
                                    <input type="text" class="form-control" name="slug"
                                        value="{{ $edit_module->slug }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Icon </label>
                                    <input type="text" class="form-control" name="icon"
                                        value="{{ $edit_module->icon }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Modules List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Module</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($modules as $module)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $module->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($module->created_at)) }}</td>
                                            <td>
                                                @if ($module->status == 1)
                                                    <label class="badge badge-outline-success">Active</label>
                                                @else
                                                    <label class="badge badge-outline-danger">Disabled</label>
                                                @endforelse
                                            </td>
                                            <td><a href="{{ route('module.edit', $module) }}"><i
                                                        class="ti-pencil">Edit</i></a>
                                                @if ($module->status == 1)
                                                    <a href="{{ route('module.disable', $module) }}"><i
                                                            class="ti-lock">Disable</i></a>
                                                @else
                                                    <a href="{{ route('module.enable', $module) }}"><i
                                                            class="ti-unlock">Enable</i></a>
                                                @endforelse
                                                <form action="{{ route('module.destroy', $module) }}" method="POST">
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
