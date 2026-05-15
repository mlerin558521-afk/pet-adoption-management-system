<x-app-layout>
    <x-slot name="header">{{ __('User Profile') }}</x-slot>

    <div class="py-6 px-6">

        <a href="{{ route('adoptions.index') }}"
           style="display: inline-flex; align-items: center; gap: 6px; font-size: 14px; color: #7d4a3f; font-weight: 600; text-decoration: none; margin-bottom: 20px;"
           onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
            ← Back to Adoption Requests
        </a>

        {{-- Profile Header --}}
        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); margin-bottom: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: #7d4a3f; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; color: white; flex-shrink: 0; overflow: hidden;">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/'.$user->profile_photo) }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div style="flex: 1;">
                <h3 style="font-size: 22px; font-weight: 800; color: #1f2937;">{{ $user->name }}</h3>
                <p style="font-size: 14px; color: #6b7280;">{{ $user->email }}</p>
                <div style="display: flex; gap: 8px; margin-top: 8px; flex-wrap: wrap;">
                    <span style="font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 999px; background: #f5ede8; color: #7d4a3f;">
                        {{ ucfirst($user->role) }}
                    </span>
                    @if($user->gender)
                        <span style="font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 999px; background: #f3f4f6; color: #6b7280;">
                            {{ $user->gender === 'Male' ? '👨' : ($user->gender === 'Female' ? '👩' : '🧑') }} {{ $user->gender }}
                        </span>
                    @endif
                    <span style="font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 999px; background: #f3f4f6; color: #6b7280;">
                        📅 Joined {{ $user->created_at->format('M d, Y') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- User Details --}}
        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); margin-bottom: 24px;">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #f3f4f6;">
                <h4 style="font-size: 16px; font-weight: 800; color: #1f2937;">Personal Information</h4>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 4px;">Provided by the user for adoption consideration</p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Full Name</p>
                    <p style="font-size: 15px; font-weight: 600; color: #1f2937;">{{ $user->name }}</p>
                </div>
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Email</p>
                    <p style="font-size: 15px; font-weight: 600; color: #1f2937;">{{ $user->email }}</p>
                </div>
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Phone</p>
                    <p style="font-size: 15px; font-weight: 600; color: #1f2937;">{{ $user->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Gender</p>
                    <p style="font-size: 15px; font-weight: 600; color: #1f2937;">{{ $user->gender ?? 'Not provided' }}</p>
                </div>
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Birthday</p>
                    <p style="font-size: 15px; font-weight: 600; color: #1f2937;">
                        @if($user->birthday)
                            {{ \Carbon\Carbon::parse($user->birthday)->format('M d, Y') }}
                            <span style="color: #9ca3af; font-size: 13px;">({{ \Carbon\Carbon::parse($user->birthday)->age }} years old)</span>
                        @else
                            Not provided
                        @endif
                    </p>
                </div>
                <div style="grid-column: 1 / -1;">
                    <p style="font-size: 12px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Address</p>
                    <p style="font-size: 15px; font-weight: 600; color: #1f2937;">{{ $user->address ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>

        {{-- Adoption History --}}
        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid #f3f4f6;">
                <h4 style="font-size: 16px; font-weight: 800; color: #1f2937;">Adoption History</h4>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 4px;">All adoption requests submitted by this user</p>
            </div>

            @forelse($adoptions as $adoption)
                <div style="display: flex; align-items: center; gap: 16px; padding: 14px; border-radius: 12px; background: #fafafa; margin-bottom: 10px; border: 1px solid #f3f4f6;">
                    <div style="width: 48px; height: 48px; border-radius: 10px; overflow: hidden; background: #f5ede8; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        @if($adoption->pet->photo)
                            <img src="{{ asset('storage/'.$adoption->pet->photo) }}"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="font-size: 22px;">🐾</span>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <p style="font-size: 14px; font-weight: 700; color: #1f2937;">{{ $adoption->pet->name }}</p>
                        <p style="font-size: 12px; color: #6b7280;">{{ $adoption->pet->species }} · {{ $adoption->pet->breed }}</p>
                    </div>
                    <span style="font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 999px;
                        @if($adoption->status === 'approved') background: #d1fae5; color: #065f46;
                        @elseif($adoption->status === 'pending') background: #fef3c7; color: #92400e;
                        @else background: #fee2e2; color: #991b1b; @endif">
                        @if($adoption->status === 'approved') ✅
                        @elseif($adoption->status === 'pending') ⏳
                        @else ❌ @endif
                        {{ ucfirst($adoption->status) }}
                    </span>
                    <p style="font-size: 12px; color: #9ca3af; min-width: 80px; text-align: right;">
                        {{ $adoption->created_at->format('M d, Y') }}
                    </p>
                </div>
            @empty
                <div style="text-align: center; padding: 32px; color: #9ca3af;">
                    <div style="font-size: 32px; margin-bottom: 8px;">📋</div>
                    <p style="font-size: 14px; font-weight: 600;">No adoption history yet</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>