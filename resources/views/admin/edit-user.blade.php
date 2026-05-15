<x-app-layout>
    <x-slot name="header">{{ __('Edit User') }}</x-slot>

    <div class="py-6 px-6">

        <a href="{{ route('users.index') }}"
           style="display: inline-flex; align-items: center; gap: 6px; font-size: 14px; color: #7d4a3f; font-weight: 600; text-decoration: none; margin-bottom: 20px;"
           onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
            ← Back to Users
        </a>

        <div style="max-width: 600px;">
            <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">

                {{-- User Avatar --}}
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid #f3f4f6;">
                    <div style="width: 56px; height: 56px; background: #7d4a3f; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; color: white;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p style="font-size: 18px; font-weight: 800; color: #1f2937;">{{ $user->name }}</p>
                        <p style="font-size: 14px; color: #6b7280;">{{ $user->email }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                               style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                               onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                        @error('name') <p style="color: #dc2626; font-size: 13px; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                               style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                               onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                        @error('email') <p style="color: #dc2626; font-size: 13px; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">
                            New Password <span style="font-weight: 400; color: #9ca3af;">(leave blank to keep current)</span>
                        </label>
                        <input type="password" name="password"
                               style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                               onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                        @error('password') <p style="color: #dc2626; font-size: 13px; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 28px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                               onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>

                    <div style="display: flex; gap: 12px;">
                        <button type="submit"
                                style="flex: 1; padding: 12px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                                onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                            Update User
                        </button>
                        <a href="{{ route('users.index') }}"
                           style="flex: 1; text-align: center; padding: 12px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;"
                           onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>