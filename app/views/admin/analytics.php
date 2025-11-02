<?php require __DIR__ . '/../partials/header.php'; ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-violet-50 via-purple-50 to-fuchsia-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(139, 92, 246, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-violet-100 text-violet-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                System Analytics
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">System Analytics</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Comprehensive insights and statistics about your research management system.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-fade-in-up">
            <!-- Total Papers -->
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-semibold uppercase tracking-wide">Total Papers</p>
                        <p class="text-5xl font-bold mt-2"><?= $stats['total_papers'] ?></p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/>
                            <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-semibold uppercase tracking-wide">Total Users</p>
                        <p class="text-5xl font-bold mt-2"><?= $stats['total_users'] ?></p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- This Month -->
            <div class="relative overflow-hidden bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-semibold uppercase tracking-wide">This Month</p>
                        <p class="text-5xl font-bold mt-2"><?= $stats['papers_this_month'] ?></p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Under Review -->
            <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-2xl p-6 text-white transform hover:scale-105 transition-all duration-300 group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-semibold uppercase tracking-wide">Under Review</p>
                        <p class="text-5xl font-bold mt-2">
                            <?php 
                            $underReview = array_filter($stats['papers_by_status'], fn($s) => $s['status'] === 'Under Review');
                            echo !empty($underReview) ? reset($underReview)['count'] : 0;
                            ?>
                        </p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4 group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Papers by Status -->
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 border border-slate-200 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Papers by Status</h3>
                </div>
                <div class="space-y-4">
                    <?php foreach ($stats['papers_by_status'] as $status): ?>
                        <?php 
                        $percentage = $stats['total_papers'] > 0 ? ($status['count'] / $stats['total_papers']) * 100 : 0;
                        $colors = [
                            'Submitted' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-700'],
                            'Under Review' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-700'],
                            'Accepted' => ['bg' => 'bg-green-500', 'text' => 'text-green-700'],
                            'Rejected' => ['bg' => 'bg-red-500', 'text' => 'text-red-700'],
                            'Revision Requested' => ['bg' => 'bg-orange-500', 'text' => 'text-orange-700']
                        ];
                        $color = $colors[$status['status']] ?? ['bg' => 'bg-gray-500', 'text' => 'text-gray-700'];
                        ?>
                        <div>
                            <div class="flex justify-between items-center text-sm mb-2">
                                <span class="font-semibold <?= $color['text'] ?> flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full <?= $color['bg'] ?>"></span>
                                    <?= htmlspecialchars($status['status']) ?>
                                </span>
                                <span class="text-slate-600 font-bold"><?= $status['count'] ?> <span class="text-xs font-normal">(<?= number_format($percentage, 1) ?>%)</span></span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden shadow-inner">
                                <div class="<?= $color['bg'] ?> h-3 rounded-full transition-all duration-700 shadow-lg" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Users by Role -->
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 border border-slate-200 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Users by Role</h3>
                </div>
                <div class="space-y-4">
                    <?php foreach ($stats['users_by_role'] as $role): ?>
                        <?php 
                        $percentage = $stats['total_users'] > 0 ? ($role['count'] / $stats['total_users']) * 100 : 0;
                        $colors = [
                            'Researcher' => ['bg' => 'bg-indigo-500', 'text' => 'text-indigo-700'],
                            'Reviewer' => ['bg' => 'bg-purple-500', 'text' => 'text-purple-700'],
                            'Editor' => ['bg' => 'bg-pink-500', 'text' => 'text-pink-700'],
                            'Librarian' => ['bg' => 'bg-cyan-500', 'text' => 'text-cyan-700'],
                            'Admin' => ['bg' => 'bg-red-500', 'text' => 'text-red-700']
                        ];
                        $color = $colors[$role['role_name']] ?? ['bg' => 'bg-gray-500', 'text' => 'text-gray-700'];
                        ?>
                        <div>
                            <div class="flex justify-between items-center text-sm mb-2">
                                <span class="font-semibold <?= $color['text'] ?> flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full <?= $color['bg'] ?>"></span>
                                    <?= htmlspecialchars($role['role_name']) ?>
                                </span>
                                <span class="text-slate-600 font-bold"><?= $role['count'] ?> <span class="text-xs font-normal">(<?= number_format($percentage, 1) ?>%)</span></span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden shadow-inner">
                                <div class="<?= $color['bg'] ?> h-3 rounded-full transition-all duration-700 shadow-lg" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Monthly Submissions Chart -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 border border-slate-200 animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Monthly Submissions Trend</h3>
                    <p class="text-sm text-slate-600">Last 12 months submission history</p>
                </div>
            </div>
            <div class="h-80">
                <canvas id="monthlyChart"></canvas>
            </div>
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
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: 'rgb(99, 102, 241)',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointHoverBackgroundColor: 'rgb(79, 70, 229)',
                pointHoverBorderWidth: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    borderColor: 'rgba(99, 102, 241, 0.5)',
                    borderWidth: 2,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        color: '#64748b'
                    },
                    grid: {
                        color: 'rgba(226, 232, 240, 0.8)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        color: '#64748b'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>