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
            <h2>Create Account</h2>
            <p>Register a new account to start shopping</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus>
                </div>

                <!-- Email -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('login') }}">Already registered?</a>
                </div>

                <button class="login-btn" type="submit">REGISTER</button>
            </form>
        </div>
    </div>
</x-guest-layout>
