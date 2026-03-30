@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Sections</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('homepage.manage') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active">Edit Section Content</li>
                </ol>
            </nav>
        </div>
    </div>
    <hr/>

    <form action="{{ route('homepage.sections.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach($sections as $key => $section)
        <div class="card mb-3">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-capitalize"><i class="bx bx-edit"></i> {{ str_replace('_',' ',$key) }} Section</h6>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="sections[{{ $key }}][status]" id="status_{{ $key }}" {{ $section->status ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_{{ $key }}">
                        <span class="badge {{ $section->status ? 'bg-success' : 'bg-secondary' }}">{{ $section->status ? 'Visible' : 'Hidden' }}</span>
                    </label>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Eyebrow</label>
                        <input type="text" name="sections[{{ $key }}][eyebrow]" class="form-control" value="{{ $section->eyebrow }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Title <small class="text-muted">(HTML allowed: &lt;em&gt;, &lt;br&gt;)</small></label>
                        <input type="text" name="sections[{{ $key }}][title]" class="form-control" value="{{ $section->title }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <textarea name="sections[{{ $key }}][description]" class="form-control" rows="3">{{ $section->description }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Description 2</label>
                        <textarea name="sections[{{ $key }}][description_2]" class="form-control" rows="3">{{ $section->description_2 }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Badge Value</label>
                        <input type="text" name="sections[{{ $key }}][badge_value]" class="form-control" value="{{ $section->badge_value }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Badge Label</label>
                        <input type="text" name="sections[{{ $key }}][badge_label]" class="form-control" value="{{ $section->badge_label }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="sections[{{ $key }}][button_text]" class="form-control" value="{{ $section->button_text }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="sections[{{ $key }}][button_url]" class="form-control" value="{{ $section->button_url }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="sections[{{ $key }}][image]" class="form-control" accept="image/*">
                        @if($section->image)
                        <img src="{{ asset($section->image) }}" class="mt-2" style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="mb-4">
            <button type="submit" class="btn btn-primary px-5">Save All Sections</button>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(function(cb) {
    cb.addEventListener('change', function() {
        var badge = this.closest('.form-check').querySelector('.badge');
        if (this.checked) {
            badge.className = 'badge bg-success';
            badge.textContent = 'Visible';
        } else {
            badge.className = 'badge bg-secondary';
            badge.textContent = 'Hidden';
        }
    });
});
</script>

@endsection
