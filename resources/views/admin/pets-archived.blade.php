<x-app-layout>
    <x-slot name="header">{{ __('Archived Pets') }}</x-slot>

    <div class="py-6 px-6">

        {{-- Top Bar --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <a href="{{ route('pets.index') }}"
                   style="display: inline-flex; align-items: center; gap: 6px; font-size: 14px; color: #7d4a3f; font-weight: 600; text-decoration: none; margin-bottom: 8px;"
                   onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                    ← Back to Pets
                </a>
                <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">Archived Pets</h3>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">These pets are hidden but their adoption records are preserved</p>
            </div>
        </div>

        {{-- Pet Cards Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
            @forelse($pets as $pet)
                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(125,74,63,0.08); opacity: 0.85;">

                    {{-- Pet Photo --}}
                    <div style="height: 200px; background: #f5ede8; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                        @if($pet->photo)
                            <img src="{{ asset('storage/'.$pet->photo) }}" alt="{{ $pet->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(40%);">
                        @else
                            <div style="font-size: 48px;">🐾</div>
                        @endif
                        <div style="position: absolute; top: 10px; left: 10px; background: #92400e; color: white; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 999px;">
                            📦 Archived
                        </div>
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
                        </div>

                        {{-- Restore Button --}}
                        <form action="{{ route('admin.pets-restore', $pet->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    style="width: 100%; padding: 10px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                                    onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                                ♻️ Restore Pet
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px; color: #9ca3af;">
                    <div style="font-size: 48px; margin-bottom: 12px;">📦</div>
                    <p style="font-size: 16px; font-weight: 600;">No archived pets</p>
                    <p style="font-size: 14px; margin-top: 4px;">Archived pets will appear here</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>