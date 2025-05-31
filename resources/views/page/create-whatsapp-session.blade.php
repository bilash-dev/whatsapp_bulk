@extends('layout.sidebar')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Add Sender ID (Phone Number)</h5>

                        {{-- <form action="{{ route('senderId.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" name="senderId" class="form-control" placeholder="Enter phone number" required>
                            </div>

                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Continue to Add WhatsApp
                            </button>
                        </form> --}}

                        <form id="senderIdForm" action="{{ route('senderId.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="senderId" class="form-control"     placeholder="Enter phone number (e.g. 01555123456)" required
                                pattern="[0-9]+" title="Please enter numbers only">
                                {{-- <small class="text-muted">Include country code (e.g. +88 for US)</small> --}}
                            </div>

                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Continue to WhatsApp
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        {{-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif --}}

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5>Success!</h5>
                        <p>Redirecting you to WhatsApp...</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    <script>
        document.getElementById('senderIdForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Processing...';

            fetch("{{ route('senderId.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    senderId: this.elements.senderId.value
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success modal
                    const modal = new bootstrap.Modal(document.getElementById('successModal'));
                    modal.show();
                    
                    // Open WhatsApp in new tab after short delay
                    setTimeout(() => {
                        window.open(data.whatsapp_url, '_blank');
                        window.location.href = data.redirect_url;
                    }, 1500);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + error.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Continue to WhatsApp';
            });
        });
    </script>

@endsection
