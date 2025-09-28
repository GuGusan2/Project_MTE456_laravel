@extends('home')

@section('content')
<div class="container my-4">

    <!-- Title -->
    <h2 class="text-center mb-4">🕵️‍♂️ Employee Management</h2>

    <!-- Filter + Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-body row">
            <div class="col-md-4">
                <form action="/employee/searchfilter" method="get" class="row" role="search">
                    <div class="col">
                        <select class="form-select" name="keyword" onchange="this.form.submit()">
                            <option value="">-- เลือก Role --</option>
                            <option value="staff" {{ request('keyword') == 'staff' ? 'selected' : '' }}>staff</option>
                            <option value="admin" {{ request('keyword') == 'admin' ? 'selected' : '' }}>admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="/employee/searchEmployee" method="get" class="row" role="search">
                    <div class="col">
                        <input type="text" 
                            name="keyword" 
                            class="form-control" 
                            placeholder="🔍 Search Employee Name" 
                            value="{{ $keyword ?? '' }}">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>        
                </form>
            </div>
        </div>
    </div>

    <!-- Add Employee -->
    <div class="mb-3">
        <a href="/employee/adding" class="btn btn-primary">
            + Add Employee
        </a>
    </div>

    <!-- Employee Table -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No.</th>
                        <th>Pic</th>
                        <th>Details</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>PWD</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/' . $row->emp_pic) }}" 
                                 width="70" 
                                 class="rounded shadow-sm">
                        </td>
                        <td>
                            <b>Name:</b> {{ $row->emp_name }} <br>
                            <b>Username:</b> {{ $row->emp_username }} <br>
                            <b>Gender:</b> {{ $row->emp_gender }}
                        </td>
                        <td>{{ $row->emp_email }}</td>
                        <td>{{ $row->emp_phone }}</td>
                        <td class="text-center">
                            <span class="badge {{ $row->role == 'admin' ? 'bg-danger' : 'bg-info text-dark' }}">
                                {{ $row->role }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="/employee/{{ $row->emp_id }}" class="btn btn-warning btn-sm">
                                ✏ Edit
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="/employee/reset/{{ $row->emp_id }}" class="btn btn-info btn-sm text-white">
                                🔑 Reset
                            </a>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirm({{ $row->emp_id }})">
                                🗑 Delete
                            </button>
                            <form id="delete-form-{{ $row->emp_id }}" action="/employee/remove/{{$row->emp_id}}" method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $employees->appends(request()->query())->links() }}
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
