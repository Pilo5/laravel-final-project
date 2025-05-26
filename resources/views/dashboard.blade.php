<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        .nav-links {
            text-align: center;
            margin-bottom: 20px;
        }
        .nav-links a {
            margin: 0 10px;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .nav-links a:nth-child(1) {
            background-color: #007bff;
            color: white;
        }
        .nav-links a:nth-child(2) {
            background-color: #ffc107;
            color: black;
        }
        .nav-links a:nth-child(3) {
            background-color: #dc3545;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ccc;
        }
        .no-image {
            color: #6c757d;
        }
        .status {
            padding: 5px 10px;
            border-radius: 12px;
            color: white;
            display: inline-block;
        }
        .status.active {
            background-color: #28a745;
        }
        .status.inactive {
            background-color: #6c757d;
        }
        .action-btn {
            padding: 6px 10px;
            margin: 2px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
        }
        .edit-btn {
            background-color: #ffc107;
            color: black;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .toggle-btn {
            background-color: #17a2b8;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Employee List</h2>

    <div class="nav-links">
        <a href="/add-employee">Add Employee</a>
        <a href="/update-password">Update Password</a>
        <a href="/logout">Logout</a>
    </div>

    @if(session('success'))
        <div style="text-align:center; color:green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>EmployeeID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Username</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr>
                <td>{{ $emp->employeeid }}</td>
                <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                <td>{{ $emp->email }}</td>
                <td>
                    @if($emp->image_path)
                        <img src="{{ asset($emp->image_path) }}">
                    @else
                        <span class="no-image">No Image</span>
                    @endif
                </td>
                <td>{{ $emp->username }}</td>
                <td>
                    <span class="status {{ $emp->status == 'active' ? 'active' : 'inactive' }}">
                        {{ ucfirst($emp->status) }}
                    </span>
                </td>
                <td>
                    <a href="/edit-employee/{{ $emp->id }}" class="action-btn edit-btn">Edit</a>
                    <a href="/delete-employee/{{ $emp->id }}" class="action-btn delete-btn"
                       onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                    <a href="/toggle-status/{{ $emp->ua_id }}" class="action-btn toggle-btn">
                        {{ $emp->status == 'active' ? 'Deactivate' : 'Activate' }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $employees->links() }}
    </div>

</body>
</html>
