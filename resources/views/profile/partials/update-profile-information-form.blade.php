<section>
    <div style="margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f3f4f6;">
        <h3 style="font-size: 16px; font-weight: 800; color: #1f2937;">Profile Information</h3>
        <p style="font-size: 13px; color: #9ca3af; margin-top: 4px;">Update your personal information.</p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Profile Photo --}}
        <div style="margin-bottom: 24px; text-align: center;">
            <div id="photoPreview"
                 style="width: 100px; height: 100px; border-radius: 50%; background: #7d4a3f; margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; font-size: 36px; font-weight: 800; color: white;">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                @endif
            </div>
            <label for="profile_photo"
                   style="display: inline-block; padding: 7px 16px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;"
                   onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                Change Photo
            </label>
            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display: none;"
                   onchange="previewPhoto(event)">
        </div>

        {{-- Two column grid --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">

            <div>
                <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                @error('name') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                @error('email') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                       placeholder="e.g. 09123456789"
                       style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div>
                <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Birthday</label>
                <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}"
                       style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div>
                <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Gender</label>
                <select name="gender"
                        style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none; background: white;"
                        onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                    <option value="">Prefer not to say</option>
                    <option value="Male" {{ old('gender', $user->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $user->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $user->gender) === 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Address</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                   placeholder="e.g. 123 Main St, Quezon City"
                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <button type="submit"
                    style="padding: 10px 24px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                Save Changes
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   style="font-size: 13px; color: #065f46; font-weight: 600;">
                    ✅ Saved successfully!
                </p>
            @endif
        </div>
    </form>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</section>