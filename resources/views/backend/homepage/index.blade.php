@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Homepage Content</li>
                </ol>
            </nav>
        </div>
    </div>
    <hr/>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Hero Slides</p>
                    <h4 class="my-1 text-info">{{ $hero_slides->count() }}</h4>
                    <a href="{{ route('all.hero.slides') }}" class="btn btn-sm btn-outline-info mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Hero Stats</p>
                    <h4 class="my-1 text-success">{{ $hero_stats->count() }}</h4>
                    <a href="{{ route('all.hero.stats') }}" class="btn btn-sm btn-outline-success mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <p class="mb-1 text-secondary">About Pillars</p>
                    <h4 class="my-1 text-warning">{{ $about_pillars->count() }}</h4>
                    <a href="{{ route('all.about.pillars') }}" class="btn btn-sm btn-outline-warning mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Amenities</p>
                    <h4 class="my-1 text-danger">{{ $amenities->count() }}</h4>
                    <a href="{{ route('all.amenities') }}" class="btn btn-sm btn-outline-danger mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-primary">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Dining Items</p>
                    <h4 class="my-1 text-primary">{{ $dining_items->count() }}</h4>
                    <a href="{{ route('all.dining.items') }}" class="btn btn-sm btn-outline-primary mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Event Features</p>
                    <h4 class="my-1 text-info">{{ $event_features->count() }}</h4>
                    <a href="{{ route('all.event.features') }}" class="btn btn-sm btn-outline-info mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-dark">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Featured Amenities</p>
                    <h4 class="my-1">{{ $featured_amenities->count() }}</h4>
                    <a href="{{ route('all.featured.amenities') }}" class="btn btn-sm btn-outline-dark mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-secondary">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Hotel Info</p>
                    <h4 class="my-1 text-secondary">{{ $hotel_infos->count() }}</h4>
                    <a href="{{ route('all.hotel.info') }}" class="btn btn-sm btn-outline-secondary mt-2">Manage</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Sections</p>
                    <h4 class="my-1 text-success">{{ $sections->count() }}</h4>
                    <a href="{{ route('homepage.sections') }}" class="btn btn-sm btn-outline-success mt-2">Edit Sections</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <p class="mb-1 text-secondary">Site Settings</p>
                    <h4 class="my-1 text-warning">1</h4>
                    <a href="{{ route('homepage.site.settings') }}" class="btn btn-sm btn-outline-warning mt-2">Edit Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
