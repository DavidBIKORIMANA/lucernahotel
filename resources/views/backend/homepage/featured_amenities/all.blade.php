@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">All Featured Amenities</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.featured.amenity') }}" class="btn btn-primary px-5">Add Featured Amenity</a>
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
                            <th>Icon Key</th>
                            <th>Name</th>
                            <th>Note</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($amenities as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->icon_key }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                @if($item->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('edit.featured.amenity', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('delete.featured.amenity', $item->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
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
