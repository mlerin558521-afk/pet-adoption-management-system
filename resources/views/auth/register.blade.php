<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div style="margin-bottom: 16px;">
            <label for="name" style="display:block; font-size:14px; font-weight:600; color:#374151; margin-bottom:6px;">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                style="width:100%; padding:10px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:15px; outline:none; transition:border-color 0.2s; background: rgba(255,255,255,0.8);"
                onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div style="margin-bottom: 16px;">
            <label for="email" style="display:block; font-size:14px; font-weight:600; color:#374151; margin-bottom:6px;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                style="width:100%; padding:10px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:15px; outline:none; transition:border-color 0.2s; background: rgba(255,255,255,0.8);"
                onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 16px;">
            <label for="password" style="display:block; font-size:14px; font-weight:600; color:#374151; margin-bottom:6px;">Password</label>
            <input id="password" type="password" name="password" required
                style="width:100%; padding:10px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:15px; outline:none; transition:border-color 0.2s; background: rgba(255,255,255,0.8);"
                onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div style="margin-bottom: 24px;">
            <label for="password_confirmation" style="display:block; font-size:14px; font-weight:600; color:#374151; margin-bottom:6px;">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                style="width:100%; padding:10px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:15px; outline:none; transition:border-color 0.2s; background: rgba(255,255,255,0.8);"
                onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div style="display:flex; flex-direction:column; gap:12px;">
            <button type="submit"
                style="width:100%; padding:12px; background:#7d4a3f; color:white; border:none; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer; transition:background 0.2s;"
                onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                Register
            </button>

            <div style="text-align:center;">
                <a href="{{ route('login') }}"
                    style="font-size:13px; color:#7d4a3f; text-decoration:none; font-weight:500;"
                    onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    Already registered? Sign in
                </a>
            </div>
        </div>

    </form>
</x-guest-layout>