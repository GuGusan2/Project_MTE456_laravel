@extends('home')

@section('content')
    <div class="container my-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">🍽️ Menu Management</h3>
            <a href="/menu/adding" class="btn btn-primary">
                + Add Menu
            </a>
        </div>

        {{-- Filter + Search --}}
        <div class="card-body">
            <div class="g-2 mb-3">
                <form action="/menu/searchfilter" method="get">
                    <div class="row g-2 mb-3">
                        <div class="col-md-3 col-lg-2 col-sm-12">
                            <select class="form-select" name="menu_type">
                                <option class="text-center" value="">-- เลือกประเภทเมนู --</option>
                                <option value="food" {{ request('menu_type') == 'food' ? 'selected' : '' }}>🍛 Food
                                </option>
                                <option value="beverage" {{ request('menu_type') == 'beverage' ? 'selected' : '' }}>🥤
                                    Beverage</option>
                                <option value="sweet" {{ request('menu_type') == 'sweet' ? 'selected' : '' }}>🍰 Sweet
                                </option>
                            </select>
                        </div>
                        <div class="col-md-5 col-lg-6 col-sm-12">
                            <input type="text" class="form-control me-2" name="search"
                                placeholder="🔍 Search menu name..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2 d-grid col-lg-2 col-sm-12">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                        <div class="col-md-2 col-lg-2 col-sm-12">
                            <a href="/menu" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="card shadow-sm rounded-3">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
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
                                    <img src="{{ asset('storage/' . $row->menu_pic) }}" class="rounded shadow-sm"
                                        width="80" height="80" style="object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="fw-bold mb-1">{{ $row->menu_name }}</h6>
                                    <small class="text-muted">{{ Str::limit($row->menu_detail, 120, '...') }}</small>
                                </td>
                                <td class="text-center">
                                    @if ($row->menu_type == 'food')
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
                                    <form id="delete-form-{{ $row->menu_id }}" action="/menu/remove/{{ $row->menu_id }}"
                                        method="POST" style="display: none;">
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
