@extends('home')

@section('content')
<div class="container my-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">🍽️ Menu Management</h3>
        <a href="/menu/adding" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>+ Add Menu
        </a>
    </div>

    {{-- Filter + Search --}}
    <div class="card-body">
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <form action="/menu/searchfilter" method="get" role="search">
                    <select class="form-select" name="keyword" onchange="this.form.submit()">
                        <option class="text-center" value="">-- เลือกประเภทเมนู --</option>
                        <option value="food" {{ (request('keyword') == 'food') ? 'selected' : '' }}>🍛 Food</option>
                        <option value="beverage" {{ (request('keyword') == 'beverage') ? 'selected' : '' }}>🥤 Beverage</option>
                        <option value="sweet" {{ (request('keyword') == 'sweet') ? 'selected' : '' }}>🍰 Sweet</option>
                    </select>
                </form>
            </div>
            <div class="col-md-8">
                <form action="/menu/searchMenu" method="get" class="d-flex" role="search">
                    <input type="text" class="form-control me-2" name="keyword"
                        placeholder="🔍 Search menu name..."
                        value="{{ $keyword ?? '' }}" required>
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-info">
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="10%">Pic</th>
                        <th width="40%">Menu Name & Detail</th>
                        <th class="text-center" width="10%">Type</th>
                        <th class="text-center" width="15%">Price</th>
                        <th class="text-center" width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $row->menu_pic) }}" 
                                 class="rounded shadow-sm" width="80" height="80" 
                                 style="object-fit: cover;">
                        </td>
                        <td>
                            <h6 class="fw-bold mb-1">{{ $row->menu_name }}</h6>
                            <small class="text-muted">{{ Str::limit($row->menu_detail, 120, '...') }}</small>
                        </td>
                        <td class="text-center">
                            @if($row->menu_type == 'food')
                                <span class="badge" style="background-color:#ffb347; color:#fff;">
                                    {{ ucfirst($row->menu_type) }}
                                </span>
                            @elseif($row->menu_type == 'beverage')
                                <span class="badge" style="background-color:#7c48ec; color:#fff;">
                                    {{ ucfirst($row->menu_type) }}
                                </span>
                            @elseif($row->menu_type == 'sweet')
                                <span class="badge" style="background-color:#e86897; color:#fff;">
                                    {{ ucfirst($row->menu_type) }}
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    {{ ucfirst($row->menu_type) }}
                                </span>
                            @endif
                        </td>

                        <td class="text-end fw-bold text-success">
                            ฿{{ number_format($row->price, 2) }}
                        </td>
                        <td class="text-center">
                            <a href="/menu/{{ $row->menu_id }}" class="m-1 btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-danger m-1"
                                    onclick="deleteConfirm({{ $row->menu_id }})">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                            <form id="delete-form-{{ $row->menu_id }}"
                                  action="/menu/remove/{{$row->menu_id}}" method="POST" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No menu found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $menus->appends(request()->query())->links() }}
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'แน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้จริง ๆ หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>
@endsection
