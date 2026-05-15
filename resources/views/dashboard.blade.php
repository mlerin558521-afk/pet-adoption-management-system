<x-app-layout>
    <x-slot name="header">{{ __('Dashboard') }}</x-slot>

    <div class="py-6 px-6">

        @if(Auth::user()->role === 'admin')

            <div style="background: linear-gradient(135deg, #7d4a3f, #a0604f); border-radius: 12px; padding: 28px 32px; margin-bottom: 28px; color: white;">
                <h3 style="font-size: 22px; font-weight: 800; margin-bottom: 6px;">
                    Welcome back, {{ Auth::user()->name }}! 👋
                </h3>
                <p style="opacity: 0.85; font-size: 15px;">
                    Here's what's happening in the Pet Adoption Center today.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px;">

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #7d4a3f;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Total Pets</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ \App\Models\Pet::count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">🐾 Listed for adoption</p>
                </div>

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #c9937a;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Total Users</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ \App\Models\User::where('role', 'user')->count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">👤 Registered adopters</p>
                </div>

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #f59e0b;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Pending Adoptions</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ \App\Models\AdoptionRequest::where('status', 'pending')->count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">⏳ Awaiting review</p>
                </div>

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #10b981;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Approved Adoptions</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ \App\Models\AdoptionRequest::where('status', 'approved')->count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">✅ Successfully adopted</p>
                </div>

            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <p style="font-size: 15px; font-weight: 700; color: #374151; margin-bottom: 16px;">Quick Actions</p>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('pets.index') }}" style="padding: 10px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">🐾 Manage Pets</a>
                    <a href="{{ route('users.index') }}" style="padding: 10px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">👤 Manage Users</a>
                    <a href="{{ route('adoptions.index') }}" style="padding: 10px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">📋 Adoption Requests</a>
                    <a href="{{ route('reports.index') }}" style="padding: 10px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">📊 Reports</a>
                </div>
            </div>

        @else

            <div style="background: linear-gradient(135deg, #7d4a3f, #a0604f); border-radius: 12px; padding: 28px 32px; margin-bottom: 28px; color: white;">
                <h3 style="font-size: 22px; font-weight: 800; margin-bottom: 6px;">
                    Welcome back, {{ Auth::user()->name }}! 🐾
                </h3>
                <p style="opacity: 0.85; font-size: 15px;">
                    Your adoption journey continues here. Find your perfect companion today.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px;">

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #7d4a3f;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">My Requests</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ Auth::user()->AdoptionRequests()->count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">📋 Total submitted</p>
                </div>

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #f59e0b;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Pending</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ Auth::user()->AdoptionRequests()->where('status', 'pending')->count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">⏳ Awaiting review</p>
                </div>

                <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #10b981;">
                    <p style="font-size: 13px; font-weight: 600; color: #9ca3af; border-left: 4px solid #10b981; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Approved</p>
                    <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ Auth::user()->AdoptionRequests()->where('status', 'approved')->count() }}</p>
                    <p style="font-size: 13px; color: #6b7280; margin-top: 4px;">✅ Successfully approved</p>
                </div>

            </div>

            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <p style="font-size: 15px; font-weight: 700; color: #374151; margin-bottom: 16px;">Quick Actions</p>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="{{ route('pets.index') }}" style="padding: 10px 20px; background: #7d4a3f; color: white; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">🐾 Browse Pets</a>
                    <a href="{{ route('adoptions.userIndex') }}" style="padding: 10px 20px; background: #f5ede8; color: #7d4a3f; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600;">📋 My Requests</a>
                </div>
            </div>

            <p style="margin-top: 28px; text-align: center; color: #9ca3af; font-style: italic; font-size: 14px;">
                "Every pet deserves a loving home — and you're part of that story."
            </p>

        @endif

    </div>
</x-app-layout>