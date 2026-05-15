<x-app-layout>
    <x-slot name="header">{{ __('Edit Pet') }}</x-slot>

    <div class="py-6 px-6">

        <a href="{{ route('pets.index') }}"
           style="display: inline-flex; align-items: center; gap: 6px; font-size: 14px; color: #7d4a3f; font-weight: 600; text-decoration: none; margin-bottom: 20px;"
           onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
            ← Back to Pets
        </a>

        <div style="max-width: 640px;">
            <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">

                {{-- Pet Header --}}
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 28px; padding-bottom: 20px; border-bottom: 1px solid #f3f4f6;">
                    <div style="width: 56px; height: 56px; border-radius: 12px; overflow: hidden; background: #f5ede8; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        @if($pet->photo)
                            <img src="{{ asset('storage/'.$pet->photo) }}" alt="{{ $pet->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="font-size: 28px;">🐾</span>
                        @endif
                    </div>
                    <div>
                        <h3 style="font-size: 18px; font-weight: 800; color: #1f2937;">{{ $pet->name }}</h3>
                        <p style="font-size: 13px; color: #9ca3af;">{{ $pet->species }} · {{ $pet->breed }}</p>
                    </div>
                </div>

                <form action="{{ route('pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Photo Upload --}}
                    <div style="margin-bottom: 24px; text-align: center;">
                        <div id="photoPreview"
                             style="width: 100px; height: 100px; border-radius: 16px; background: #f5ede8; margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            @if($pet->photo)
                                <img src="{{ asset('storage/'.$pet->photo) }}" alt="{{ $pet->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <span style="font-size: 40px;">🐾</span>
                            @endif
                        </div>
                        <label for="photo" style="display: inline-block; padding: 8px 16px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;"
                               onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                            Change Photo
                        </label>
                        <input type="file" id="photo" name="photo" accept="image/*" style="display: none;"
                               onchange="previewPhoto(event)">
                        <p style="font-size: 12px; color: #9ca3af; margin-top: 6px;">Leave empty to keep current photo</p>
                    </div>

                    {{-- Two Column Grid --}}
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">

                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Pet Name <span style="color: #dc2626;">*</span></label>
                            <input type="text" name="name" required value="{{ old('name', $pet->name) }}"
                                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                            @error('name') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Species</label>
                            <input type="text" name="species" value="{{ old('species', $pet->species) }}"
                                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                            @error('species') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Breed/Type</label>
                            <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}"
                                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                            @error('breed') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Age (years)</label>
                            <input type="number" name="age" min="0" value="{{ old('age', $pet->age) }}"
                                   style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                                   onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                            @error('age') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Gender</label>
                            <select name="gender"
                                    style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none; background: white;"
                                    onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                                <option value="Male" {{ old('gender', $pet->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $pet->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Adopted?</label>
                            <select name="adopted"
                                    style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none; background: white;"
                                    onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                                <option value="0" {{ !old('adopted', $pet->adopted) ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('adopted', $pet->adopted) ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>

                    </div>

                    {{-- Characteristics --}}
                    <div style="margin-bottom: 28px;">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Characteristics</label>
                        <textarea name="characteristics" rows="3"
                                  style="width: 100%; padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none; resize: vertical;"
                                  onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'"
                                  placeholder="Describe the pet's personality, habits, etc.">{{ old('characteristics', $pet->characteristics) }}</textarea>
                        @error('characteristics') <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p> @enderror
                    </div>

                    {{-- Actions --}}
                    <div style="display: flex; gap: 12px;">
                        <button type="submit"
                                style="flex: 1; padding: 12px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                                onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                            ✅ Update Pet
                        </button>
                        <a href="{{ route('pets.index') }}"
                           style="flex: 1; text-align: center; padding: 12px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;"
                           onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</x-app-layout>