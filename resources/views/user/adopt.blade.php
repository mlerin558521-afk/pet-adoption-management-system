<x-app-layout>
    <x-slot name="header">{{ __('My Adoption Requests') }}</x-slot>

    <div class="py-6 px-6">

        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">My Requests</h3>
            <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">Track the status of your adoption applications</p>
        </div>

        @if($requests->isEmpty())
            <div style="background: white; border-radius: 16px; padding: 60px; text-align: center; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <div style="font-size: 48px; margin-bottom: 12px;">📋</div>
                <p style="font-size: 16px; font-weight: 600; color: #374151;">No requests yet</p>
                <p style="font-size: 14px; color: #9ca3af; margin-top: 4px; margin-bottom: 20px;">You haven't submitted any adoption requests yet.</p>
                <a href="{{ route('pets.browse') }}"
                   style="padding: 10px 24px; background: #7d4a3f; color: white; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;"
                   onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                    🐾 Browse Pets
                </a>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 16px;">
                @foreach($requests as $request)
                    <div style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); display: flex; align-items: center; gap: 16px;">

                        {{-- Pet Photo --}}
                        <div style="width: 64px; height: 64px; border-radius: 12px; overflow: hidden; background: #f5ede8; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            @if($request->pet->photo)
                                <img src="{{ asset('storage/'.$request->pet->photo) }}" alt="{{ $request->pet->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <span style="font-size: 28px;">🐾</span>
                            @endif
                        </div>

                        {{-- Pet Info --}}
                        <div style="flex: 1;">
                            <p style="font-size: 16px; font-weight: 800; color: #1f2937;">{{ $request->pet->name }}</p>
                            <p style="font-size: 13px; color: #6b7280;">{{ $request->pet->species }} · {{ $request->pet->breed }}</p>
                            <p style="font-size: 12px; color: #9ca3af; margin-top: 4px;">
                                Applied {{ $request->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        {{-- Status Badge --}}
                        <div style="text-align: right;">
                            <span style="font-size: 13px; font-weight: 700; padding: 6px 16px; border-radius: 999px;
                                @if($request->status === 'approved') background: #d1fae5; color: #065f46;
                                @elseif($request->status === 'disapproved') background: #fee2e2; color: #991b1b;
                                @else background: #fef3c7; color: #92400e; @endif">
                                @if($request->status === 'approved') ✅
                                @elseif($request->status === 'disapproved') ❌
                                @else ⏳ @endif
                                {{ ucfirst($request->status) }}
                            </span>
                            @if($request->status === 'approved')
                                <p style="font-size: 12px; color: #065f46; margin-top: 6px; font-weight: 600;">
                                    Congratulations! 🎉
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>