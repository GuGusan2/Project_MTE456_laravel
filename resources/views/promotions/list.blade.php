@extends('home')

@section('content')
<div class="container my-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-center mb-0">🏷️ Promotion</h3>
        <a href="/promotion/adding" class="btn btn-primary">
            + Add Promotion
        </a>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm rounded-3">
        <div class="card-body table-responsive ">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="15%">Pic</th>
                        <th width="30%">Detail</th>
                        <th width="30%">Condition</th>
                        <th width="10%">Valid Util</th>
                        <th class="text-center" width="5%">Edit</th>
                        <th class="text-center" width="5%">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promotions as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $row->pro_pic) }}" 
                                 class="rounded shadow-sm" width="120" height="80" 
                                 style="object-fit: cover;">
                        </td>
                        <td>
                            <small class="text-muted">
                                {{-- {{ Str::limit($row->detail, 120, '...') }} --}}
                                <p>{!! Str::limit(nl2br(e($row->detail)),120 ,' ...') !!}</p>
                            </small>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{-- {{ Str::limit($row->conditions, 120, '...') }} --}}
                                <p>{!! Str::limit(nl2br(e($row->conditions)),120,' ...') !!}</p>
                            </small>
                        </td>
                        <td class="text-end fw-bold text-success">
                            <small><b>start-date: </b>{{ date('d/m/Y', strtotime($row->start_date)) }}<br>
                                   <b>end-date: </b>{{ date('d/m/Y', strtotime($row->end_date)) }}<br>
                            </small>
                        </td>
                        
                        <td class="text-center">
                            <a href="/promotion/{{ $row->pro_id }}" class="btn btn-warning btn-sm">
                                ✏ Edit
                            </a>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->pro_id }})">
                                🗑 Delete
                            </button>
                            <form id="delete-form-{{ $row->pro_id }}" action="/promotion/remove/{{$row->pro_id}}" method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No menu found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $promotions->appends(request()->query())->links() }}
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
