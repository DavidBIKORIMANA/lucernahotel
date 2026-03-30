@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Facility Option</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Edit Facility Option</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('facility.option.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $option->id }}">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Facility Name *</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" required value="{{ $option->name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Sort Order</h6></div>
                                    <div class="col-sm-9">
                                        <input type="number" name="sort_order" class="form-control" value="{{ $option->sort_order }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Active</h6></div>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="status" {{ $option->status ? 'checked' : '' }}>
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
