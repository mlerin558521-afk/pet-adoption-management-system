<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div style="margin-bottom: 16px;">
            <label for="email" style="display:block; font-size:14px; font-weight:600; color:#374151; margin-bottom:6px;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                style="width:100%; padding:10px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:15px; outline:none; transition:border-color 0.2s;"
                onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <label for="password" style="display:block; font-size:14px; font-weight:600; color:#374151; margin-bottom:6px;">Password</label>
            <input id="password" type="password" name="password" required
                style="width:100%; padding:10px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:15px; outline:none; transition:border-color 0.2s;"
                onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div style="margin-bottom: 24px;">
            <label for="remember_me" style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                <input id="remember_me" type="checkbox" name="remember"
                    style="width:16px; height:16px; accent-color:#7d4a3f;">
                <span style="font-size:14px; color:#6b7280;">Remember me</span>
            </label>
        </div>

        <!-- Actions -->
        <div style="display:flex; flex-direction:column; gap:12px;">
            <button type="submit"
                style="width:100%; padding:12px; background:#7d4a3f; color:white; border:none; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer; transition:background 0.2s;"
                onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                Log in
            </button>

            <div style="display:flex; justify-content:space-between; align-items:center;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        style="font-size:13px; color:#7d4a3f; text-decoration:none; font-weight:500;"
                        onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        Forgot your password?
                    </a>
                @endif
                <a href="{{ route('register') }}"
                    style="font-size:13px; color:#7d4a3f; text-decoration:none; font-weight:500;"
                    onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    Create an account
                </a>
            </div>
        </div>

    </form>
</x-guest-layout>