<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="login-container">
        <div class="header">
            <h1>Login</h1>
        </div>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>
</body>
</html>