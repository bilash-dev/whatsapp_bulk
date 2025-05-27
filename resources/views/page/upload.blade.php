@extends('layout.sidebar')
@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Upload CSV of Phone Numbers</h1>

        <!-- CSV Upload Form -->
        <form method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="csv_file" class="form-label">Choose CSV File</label>
                <input type="file" class="form-control" name="csv_file" accept=".csv" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>

        <div class="error">
            
        </div>

        <!-- Error Message -->
        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        
        <!-- Success Message -->
        @if(request()->query('successs'))
            <div class="alert alert-success mt-3">
                File uploaded successfully!
            </div>
        @endif

        <!-- Success Message -->
        {{-- @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif --}}
    </div>
    <style>
        .container {
            max-width: 540px;
            margin: 30px auto 25px auto; /* Top, Right, Bottom, Left */
            text-align: center;
            position: relative;
            top: 40px;
        }
        
        .error {
            color: red;
            font-size: 16px;
        }
        .success {
            color: green;
            font-size: 16px;
        } 
    </style>
@endsection