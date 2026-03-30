@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Featured Amenity</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Add Featured Amenity</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('featured.amenity.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Icon Key *</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="icon_key" class="form-control" required placeholder="e.g. garden, linen, business">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Name *</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" required placeholder="e.g. Lush Garden">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Note</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="note" class="form-control" placeholder="e.g. All Rooms & Suites">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Sort Order</h6></div>
                                    <div class="col-sm-9">
                                        <input type="number" name="sort_order" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Active</h6></div>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="status" checked>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" class="btn btn-primary px-4" value="Save">
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
