<x-app-layout>
    <x-slot name="header">{{ __('Browse Pets') }}</x-slot>

    <div class="py-6 px-6">

        {{-- Top Bar --}}
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">Available Pets</h3>
            <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">Find your perfect companion and apply for adoption</p>
        </div>

        {{-- Filter Bar --}}
        <form method="GET" action="{{ route('pets.browse') }}"
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

            <div style="display: flex; gap: 8px; align-items: flex-end;">
                <button type="submit"
                        style="padding: 9px 20px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                        onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                    Filter
                </button>
                <a href="{{ route('pets.browse') }}"
                   style="padding: 9px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;"
                   onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                    Reset
                </a>
            </div>
        </form>

        {{-- Pet Cards --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
            @forelse($pets as $pet)
                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(125,74,63,0.08); transition: transform 0.2s, box-shadow 0.2s;"
                     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(125,74,63,0.15)'"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(125,74,63,0.08)'">

                    {{-- Photo --}}
                    <div style="height: 200px; background: #f5ede8; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        @if($pet->photo)
                            <img src="{{ asset('storage/'.$pet->photo) }}" alt="{{ $pet->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="font-size: 48px;">🐾</div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div style="padding: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <h3 style="font-size: 16px; font-weight: 800; color: #1f2937;">{{ $pet->name }}</h3>
                            <span style="font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 999px;
                                {{ $pet->adopted ? 'background: #fee2e2; color: #991b1b;' : 'background: #d1fae5; color: #065f46;' }}">
                                {{ $pet->adopted ? 'Adopted' : 'Available' }}
                            </span>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 6px; font-size: 13px; color: #6b7280; margin-bottom: 16px;">
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
                                    <div style="display: flex; flex-wrap: wrap; gap: 4px; margin-top: 4px;">
                                        @foreach(explode(',', $pet->characteristics) as $trait)
                                            <span style="background: #f5ede8; color: #7d4a3f; padding: 2px 8px; border-radius: 999px; font-size: 11px; font-weight: 600;">
                                                {{ trim($trait) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Action --}}
                        @if(!$pet->adopted)
                            <form action="{{ route('adoptions.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                                <button type="submit"
                                        style="width: 100%; padding: 10px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                                        onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                                    🐾 Apply for Adoption
                                </button>
                            </form>
                        @else
                            <div style="width: 100%; padding: 10px; background: #f3f4f6; color: #9ca3af; border-radius: 8px; font-size: 14px; font-weight: 600; text-align: center;">
                                Already Adopted
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px; color: #9ca3af;">
                    <div style="font-size: 48px; margin-bottom: 12px;">🐾</div>
                    <p style="font-size: 16px; font-weight: 600;">No pets available right now</p>
                    <p style="font-size: 14px; margin-top: 4px;">Check back soon for new arrivals!</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>