{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WhatsApp Integration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/dashboard.js'])
</head>
    <body>
        <div class="dashboard-container">
            <header>
                <h1>Welcome, {{ Auth::user()->name }}</h1>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </header>
            
            <div class="dashboard-content">
                <button id="openWhatsApp" class="whatsapp-button">
                    Open WhatsApp Web
                
                </button>
                <div id="statusMessage"></div>
            </div>
        </div>
    </body>
</html> --}}


@extends('layout.sidebar')
@section('content')
    <div class="dashboard-container">
        <header>
            {{-- <h1>Welcome, {{ Auth::user()->name }}</h1> --}}
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form> --}}
        </header>
        
        <div class="dashboard-content">
            <button id="openWhatsApp" class="whatsapp-button">
                Open WhatsApp Web
            
            </button>
            <div id="statusMessage"></div>
        </div>
    </div>
@endsection