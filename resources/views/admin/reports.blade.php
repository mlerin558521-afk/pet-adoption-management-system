<x-app-layout>
    <x-slot name="header">{{ __('Reports') }}</x-slot>

    <div class="py-6 px-6">

        {{-- Top Bar --}}
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 20px; font-weight: 800; color: #1f2937;">System Reports</h3>
            <p style="font-size: 13px; color: #9ca3af; margin-top: 2px;">Overview of system statistics and insights</p>
        </div>

        {{-- Stat Summary Cards --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 28px;">
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #7d4a3f;">
                <p style="font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Total Pets</p>
                <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ $petsAvailable + $petsAdopted }}</p>
            </div>
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #10b981;">
                <p style="font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Approved</p>
                <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ $requestsApproved }}</p>
            </div>
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #f59e0b;">
                <p style="font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Pending</p>
                <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ $requestsPending }}</p>
            </div>
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08); border-left: 4px solid #dc2626;">
                <p style="font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Disapproved</p>
                <p style="font-size: 32px; font-weight: 800; color: #1f2937;">{{ $requestsDisapproved }}</p>
            </div>
        </div>

        {{-- Charts Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">

            <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <h4 style="font-size: 15px; font-weight: 700; color: #1f2937; margin-bottom: 16px;">Adoption Requests Summary</h4>
                <canvas id="requestsChart"></canvas>
            </div>

            <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <h4 style="font-size: 15px; font-weight: 700; color: #1f2937; margin-bottom: 16px;">Pets Overview</h4>
                <canvas id="petsChart"></canvas>
            </div>

            <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <h4 style="font-size: 15px; font-weight: 700; color: #1f2937; margin-bottom: 16px;">User Activity</h4>
                <canvas id="usersChart"></canvas>
            </div>

            <div style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(125,74,63,0.08);">
                <h4 style="font-size: 15px; font-weight: 700; color: #1f2937; margin-bottom: 16px;">System Health</h4>
                <canvas id="systemChart"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartDefaults = {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { color: '#9ca3af', font: { size: 12 } } },
                x: { grid: { display: false }, ticks: { color: '#6b7280', font: { size: 12 } } }
            }
        };

        new Chart(document.getElementById('requestsChart'), {
            type: 'bar',
            data: {
                labels: ['Pending', 'Approved', 'Disapproved'],
                datasets: [{
                    data: [{{ $requestsPending }}, {{ $requestsApproved }}, {{ $requestsDisapproved }}],
                    backgroundColor: ['#fef3c7', '#d1fae5', '#fee2e2'],
                    borderColor: ['#f59e0b', '#10b981', '#dc2626'],
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: chartDefaults
        });

        new Chart(document.getElementById('petsChart'), {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Adopted'],
                datasets: [{
                    data: [{{ $petsAvailable }}, {{ $petsAdopted }}],
                    backgroundColor: ['#f5ede8', '#7d4a3f'],
                    borderColor: ['#c9937a', '#5c332b'],
                    borderWidth: 2,
                }]
            },
            options: { plugins: { legend: { position: 'bottom', labels: { color: '#6b7280', font: { size: 12 } } } } }
        });

        new Chart(document.getElementById('usersChart'), {
            type: 'bar',
            data: {
                labels: ['Total', 'Active', 'Inactive'],
                datasets: [{
                    data: [{{ $totalUsers }}, {{ $activeUsers }}, {{ $inactiveUsers }}],
                    backgroundColor: ['#e0f2fe', '#d1fae5', '#f3f4f6'],
                    borderColor: ['#0369a1', '#10b981', '#9ca3af'],
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: chartDefaults
        });

        new Chart(document.getElementById('systemChart'), {
            type: 'doughnut',
            data: {
                labels: ['Healthy', 'Errors'],
                datasets: [{
                    data: [1, {{ $errorsCount }}],
                    backgroundColor: ['#d1fae5', '#fee2e2'],
                    borderColor: ['#10b981', '#dc2626'],
                    borderWidth: 2,
                }]
            },
            options: { plugins: { legend: { position: 'bottom', labels: { color: '#6b7280', font: { size: 12 } } } } }
        });
    </script>

</x-app-layout>