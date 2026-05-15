<x-app-layout>
    <x-slot name="header">{{ __('Manage Pets') }}</x-slot>

    <div class="py-6 px-6">

        {{-- Top Bar --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">All Pets</h3>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">Manage and monitor all listed pets</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.pets-archived') }}"
                   style="padding: 10px 20px; background: #fef3c7; color: #92400e; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;"
                   onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef3c7'">
                    📦 Archived Pets
                </a>
                <a href="{{ route('pets.create') }}"
                   style="padding: 10px 20px; background: #7d4a3f; color: white; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;"
                   onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                    + Add Pet
                </a>
            </div>
        </div>

        {{-- Filter Bar --}}
        <form method="GET" action="{{ route('pets.index') }}"
              style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end;">

            <div style="flex: 1; min-width: 180px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Name, species, breed..."
                       style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div style="min-width: 130px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Species</label>
                <select name="species"
                        style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none; background: white;"
                        onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                    <option value="">All Species</option>
                    <option value="Cat" {{ request('species')=='Cat' ? 'selected' : '' }}>Cat</option>
                    <option value="Dog" {{ request('species')=='Dog' ? 'selected' : '' }}>Dog</option>
                    <option value="Rabbit" {{ request('species')=='Rabbit' ? 'selected' : '' }}>Rabbit</option>
                    <option value="Bird" {{ request('species')=='Bird' ? 'selected' : '' }}>Bird</option>
                </select>
            </div>

            <div style="min-width: 130px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Breed</label>
                <input type="text" name="breed" value="{{ request('breed') }}"
                       placeholder="Breed"
                       style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div style="min-width: 100px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Age</label>
                <input type="number" name="age" value="{{ request('age') }}"
                       placeholder="Age"
                       style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>

            <div style="min-width: 130px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Status</label>
                <select name="adopted"
                        style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none; background: white;"
                        onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
                    <option value="">All</option>
                    <option value="1" {{ request('adopted')=='1' ? 'selected' : '' }}>Adopted</option>
                    <option value="0" {{ request('adopted')=='0' ? 'selected' : '' }}>Not Adopted</option>
                </select>
            </div>

            <div style="display: flex; gap: 8px; align-items: flex-end;">
                <button type="submit"
                        style="padding: 9px 20px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                        onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                    Filter
                </button>
                <a href="{{ route('pets.index') }}"
                   style="padding: 9px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;"
                   onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                    Reset
                </a>
            </div>

        </form>

        {{-- Pet Cards Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
            @forelse($pets as $pet)
                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(125,74,63,0.08); transition: transform 0.2s, box-shadow 0.2s;"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(125,74,63,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(125,74,63,0.08)'">

                    {{-- Pet Photo --}}
                    <div style="height: 200px; background: #f5ede8; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        @if($pet->photo)
                            <img src="{{ asset('storage/'.$pet->photo) }}" alt="{{ $pet->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="font-size: 48px;">🐾</div>
                        @endif
                    </div>

                    {{-- Pet Info --}}
                    <div style="padding: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <h3 style="font-size: 16px; font-weight: 800; color: #1f2937;">{{ $pet->name }}</h3>
                            <span style="font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 999px;
                                {{ $pet->adopted ? 'background: #d1fae5; color: #065f46;' : 'background: #fee2e2; color: #991b1b;' }}">
                                {{ $pet->adopted ? 'Adopted' : 'Available' }}
                            </span>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 6px; font-size: 13px; color: #6b7280; margin-bottom: 14px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span>Species</span>
                                <span style="font-weight: 600; color: #374151;">{{ $pet->species }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Breed</span>
                                <span style="font-weight: 600; color: #374151;">{{ $pet->breed }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Gender</span>
                                <span style="font-weight: 600; color: #374151;">{{ $pet->gender }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Age</span>
                                <span style="font-weight: 600; color: #374151;">{{ $pet->age }} yrs</span>
                            </div>
                            @if($pet->characteristics)
                                <div style="margin-top: 4px;">
                                    <span style="display: block; margin-bottom: 4px;">Characteristics</span>
                                    <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                        @foreach(explode(',', $pet->characteristics) as $trait)
                                            <span style="background: #f5ede8; color: #7d4a3f; padding: 2px 8px; border-radius: 999px; font-size: 11px; font-weight: 600;">
                                                {{ trim($trait) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('pets.edit', $pet->id) }}"
                               style="flex: 1; text-align: center; padding: 8px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600;"
                               onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.pets-archive', $pet->id) }}" method="POST" style="flex: 1;" id="archiveForm-{{ $pet->id }}">
                                @csrf
                                @method('PATCH')
                                <button type="button"
                                        onclick="openConfirmModal('{{ $pet->id }}', '{{ $pet->name }}')"
                                        style="width: 100%; padding: 8px; background: #fef3c7; color: #92400e; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;"
                                        onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef3c7'">
                                    📦 Archive
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px; color: #9ca3af;">
                    <div style="font-size: 48px; margin-bottom: 12px;">🐾</div>
                    <p style="font-size: 16px; font-weight: 600;">No pets found</p>
                    <p style="font-size: 14px; margin-top: 4px;">Try adjusting your filters or add a new pet</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($pets->hasPages())
            <div style="margin-top: 24px;">
                {{ $pets->links() }}
            </div>
        @endif

    </div>

    {{-- Archive Confirm Modal --}}
    <div id="confirmModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50;">
        <div style="background: white; border-radius: 16px; padding: 32px; width: 360px; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
            <div style="font-size: 36px; text-align: center; margin-bottom: 12px;">📦</div>
            <h2 style="font-size: 18px; font-weight: 800; color: #1f2937; text-align: center; margin-bottom: 8px;">Archive Pet</h2>
            <p id="confirmText" style="font-size: 14px; color: #6b7280; text-align: center; margin-bottom: 24px;"></p>
            <div style="display: flex; gap: 12px;">
                <button onclick="closeConfirmModal()"
                        style="flex: 1; padding: 10px; background: #f5ede8; color: #7d4a3f; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                        onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                    Cancel
                </button>
                <button id="confirmArchiveBtn"
                        style="flex: 1; padding: 10px; background: #d97706; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                        onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">
                    Archive
                </button>
            </div>
        </div>
    </div>

    <script>
        let archiveForm = null;

        function openConfirmModal(petId, petName) {
            archiveForm = document.getElementById(`archiveForm-${petId}`);
            document.getElementById('confirmText').textContent = "Are you sure you want to archive " + petName + "? The pet will be hidden but adoption records will be kept.";
            document.getElementById('confirmModal').style.display = 'flex';
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').style.display = 'none';
            archiveForm = null;
        }

        document.getElementById('confirmArchiveBtn').addEventListener('click', function () {
            if (archiveForm) {
                archiveForm.submit();
            }
        });
    </script>

</x-app-layout>