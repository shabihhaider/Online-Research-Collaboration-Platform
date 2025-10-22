<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="space-y-8 animate-fadeInUp">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Papers -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Papers</p>
                    <p class="text-4xl font-bold mt-2"><?= $stats['total_papers'] ?></p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
                        <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Users</p>
                    <p class="text-4xl font-bold mt-2"><?= $stats['total_users'] ?></p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">This Month</p>
                    <p class="text-4xl font-bold mt-2"><?= $stats['papers_this_month'] ?></p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Under Review -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-all duration-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Under Review</p>
                    <p class="text-4xl font-bold mt-2">
                        <?php 
                        $underReview = array_filter($stats['papers_by_status'], fn($s) => $s['status'] === 'Under Review');
                        echo !empty($underReview) ? reset($underReview)['count'] : 0;
                        ?>
                    </p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Papers by Status -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Papers by Status</h3>
            <div class="space-y-4">
                <?php foreach ($stats['papers_by_status'] as $status): ?>
                    <?php 
                    $percentage = ($status['count'] / $stats['total_papers']) * 100;
                    $colors = [
                        'Submitted' => 'bg-blue-500',
                        'Under Review' => 'bg-yellow-500',
                        'Accepted' => 'bg-green-500',
                        'Rejected' => 'bg-red-500',
                        'Revision Requested' => 'bg-orange-500'
                    ];
                    $color = $colors[$status['status']] ?? 'bg-gray-500';
                    ?>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700"><?= htmlspecialchars($status['status']) ?></span>
                            <span class="text-gray-600"><?= $status['count'] ?> (<?= number_format($percentage, 1) ?>%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="<?= $color ?> h-3 rounded-full transition-all duration-500 shadow-lg" style="width: <?= $percentage ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Users by Role -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Users by Role</h3>
            <div class="space-y-4">
                <?php foreach ($stats['users_by_role'] as $role): ?>
                    <?php 
                    $percentage = ($role['count'] / $stats['total_users']) * 100;
                    $colors = [
                        'Researcher' => 'bg-indigo-500',
                        'Reviewer' => 'bg-purple-500',
                        'Editor' => 'bg-pink-500',
                        'Librarian' => 'bg-cyan-500',
                        'Admin' => 'bg-red-500'
                    ];
                    $color = $colors[$role['role_name']] ?? 'bg-gray-500';
                    ?>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-gray-700"><?= htmlspecialchars($role['role_name']) ?></span>
                            <span class="text-gray-600"><?= $role['count'] ?> (<?= number_format($percentage, 1) ?>%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="<?= $color ?> h-3 rounded-full transition-all duration-500 shadow-lg" style="width: <?= $percentage ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Monthly Submissions Chart -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Monthly Submissions (Last 12 Months)</h3>
        <div class="h-64">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = <?= json_encode($stats['monthly_submissions']) ?>;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(d => d.month),
            datasets: [{
                label: 'Submissions',
                data: monthlyData.map(d => d.count),
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgb(99, 102, 241)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>