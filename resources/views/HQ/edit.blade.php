@extends('template')
@section('head')
    Head Quarters List | Kiosence
@endsection
@section('page')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Head Quarters</h4>
                        <div class="table-responsive">
                            <form class="forms-sample" method="POST" action="{{ route('hq.update', $quarters) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputUsername1"> Head Quarters Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $quarters->name }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Place </label>
                                    <input type="text" class="form-control" name="place" value="{{ $quarters->place }}"
                                        required>
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
                        <h4 class="card-title">Head Quarters List</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Head Quarters</th>
                                        <th>Place</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach ($hqs as $hq)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $hq->name }}</td>
                                            <td>{{ $hq->place }}</td>
                                            <td>{{ date('d-m-Y', strtotime($hq->created_at)) }}</td>
                                            <td>
                                                @if ($hq->status == 1)
                                                    <label class="badge badge-outline-success">Active</label>
                                                @else
                                                    <label class="badge badge-outline-danger">Disabled</label>
                                                @endforelse
                                            </td>
                                            <td><a href="{{ route('hq.edit', $hq) }}"><i class="ti-pencil">Edit</i></a>
                                                @if ($hq->status == 1)
                                                    <a href="{{ route('hq.disable', $hq) }}"><i
                                                            class="ti-lock">Disable</i></a>
                                                @else
                                                    <a href="{{ route('hq.enable', $hq) }}"><i
                                                            class="ti-unlock">Enable</i></a>
                                                @endforelse
                                                <form action="{{ route('hq.destroy', $hq) }}" method="POST">
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
