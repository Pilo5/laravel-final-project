<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        img {
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        p {
            margin: 0;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Edit Employee</h2>
    <form method="POST" action="/edit-employee/{{ $employee->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <input type="text" name="first_name" value="{{ $employee->first_name }}" required placeholder="First Name">
        <input type="text" name="last_name" value="{{ $employee->last_name }}" required placeholder="Last Name">
        <input type="email" name="email" value="{{ $employee->email }}" required placeholder="Email">

        @if($employee->image_path)
            <p>Current Image:</p>
            <img src="{{ asset($employee->image_path) }}" width="80">
        @endif

        <input type="file" name="image">

        <button type="submit">Update</button>
    </form>
</body>
</html>
