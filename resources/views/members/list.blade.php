@extends('home')

@section('content')
<div class="container my-4">

    <!-- Title -->
    <h2 class="text-center mb-4">👨‍💻 Member Management</h2>

    <!-- Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body row">
            <form action="/searchMember" method="get" class="row" role="search">
                <div class="col-md-10">
                    <input type="text" 
                           name="keyword" 
                           class="form-control" 
                           placeholder="🔍 Search Member Name" 
                           value="{{ $keyword ?? '' }}" required>
                </div>
                <div class="col-md-2 d-grid">
                   <button class="btn btn-success" type="submit">Search</button>
                </div>        
            </form>
        </div>
    </div>

    <!-- Add Member -->
    <div class="mb-3">
        <a href="/member/adding" class="btn btn-primary">
            + Add Member
        </a>
    </div>

    <!-- Member Table -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-info text-center">
                    <tr>
                        <th>No.</th>
                        <th>Pic</th>
                        <th>Details</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Edit</th>
                        <th>PWD</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $row->mem_pic) }}" 
                                 width="70" 
                                 class="rounded shadow-sm">
                        </td>
                        <td>
                            <b>Name:</b> {{ $row->mem_name }} <br>
                            <b>Username:</b> {{ $row->mem_username }} <br>
                            <b>Gender:</b> {{ $row->mem_gender }} <br>
                            <b>Point:</b> {{ $row->point }}
                        </td>
                        <td>{{ $row->mem_email }}</td>
                        <td>{{ $row->mem_phone }}</td>
                        <td class="text-center">
                            <a href="/member/{{ $row->mem_id }}" class="btn btn-warning btn-sm">
                                ✏ Edit
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="/member/reset/{{ $row->mem_id }}" class="btn btn-info btn-sm text-white">
                                🔑 Reset
                            </a>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->mem_id }})">
                                🗑 Delete
                            </button>
                            <form id="delete-form-{{ $row->mem_id }}" action="/member/remove/{{$row->mem_id}}" method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
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
