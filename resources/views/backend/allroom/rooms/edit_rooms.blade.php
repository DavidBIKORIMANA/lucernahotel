@extends('admin.admin_dashboard')
@section('admin')

@push('styles')
<style>
  .page-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;}
  .page-top-left{display:flex;flex-direction:column;gap:4px;}
  .page-title{font-family:var(--font-display);font-size:26px;font-weight:500;color:var(--text-1);}
  .page-title span{color:var(--gold);}
  .page-breadcrumb-custom{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-3);}
  .page-breadcrumb-custom a{color:var(--text-3);text-decoration:none;transition:color var(--transition);}
  .page-breadcrumb-custom a:hover{color:var(--gold);}
  .bc-sep{color:var(--text-3);opacity:.5;}

  /* Tabs */
  .rm-tabs{display:flex;gap:2px;margin-bottom:24px;background:var(--bg-card);border:1px solid var(--border2);border-radius:12px;padding:4px;backdrop-filter:blur(6px);overflow-x:auto;}
  .rm-tab{padding:10px 20px;border-radius:9px;font-size:13px;font-weight:500;color:var(--text-3);cursor:pointer;transition:all var(--transition);white-space:nowrap;border:none;background:transparent;font-family:var(--font-ui);}
  .rm-tab:hover{color:var(--text-1);background:rgba(255,255,255,.06);}
  .rm-tab.active{background:var(--gold);color:#042a5e;font-weight:600;}
  .rm-tab-content{display:none;}
  .rm-tab-content.active{display:block;}

  /* Cards */
  .rm-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:28px 32px;backdrop-filter:blur(6px);margin-bottom:20px;}
  .rm-card h5{font-family:var(--font-display);font-size:20px;font-weight:500;color:var(--text-1);margin-bottom:24px;padding-bottom:12px;border-bottom:1px solid var(--border2);}

  /* Fields */
  .form-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
  .form-grid.cols-2{grid-template-columns:1fr 1fr;}
  .form-grid.cols-1{grid-template-columns:1fr;}
  .field{margin-bottom:0;}
  .field.span-2{grid-column:span 2;}
  .field.span-3{grid-column:span 3;}
  .field label{display:block;font-size:12px;font-weight:500;color:var(--text-3);margin-bottom:6px;letter-spacing:.3px;}
  .field input,.field select,.field textarea{width:100%;padding:10px 14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:var(--radius-sm);color:#fff;font-family:var(--font-ui);font-size:13px;outline:none;transition:border-color var(--transition),background var(--transition);}
  .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--gold);background:rgba(255,255,255,.12);}
  .field input::placeholder,.field textarea::placeholder{color:rgba(255,255,255,.35);}
  .field select option{background:#0e1422;color:#fff;}
  .field textarea{min-height:100px;resize:vertical;}

  /* Image preview */
  .img-preview-wrap{display:flex;align-items:center;gap:12px;margin-top:10px;}
  .img-preview{width:80px;height:60px;object-fit:cover;border-radius:8px;border:1px solid var(--border2);}
  .gallery-grid{display:flex;flex-wrap:wrap;gap:10px;margin-top:10px;}
  .gallery-thumb{position:relative;width:80px;height:60px;border-radius:8px;overflow:hidden;border:1px solid var(--border2);}
  .gallery-thumb img{width:100%;height:100%;object-fit:cover;}
  .gallery-thumb .del-badge{position:absolute;top:2px;right:2px;width:20px;height:20px;background:var(--danger);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;text-decoration:none;transition:transform .15s;}
  .gallery-thumb .del-badge:hover{transform:scale(1.15);}

  /* Facility tags */
  .facility-row{display:flex;align-items:center;gap:10px;margin-bottom:10px;}
  .facility-row select{flex:1;}
  .icon-btn-sm{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid;cursor:pointer;font-size:14px;transition:background var(--transition),transform .15s;flex-shrink:0;background:transparent;}
  .icon-btn-sm:hover{transform:translateY(-1px);}
  .icon-btn-sm.add{color:var(--success);border-color:rgba(76,175,125,.3);}
  .icon-btn-sm.add:hover{background:rgba(76,175,125,.15);}
  .icon-btn-sm.remove{color:var(--danger);border-color:rgba(224,82,82,.3);}
  .icon-btn-sm.remove:hover{background:rgba(224,82,82,.15);}

  /* Room Numbers Table */
  .rn-table{width:100%;border-collapse:collapse;margin-top:16px;}
  .rn-table th{padding:10px 16px;font-size:10.5px;letter-spacing:1px;text-transform:uppercase;color:var(--text-3);font-weight:600;border-bottom:1px solid var(--border2);text-align:left;}
  .rn-table td{padding:12px 16px;font-size:13px;color:var(--text-2);border-bottom:1px solid rgba(255,255,255,.04);}
  .rn-table tr:hover td{background:rgba(255,255,255,.04);}
  .status-dot{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:500;}
  .status-dot::before{content:'';width:7px;height:7px;border-radius:50%;}
  .status-dot.active::before{background:var(--success);}
  .status-dot.active{color:var(--success);}
  .status-dot.inactive::before{background:var(--danger);}
  .status-dot.inactive{color:var(--danger);}

  .rn-action{display:inline-flex;align-items:center;gap:4px;padding:5px 12px;border-radius:6px;font-size:11px;font-weight:600;text-decoration:none;border:1px solid;transition:background var(--transition);}
  .rn-action.edit{color:var(--warning);border-color:rgba(232,155,58,.2);background:rgba(232,155,58,.06);}
  .rn-action.edit:hover{background:rgba(232,155,58,.15);}
  .rn-action.delete{color:var(--danger);border-color:rgba(224,82,82,.2);background:rgba(224,82,82,.06);}
  .rn-action.delete:hover{background:rgba(224,82,82,.15);}

  /* Inline add form */
  .rn-add-form{display:none;background:rgba(255,255,255,.04);border:1px solid var(--border2);border-radius:10px;padding:16px 20px;margin-bottom:16px;}
  .rn-add-form.show{display:block;}
  .rn-add-grid{display:grid;grid-template-columns:1fr 1fr auto;gap:12px;align-items:end;}

  /* Buttons */
  .btn-gold{padding:10px 28px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background var(--transition),transform .15s;}
  .btn-gold:hover{background:var(--gold-light);transform:translateY(-1px);}
  .btn-outline{padding:10px 20px;border-radius:10px;background:transparent;color:var(--text-2);font-size:13px;font-weight:500;border:1px solid var(--border2);cursor:pointer;transition:background var(--transition);text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
  .btn-outline:hover{background:var(--bg-hover);color:var(--text-1);}

  @media(max-width:900px){.form-grid{grid-template-columns:1fr;}.field.span-2,.field.span-3{grid-column:span 1;}.rn-add-grid{grid-template-columns:1fr;}}
</style>
@endpush

<!-- Page Top -->
<div class="page-top">
  <div class="page-top-left">
    @php $isHall = ($editData->type->type ?? '') === 'Hall'; @endphp
    <div class="page-title">Edit <span>{{ $isHall ? 'Hall' : 'Room' }}</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:13px;height:13px;"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <a href="{{ route('room.type.list') }}">Room Types</a>
      <span class="bc-sep">/</span>
      <span>{{ $editData->type->name ?? 'Edit' }} ({{ $isHall ? 'Hall' : 'Room' }})</span>
    </div>
  </div>
</div>

<!-- Tabs -->
<div class="rm-tabs">
  <button class="rm-tab active" onclick="switchTab(this,'tab-details')">{{ $isHall ? 'Hall' : 'Room' }} Details</button>
  <button class="rm-tab" onclick="switchTab(this,'tab-images')">Photos & Gallery</button>
  <button class="rm-tab" onclick="switchTab(this,'tab-facilities')">Facilities</button>
  <button class="rm-tab" onclick="switchTab(this,'tab-roomnos')">{{ $isHall ? 'Hall' : 'Room' }} Numbers</button>
</div>

<form action="{{ route('update.room', $editData->id) }}" method="post" enctype="multipart/form-data" id="roomForm">
  @csrf

  <!-- Tab 1: Room Details -->
  <div class="rm-tab-content active" id="tab-details">
    <div class="rm-card">
      <h5>{{ $isHall ? 'Hall' : 'Room' }} Information</h5>
      <div class="form-grid">
        <div class="field">
          <label>{{ $isHall ? 'Hall' : 'Room' }} Type</label>
          <input type="text" value="{{ ($editData->type->name ?? '') }} ({{ $isHall ? 'Hall' : 'Room' }})" disabled>
        </div>
        <div class="field">
          <label>Room Capacity</label>
          <input type="number" name="room_capacity" value="{{ $editData->room_capacity }}" placeholder="Max guests" min="1">
        </div>
        <div class="field">
          <label>Total Children Allowed</label>
          <input type="number" name="total_child" value="{{ $editData->total_child }}" placeholder="0" min="0">
        </div>
        <div class="field">
          <label>Price per Night ($)</label>
          <input type="number" name="price" value="{{ $editData->price }}" step="0.01" min="0" placeholder="0.00">
        </div>
        <div class="field">
          <label>Discount (%)</label>
          <input type="number" name="discount" value="{{ $editData->discount }}" min="0" max="100" placeholder="0">
        </div>
        @if(!$isHall)
        <div class="field">
          <label>Bed Style</label>
          <select name="bed_style">
            <option value="">Choose…</option>
            <option value="Queen Bed" {{ $editData->bed_style == 'Queen Bed' ? 'selected' : '' }}>Queen Bed</option>
            <option value="Twin Bed" {{ $editData->bed_style == 'Twin Bed' ? 'selected' : '' }}>Twin Bed</option>
            <option value="King Bed" {{ $editData->bed_style == 'King Bed' ? 'selected' : '' }}>King Bed</option>
          </select>
        </div>
        @endif
        <div class="field span-3">
          <label>{{ $isHall ? 'Hall Package' : 'Room Package' }}</label>
          <select name="view">
            <option value="">Choose…</option>
            <option value="Complimentary Breakfast" {{ $editData->view == 'Complimentary Breakfast' ? 'selected' : '' }}>Complimentary Breakfast</option>
            <option value="Minibar" {{ $editData->view == 'Minibar' ? 'selected' : '' }}>Minibar</option>
            <option value="Free Wi-Fi" {{ $editData->view == 'Free Wi-Fi' ? 'selected' : '' }}>Free Wi-Fi</option>
            <option value="Smart Meeting room" {{ $editData->view == 'Smart Meeting room' ? 'selected' : '' }}>Smart Meeting Room</option>
            <option value="Laundry & Dry Cleaning" {{ $editData->view == 'Laundry & Dry Cleaning' ? 'selected' : '' }}>Laundry & Dry Cleaning</option>
          </select>
        </div>
        <div class="field span-3">
          <label>Short Description</label>
          <textarea name="short_desc" rows="3" placeholder="Brief overview…">{{ $editData->short_desc }}</textarea>
        </div>
        <div class="field span-3">
          <label>Full Description</label>
          <textarea name="description" id="myeditorinstance" rows="6">{!! $editData->description !!}</textarea>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab 2: Photos & Gallery -->
  <div class="rm-tab-content" id="tab-images">
    <div class="rm-card">
      <h5>Main Photo</h5>
      <div class="form-grid cols-1">
        <div class="field">
          <label>{{ $isHall ? 'Hall' : 'Room' }} Main Image</label>
          <input type="file" name="image" id="mainImage" accept="image/*">
          <div class="img-preview-wrap">
            <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/roomimg/'.$editData->image) : url('upload/no_image.jpg') }}" class="img-preview" alt="Main">
            <span style="font-size:11px;color:var(--text-3);">Recommended: 550 × 850px</span>
          </div>
        </div>
      </div>
    </div>
    <div class="rm-card">
      <h5>Gallery Photos</h5>
      <div class="form-grid cols-1">
        <div class="field">
          <label>Add Gallery Images</label>
          <input type="file" name="multi_img[]" id="multiImg" multiple accept="image/*">
          <div class="gallery-grid" id="preview_img">
            @foreach ($multiimgs as $item)
            <div class="gallery-thumb">
              <img src="{{ (!empty($item->multi_img)) ? url('upload/roomimg/multi_img/'.$item->multi_img) : url('upload/no_image.jpg') }}" alt="Gallery">
              <a href="{{ route('multi.image.delete', $item->id) }}" class="del-badge" title="Delete">×</a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab 3: Facilities -->
  <div class="rm-tab-content" id="tab-facilities">
    <div class="rm-card">
      <h5>{{ $isHall ? 'Hall' : 'Room' }} Facilities</h5>
      <div id="facilitiesContainer">
        @forelse ($basic_facility as $item)
        <div class="facility-row">
          <select name="facility_name[]">
            <option value="">Select Facility</option>
            @foreach(['Complimentary Breakfast','32/42 inch LED TV','Smoke alarms','Minibar','Work Desk','Free Wi-Fi','Safety box','Rain Shower','Slippers','Hair dryer','Wake-up service','Laundry & Dry Cleaning','Electronic door lock'] as $fac)
            <option value="{{ $fac }}" {{ $item->facility_name == $fac ? 'selected' : '' }}>{{ $fac }}</option>
            @endforeach
          </select>
          <span class="icon-btn-sm add" onclick="addFacility()">+</span>
          <span class="icon-btn-sm remove" onclick="removeFacility(this)">−</span>
        </div>
        @empty
        <div class="facility-row">
          <select name="facility_name[]">
            <option value="">Select Facility</option>
            @foreach(['Complimentary Breakfast','32/42 inch LED TV','Smoke alarms','Minibar','Work Desk','Free Wi-Fi','Safety box','Rain Shower','Slippers','Hair dryer','Wake-up service','Laundry & Dry Cleaning','Electronic door lock'] as $fac)
            <option value="{{ $fac }}">{{ $fac }}</option>
            @endforeach
          </select>
          <span class="icon-btn-sm add" onclick="addFacility()">+</span>
          <span class="icon-btn-sm remove" onclick="removeFacility(this)">−</span>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- Save Button (visible on all tabs) -->
  <div style="margin-top:8px;margin-bottom:24px;">
    <button type="submit" class="btn-gold">Save Changes</button>
  </div>
</form>

<!-- Tab 4: Room Numbers (separate, not inside the form) -->
<div class="rm-tab-content" id="tab-roomnos">
  <div class="rm-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
      <h5 style="margin-bottom:0;border:none;padding-bottom:0;">{{ $isHall ? 'Hall' : 'Room' }} Numbers</h5>
      <button class="btn-outline" onclick="document.getElementById('rnAddForm').classList.toggle('show')" type="button">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Room No.
      </button>
    </div>

    <div class="rn-add-form" id="rnAddForm">
      <form action="{{ route('store.room.no', $editData->id) }}" method="post">
        @csrf
        <input type="hidden" name="room_type_id" value="{{ $editData->roomtype_id }}">
        <div class="rn-add-grid">
          <div class="field">
            <label>{{ $isHall ? 'Hall' : 'Room' }} Number</label>
            <input type="text" name="room_no" placeholder="e.g. 101" required>
          </div>
          <div class="field">
            <label>Status</label>
            <select name="status" required>
              <option value="">Select…</option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
          <button type="submit" class="btn-gold" style="height:42px;">Save</button>
        </div>
      </form>
    </div>

    <table class="rn-table">
      <thead>
        <tr>
          <th>Room No.</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($allroomNo as $item)
        <tr>
          <td style="font-weight:600;color:var(--text-1);">{{ $item->room_no }}</td>
          <td><span class="status-dot {{ strtolower($item->status) }}">{{ $item->status }}</span></td>
          <td>
            <a href="{{ route('edit.roomno', $item->id) }}" class="rn-action edit">Edit</a>
            <a href="{{ route('delete.roomno', $item->id) }}" class="rn-action delete" id="delete">Delete</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" style="text-align:center;color:var(--text-3);padding:24px;">No room numbers added yet.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@push('scripts')
<script>
function switchTab(btn, tabId) {
  document.querySelectorAll('.rm-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.rm-tab-content').forEach(c => c.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById(tabId).classList.add('active');
}

// Main image preview
document.getElementById('mainImage')?.addEventListener('change', function(e) {
  if (this.files[0]) {
    const reader = new FileReader();
    reader.onload = ev => document.getElementById('showImage').src = ev.target.result;
    reader.readAsDataURL(this.files[0]);
  }
});

// Multi image preview
document.getElementById('multiImg')?.addEventListener('change', function() {
  const container = document.getElementById('preview_img');
  Array.from(this.files).forEach(file => {
    if (/image/i.test(file.type)) {
      const reader = new FileReader();
      reader.onload = e => {
        const div = document.createElement('div');
        div.className = 'gallery-thumb';
        div.innerHTML = '<img src="' + e.target.result + '" alt="New">';
        container.appendChild(div);
      };
      reader.readAsDataURL(file);
    }
  });
});

// Facilities add/remove
function addFacility() {
  const row = document.querySelector('.facility-row');
  const clone = row.cloneNode(true);
  clone.querySelector('select').value = '';
  document.getElementById('facilitiesContainer').appendChild(clone);
}
function removeFacility(btn) {
  const container = document.getElementById('facilitiesContainer');
  if (container.querySelectorAll('.facility-row').length > 1) {
    btn.closest('.facility-row').remove();
  }
}
</script>
@endpush
@endsection
