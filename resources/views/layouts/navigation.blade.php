<nav x-data="{ open: false }"
     style="background: #7d4a3f; width: 280px; min-width: 280px; height: 100vh; display: flex; flex-direction: column; justify-content: space-between; position: sticky; top: 0;">

    <!-- Logo + Title -->
    <div>
        <div style="display: flex; align-items: center; gap: 10px; padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.15);">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('pams/paw.png') }}" alt="Logo" style="width: 38px; height: 38px; filter: brightness(0) invert(1);">
            </a>
            <span style="font-weight: 800; font-size: 16px; color: white; letter-spacing: 1px; text-transform: uppercase;">Pet Adoption</span>
        </div>

        <!-- Nav Links -->
        <div style="display: flex; flex-direction: column; padding: 20px 12px; gap: 4px;">

            <a href="{{ route('dashboard') }}"
               style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s;
               {{ request()->routeIs('dashboard') ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.75);' }}"
               onmouseover="if(!{{ request()->routeIs('dashboard') ? 'true' : 'false' }}) this.style.background='rgba(255,255,255,0.1)'"
               onmouseout="if(!{{ request()->routeIs('dashboard') ? 'true' : 'false' }}) this.style.background='transparent'">
                <span style="font-size: 18px;">📊</span>
                Dashboard
            </a>

            <a href="{{ route('pets.index') }}"
               style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s;
               {{ request()->routeIs('pets.*') ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.75);' }}"
               onmouseover="if(!{{ request()->routeIs('pets.*') ? 'true' : 'false' }}) this.style.background='rgba(255,255,255,0.1)'"
               onmouseout="if(!{{ request()->routeIs('pets.*') ? 'true' : 'false' }}) this.style.background='transparent'">
                <span style="font-size: 18px;">🐾</span>
                Manage Pets
            </a>

            <a href="{{ route('users.index') }}"
               style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s;
               {{ request()->routeIs('users.*') ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.75);' }}"
               onmouseover="if(!{{ request()->routeIs('users.*') ? 'true' : 'false' }}) this.style.background='rgba(255,255,255,0.1)'"
               onmouseout="if(!{{ request()->routeIs('users.*') ? 'true' : 'false' }}) this.style.background='transparent'">
                <span style="font-size: 18px;">👤</span>
                Manage Users
            </a>

            <a href="{{ route('adoptions.index') }}"
               style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s;
               {{ request()->routeIs('adoptions.*') ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.75);' }}"
               onmouseover="if(!{{ request()->routeIs('adoptions.*') ? 'true' : 'false' }}) this.style.background='rgba(255,255,255,0.1)'"
               onmouseout="if(!{{ request()->routeIs('adoptions.*') ? 'true' : 'false' }}) this.style.background='transparent'">
                <span style="font-size: 18px;">📋</span>
                Adoption Requests
            </a>

            <a href="{{ route('reports.index') }}"
               style="display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s;
               {{ request()->routeIs('reports.*') ? 'background: rgba(255,255,255,0.2); color: white;' : 'color: rgba(255,255,255,0.75);' }}"
               onmouseover="if(!{{ request()->routeIs('reports.*') ? 'true' : 'false' }}) this.style.background='rgba(255,255,255,0.1)'"
               onmouseout="if(!{{ request()->routeIs('reports.*') ? 'true' : 'false' }}) this.style.background='transparent'">
                <span style="font-size: 18px;">📊</span>
                Reports
            </a>

        </div>
    </div>
</nav>