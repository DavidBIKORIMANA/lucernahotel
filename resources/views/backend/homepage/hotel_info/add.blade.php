@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Hotel Info</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Add Hotel Info</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('hotel.info.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Group *</h6></div>
                                    <div class="col-sm-9">
                                        <select name="group" class="form-select" required>
                                            <option value="">Select Group</option>
                                            <option value="Policies">Policies</option>
                                            <option value="Services">Services</option>
                                            <option value="Accessibility & Pet Policy">Accessibility & Pet Policy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Title *</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Detail</h6></div>
                                    <div class="col-sm-9">
                                        <textarea name="detail" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Icon</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="icon" class="form-control" placeholder="e.g. fas fa-clock">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Sort Order</h6></div>
                                    <div class="col-sm-9">
                                        <input type="number" name="sort_order" class="form-control" value="0">
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
