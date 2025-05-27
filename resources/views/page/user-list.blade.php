@extends('layout.sidebar')
@section('content')
    <div class="container mt-5">
        <h4 class="mb-3">Active WhatsApp Sessions</h4>

        @if(auth()->check())
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Browser</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userList as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->browser_preference }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No active WhatsApp accounts.</p>
        @endif
    </div>
     
@endsection