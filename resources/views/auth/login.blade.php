<x-guest-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/loginregister.css') }}">
    </head>

    <div class="overlay"></div>

    <div class="container">
        <!-- Left: Illustration -->
        <div class="image-side"></div>

        <!-- Right: Form -->
        <div class="form-side">
            <h2>Welcome</h2>
            <p>Please login to your account</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="input-group">
                    <label for="email">Username or Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('password.request') }}">Forgot Password</a>
                    <a href="{{ route('register') }}">Register</a>
                </div>

                <button class="login-btn" type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</x-guest-layout>
