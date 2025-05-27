@extends('layout.sidebar')

@section('content')
    <div class="container pt-4 pb-4 ps-2 pe-2">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-5">Create Campaign</h2>
            
            <div class="form-body pt-4 pb-4 ps-3 pe-3">
                <form method="POST" action="">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="template" class="form-label">Select Template:</label>
                        <select name="template" id="template" class="form-select" required>
                            <option value="">-- Select Template --</option>
                            {{-- @foreach($templates as $template)
                                <option value="{{ $template->id }}">{{ $template->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Select CSV File:</label>
                        <select name="csv_file" id="csv_file" class="form-select" required>
                            <option value="">-- Select CSV File --</option>
                            {{-- @foreach($csvFiles as $file)
                                <option value="{{ $file->id }}">{{ $file->original_name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="user" class="form-label">Select User:</label>
                        <select name="user" id="user" class="form-select" required>
                            <option value="">-- Select User --</option>
                            {{-- @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 py-2">Send</button>
                    </div>
                </form>
                
                @if(isset($message))
                    <div class="alert alert-info mt-4">
                        <h3 class="text-center">Message Preview:</h3>
                        <p class="text-center">$message</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .container{
            max-width: 600px;
        }
    </style>
@endsection