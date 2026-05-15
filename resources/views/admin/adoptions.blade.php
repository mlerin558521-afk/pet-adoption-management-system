<x-app-layout>
    <x-slot name="header">{{ __('Adoption Requests') }}</x-slot>

    <div class="py-6 px-6">

        {{-- Top Bar --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">All Adoption Requests</h3>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">Review and manage adoption requests</p>
            </div>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('adoptions.index') }}"
              style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); display: flex; gap: 12px; align-items: flex-end;">
            <div style="flex: 1;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by user name..."
                       style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <button type="submit"
                    style="padding: 9px 20px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                Search
            </button>
            <a href="{{ route('adoptions.index') }}"
               style="padding: 9px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;"
               onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                Reset
            </a>
        </form>

        {{-- Table --}}
        <div style="background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #7d4a3f;">
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">Request ID</th>
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">Pet</th>
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">User</th>
                        <th style="padding: 14px 20px; text-align: center; font-size: 13px; font-weight: 700; color: white;">Status</th>
                        <th style="padding: 14px 20px; text-align: center; font-size: 13px; font-weight: 700; color: white;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.15s;"
                            onmouseover="this.style.background='#fdf8f6'" onmouseout="this.style.background='white'">

                            <td style="padding: 16px 20px; font-size: 14px; color: #6b7280; font-weight: 600;">
                                #{{ $request->id }}
                            </td>

                            <td style="padding: 16px 20px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 36px; height: 36px; border-radius: 8px; overflow: hidden; background: #f5ede8; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        @if($request->pet->photo)
                                            <img src="{{ asset('storage/'.$request->pet->photo) }}" alt="{{ $request->pet->name }}"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <span style="font-size: 18px;">🐾</span>
                                        @endif
                                    </div>
                                    <span style="font-size: 14px; font-weight: 600; color: #1f2937;">{{ $request->pet->name }}</span>
                                </div>
                            </td>

                            <td style="padding: 16px 20px; font-size: 14px; color: #374151; font-weight: 600;">
                                {{ $request->user->name }}
                            </td>

                            <td style="padding: 16px 20px; text-align: center;">
                                <span style="font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 999px;
                                    @if($request->status === 'approved') background: #d1fae5; color: #065f46;
                                    @elseif($request->status === 'pending') background: #fef3c7; color: #92400e;
                                    @else background: #fee2e2; color: #991b1b; @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>

                            <td style="padding: 16px 20px; text-align: center;">
                                @if($request->status === 'pending')
                                    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                                        <form action="{{ route('adoptions.approve', $request->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                style="padding: 6px 14px; background: #d1fae5; color: #065f46; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;"
                                                onmouseover="this.style.background='#a7f3d0'" onmouseout="this.style.background='#d1fae5'">
                                                ✅ Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('adoptions.disapprove', $request->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                style="padding: 6px 14px; background: #fee2e2; color: #991b1b; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;"
                                                onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                                ❌ Disapprove
                                            </button>
                                        </form>
                                        <a href="{{ route('users.show', $request->user->id) }}"
                                           style="padding: 6px 14px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none;"
                                           onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                                            👤 View Profile
                                        </a>
                                    </div>
                                @else
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="{{ route('users.show', $request->user->id) }}"
                                           style="padding: 6px 14px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none;"
                                           onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                                            👤 View Profile
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 60px; text-align: center; color: #9ca3af;">
                                <div style="font-size: 36px; margin-bottom: 8px;">📋</div>
                                <p style="font-size: 15px; font-weight: 600;">No adoption requests found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>