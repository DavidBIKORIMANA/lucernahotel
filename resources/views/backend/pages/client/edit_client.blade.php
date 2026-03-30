@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('all.clients') }}">Clients</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Client</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.clients') }}" class="btn btn-secondary px-4">Back to List</a>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Edit Client Information</h5>
                            <form class="row g-3" action="{{ route('update.client', $client->id) }}" method="post">
                                @csrf

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $client->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $client->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', $client->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status"
                                            class="form-select @error('status') is-invalid @enderror">
                                        <option value="active" {{ old('status', $client->status) === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $client->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" rows="3"
                                              class="form-control @error('address') is-invalid @enderror">{{ old('address', $client->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Update Client</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <img src="{{ (!empty($client->photo)) ? url('upload/user_images/'.$client->photo) : url('upload/no_image.jpg') }}"
                                 alt="{{ $client->name }}" class="rounded-circle mb-3"
                                 style="width:120px; height:120px; object-fit:cover;">
                            <h5 class="mb-1">{{ $client->name }}</h5>
                            <p class="text-muted mb-2">{{ $client->email }}</p>
                            @if($client->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-warning text-dark">Inactive</span>
                            @endif
                            <hr>
                            <p class="text-muted mb-1" style="font-size:13px;">
                                Joined: {{ $client->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
