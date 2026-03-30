@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Site Settings</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Site Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('homepage.site.settings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Logo</h6></div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="logo" type="file" id="logo">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0"></h6></div>
                                    <div class="col-sm-9">
                                        @if($setting && $setting->logo)
                                            <img id="showLogo" src="{{ asset($setting->logo) }}" alt="Logo" style="max-width:200px; max-height:80px; object-fit:contain;">
                                        @else
                                            <img id="showLogo" src="" alt="" style="max-width:200px; max-height:80px; object-fit:contain; display:none;">
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Phone</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" value="{{ $setting->phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="address" class="form-control" value="{{ $setting->address ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" value="{{ $setting->email ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Facebook</h6></div>
                                    <div class="col-sm-9">
                                        <input type="url" name="facebook" class="form-control" value="{{ $setting->facebook ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Twitter</h6></div>
                                    <div class="col-sm-9">
                                        <input type="url" name="twitter" class="form-control" value="{{ $setting->twitter ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3"><h6 class="mb-0">Copyright</h6></div>
                                    <div class="col-sm-9">
                                        <input type="text" name="copyright" class="form-control" value="{{ $setting->copyright ?? '' }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" class="btn btn-primary px-4" value="Update Settings">
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

<script>
    $(document).ready(function(){
        $('#logo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){ $('#showLogo').attr('src', e.target.result).show(); }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
