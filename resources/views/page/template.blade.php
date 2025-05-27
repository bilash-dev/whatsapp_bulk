@extends('layout.sidebar')
@section('content')
<div class="container">
    <div class="template-form">
        <h2 class="form-title">CREATE A TEMPLATE</h2>
        
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter template name">
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea class="form-control" id="message" rows="4" placeholder="Enter your message"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="image" class="form-label">Image:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="image">
                </div>
                <div class="form-text">Choose File No file chosen</div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-save">Save Template</button>
        </form>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
        padding: 20px;
    }
    .template-form {
        max-width: 540px;
        margin: 25px auto;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        position: relative;
        top: 25px;
    }
    .form-title {
        text-align: center;
        margin-bottom: 25px;
        color: #1837e9;
        font-weight: 600;
    }
    .btn-save {
        width: 100%;
        padding: 10px;
        font-weight: 500;
    }
</style>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection