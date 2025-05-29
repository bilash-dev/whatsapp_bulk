@extends('layout.sidebar')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Add Sender ID (Phone Number)</h5>

                        <form action="{{ route('senderId.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" name="senderId" class="form-control" placeholder="Enter phone number" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Continue to Add WhatsApp
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
