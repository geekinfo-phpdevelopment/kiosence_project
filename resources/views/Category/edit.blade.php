@extends('template')
@section('head')
    Categories List | Kiosence
@endsection
@section('page')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Category</h4>
                            <div class="table-responsive">
                                <form class="forms-sample" method="POST" action="{{ route('category.update',$edit_category) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Category Name</label>
                                        <input type="text" class="form-control" name="category"
                                            value="{{ $edit_category->name }}" required>
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
                            <h4 class="card-title">Categories List</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Category</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($category->created_at)) }}</td>
                                                <td>
                                                    @if ($category->status == 1)
                                                        <label class="badge badge-outline-success">Active</label>
                                                    @else
                                                        <label class="badge badge-outline-danger">Disabled</label>
                                                    @endforelse
                                                </td>
                                                <td><a href="{{ route('category.edit', $category) }}"><i
                                                            class="ti-pencil">Edit</i></a>
                                                    @if ($category->status == 1)
                                                        <a href="{{ route('category.disable', $category) }}"><i
                                                                class="ti-lock">Disable</i></a>
                                                    @else
                                                        <a href="{{ route('category.enable', $category) }}"><i
                                                                class="ti-unlock">Enable</i></a>
                                                    @endforelse
                                                    <form action="{{ route('category.destroy', $category) }}" method="POST">
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
    </div>
@endsection
