<x-app-layout>
    <x-slot name="header">{{ __('Manage Users') }}</x-slot>

    <div class="py-6 px-6">

        {{-- Top Bar --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div>
                <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">All Users</h3>
                <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">Manage all registered accounts</p>
            </div>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('users.index') }}"
              style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); display: flex; gap: 12px; align-items: flex-end;">
            <div style="flex: 1;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px;">Search</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name..."
                       style="width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 14px; outline: none;"
                       onfocus="this.style.borderColor='#7d4a3f'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <button type="submit"
                    style="padding: 9px 20px; background: #7d4a3f; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                    onmouseover="this.style.background='#5c332b'" onmouseout="this.style.background='#7d4a3f'">
                Search
            </button>
            <a href="{{ route('users.index') }}"
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
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">ID</th>
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">Name</th>
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">Email</th>
                        <th style="padding: 14px 20px; text-align: left; font-size: 13px; font-weight: 700; color: white;">Role</th>
                        <th style="padding: 14px 20px; text-align: center; font-size: 13px; font-weight: 700; color: white;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.15s;"
                            onmouseover="this.style.background='#fdf8f6'" onmouseout="this.style.background='white'">

                            <td style="padding: 16px 20px; font-size: 14px; color: #6b7280; font-weight: 600;">
                                #{{ $user->id }}
                            </td>

                            <td style="padding: 16px 20px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 36px; height: 36px; background: #7d4a3f; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 14px; flex-shrink: 0;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span style="font-size: 14px; font-weight: 600; color: #1f2937;">{{ $user->name }}</span>
                                </div>
                            </td>

                            <td style="padding: 16px 20px; font-size: 14px; color: #6b7280;">
                                {{ $user->email }}
                            </td>

                            <td style="padding: 16px 20px;">
                                <span style="font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 999px;
                                    {{ $user->role === 'admin' ? 'background: #f5ede8; color: #7d4a3f;' : 'background: #e0f2fe; color: #0369a1;' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td style="padding: 16px 20px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       style="padding: 6px 14px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none;"
                                       onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                                        ✏️ Edit
                                    </a>
                                    <button type="button"
                                            onclick="openDeleteModal('{{ $user->name }}', '{{ route('users.destroy', $user->id) }}')"
                                            style="padding: 6px 14px; background: #fee2e2; color: #991b1b; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;"
                                            onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                        🗑️ Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 60px; text-align: center; color: #9ca3af;">
                                <div style="font-size: 36px; margin-bottom: 8px;">👤</div>
                                <p style="font-size: 15px; font-weight: 600;">No users found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- Delete Modal --}}
    <div id="deleteModal" style="position: fixed; inset: 0; z-index: 50; display: none; align-items: center; justify-content: center; background: rgba(0,0,0,0.5);">
        <div style="background: white; border-radius: 16px; padding: 32px; width: 360px; box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
            <div style="font-size: 36px; text-align: center; margin-bottom: 12px;">🗑️</div>
            <h2 style="font-size: 18px; font-weight: 800; color: #1f2937; text-align: center; margin-bottom: 8px;">Delete User</h2>
            <p style="font-size: 14px; color: #6b7280; text-align: center; margin-bottom: 24px;">
                Are you sure you want to delete <span id="deleteUserName" style="font-weight: 700; color: #1f2937;"></span>? This action cannot be undone.
            </p>
            <div style="display: flex; gap: 12px;">
                <button onclick="closeDeleteModal()"
                        style="flex: 1; padding: 10px; background: #f5ede8; color: #7d4a3f; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                        onmouseover="this.style.background='#eedad3'" onmouseout="this.style.background='#f5ede8'">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" style="flex: 1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            style="width: 100%; padding: 10px; background: #dc2626; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;"
                            onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(userName, actionUrl) {
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteForm').action = actionUrl;
            document.getElementById('deleteModal').style.display = 'flex';
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
    </script>

</x-app-layout>