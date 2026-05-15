<section>
    <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f3f4f6;">
        <h3 style="font-size: 16px; font-weight: 800; color: #1f2937;">Update Password</h3>
        <p style="font-size: 13px; color: #9ca3af; margin-top: 4px;">Ensure your account is using a long, random password to stay secure.</p>
    </div>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div style="margin-bottom: 20px;">
            <label for="current_password" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Current Password</label>
            <input id="current_password" name="current_password" type="password"
                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            @error('current_password', 'updatePassword')
                <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">New Password</label>
            <input id="password" name="password" type="password"
                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            @error('password', 'updatePassword')
                <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label for="password_confirmation" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            @error('password_confirmation', 'updatePassword')
                <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <button type="submit"
                    style="padding: 10px 24px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   style="font-size: 13px; color: #065f46; font-weight: 600;">
                    ✅ Password updated!
                </p>
            @endif
        </div>
    </form>
</section>