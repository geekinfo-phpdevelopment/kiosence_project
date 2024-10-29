@extends('template')
@section('head')
    Permission | Kiosence
@endsection
@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Striped Table</h4>
                        <label class="col-sm-3 col-form-label">Select Role</label>
                        <form class="form-sample" method="POST" action="{{ route('permission.store') }}">
                            <div class="col-sm-2">
                                <select class="form-control" name="role" id="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="table-responsive">

                                @csrf
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                Module
                                            </th>
                                            <th>
                                                Read
                                            </th>
                                            <th>
                                                Create
                                            </th>
                                            <th>
                                                Update
                                            </th>
                                            <th>
                                                Delete
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($modules as $module)
                                            <?php $permission; ?>
                                            @foreach ($permissions as $permission1)
                                                @if ($permission1->module_id == $module->id)
                                                    <?php $permission = $permission1; ?>
                                                @endif
                                            @endforeach
                                            <tr>
                                                <td class="py-1">
                                                    {{ $module->name }}
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="read[{{ $module->id }}]"
                                                        class="form-check-input"
                                                        @if ($permission->read == 1) checked @endif>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="create[{{ $module->id }}]"
                                                        class="form-check-input"
                                                        @if ($permission->write == 1) checked @endif>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="update[{{ $module->id }}]"
                                                        class="form-check-input"
                                                        @if ($permission->edit == 1) checked @endif>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="delete[{{ $module->id }}]"
                                                        class="form-check-input"
                                                        @if ($permission->delete == 1) checked @endif>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-body-padding float-end">
                                    <button type="submit" class="btn btn-primary mb-2 text-white">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("change", "#role", function() {
                var val = $(this).val();
                console.log(val);
                $.ajax({
                    type: 'post',
                    url: '{{ url('api/get_permissions/') }}',
                    datatype: 'html',
                    data: {
                        "role": val
                    },
                    success: function(response) {
                        var parent = document.getElementById('tbody');
                        parent.innerHTML = response;

                    }
                });
            });

        });
    </script>
@endsection
