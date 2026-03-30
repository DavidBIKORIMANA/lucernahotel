@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">All Hotel Info</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.hotel.info') }}" class="btn btn-primary px-5">Add Hotel Info</a>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Group</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Icon</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($infos as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><span class="badge bg-info">{{ $item->group }}</span></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ Str::limit($item->detail, 50) }}</td>
                            <td>{{ $item->icon }}</td>
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                <a href="{{ route('edit.hotel.info', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('delete.hotel.info', $item->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
