@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Amenity</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Edit Amenity</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('amenity.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $amenity->id }}">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Icon Class *</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="icon" class="form-control" required value="{{ $amenity->icon }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Name *</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" required value="{{ $amenity->name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Description *</h6></div>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control" rows="3" required>{{ $amenity->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Sort Order</h6></div>
                                    <div class="col-sm-9">
                                        <input type="number" name="sort_order" class="form-control" value="{{ $amenity->sort_order }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Active</h6></div>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="status" {{ $amenity->status ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" class="btn btn-primary px-4" value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
