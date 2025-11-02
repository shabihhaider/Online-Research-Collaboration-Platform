<?php require __DIR__ . '/../partials/header.php'; ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-red-50 via-rose-50 to-pink-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(239, 68, 68, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Plagiarism Management
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Plagiarism Reports</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Review and manage plagiarism claims to maintain research integrity.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-2xl overflow-hidden animate-fade-in-up">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-red-50 to-rose-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Active Reports</h2>
                        <p class="text-sm text-slate-600">Total: <?= count($reports) ?> reports</p>
                    </div>
                </div>
            </div>

            <?php if (empty($reports)): ?>
                <div class="p-8 text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-2">No Reports</h3>
                    <p class="text-slate-600">No plagiarism reports have been submitted yet.</p>
                </div>
            <?php else: ?>
                <div class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-slate-100 to-red-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Paper</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Reported By</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Reason</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($reports as $index => $report): ?>
                                    <tr class="hover:bg-red-50/30 transition-all duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                </div>
                                                <div class="text-sm font-semibold text-gray-900 max-w-xs truncate"><?= htmlspecialchars($report['paper_title']) ?></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-500 to-slate-700 flex items-center justify-center text-white text-xs font-bold">
                                                    <?= strtoupper(substr($report['reporter_name'], 0, 1)) ?>
                                                </div>
                                                <span class="text-sm text-gray-600"><?= htmlspecialchars($report['reporter_name']) ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 max-w-xs truncate"><?= htmlspecialchars($report['reason']) ?></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?php 
                                                switch($report['status']) {
                                                    case 'Pending': echo 'bg-yellow-100 text-yellow-800'; break;
                                                    case 'Investigating': echo 'bg-blue-100 text-blue-800'; break;
                                                    case 'Resolved': echo 'bg-green-100 text-green-800'; break;
                                                    case 'Dismissed': echo 'bg-gray-100 text-gray-800'; break;
                                                }
                                                ?>">
                                                <?= $report['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            <?= date('M d, Y', strtotime($report['created_at'])) ?>
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <button onclick="openReportModal(<?= htmlspecialchars(json_encode($report)) ?>)" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                Review
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Enhanced Modal -->
<div id="reportModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full z-50 backdrop-blur-sm">
    <div class="relative top-20 mx-auto p-5 w-11/12 md:w-3/4 lg:w-1/2 animate-fade-in-up">
        <div class="bg-white shadow-2xl rounded-3xl border border-slate-200">
            <div class="flex justify-between items-center px-6 py-5 bg-gradient-to-r from-red-50 to-rose-50 border-b border-slate-200 rounded-t-3xl">
                <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Review Plagiarism Report
                </h3>
                <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600 hover:bg-slate-100 rounded-full p-2 transition-all duration-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="p-6"></div>
        </div>
    </div>
</div>

<script>
function openReportModal(report) {
    const modal = document.getElementById('reportModal');
    const content = document.getElementById('modalContent');
    
    content.innerHTML = `
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-slate-50 to-indigo-50 p-4 rounded-xl border border-slate-200">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Paper Title</label>
                <p class="text-sm font-semibold text-slate-900">${report.paper_title}</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Reported By</label>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-500 to-slate-700 flex items-center justify-center text-white text-xs font-bold">
                            ${report.reporter_name.charAt(0).toUpperCase()}
                        </div>
                        <p class="text-sm font-semibold text-slate-900">${report.reporter_name}</p>
                    </div>
                </div>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Current Status</label>
                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full ${
                        report.status === 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                        report.status === 'Investigating' ? 'bg-blue-100 text-blue-800' :
                        report.status === 'Resolved' ? 'bg-green-100 text-green-800' :
                        'bg-gray-100 text-gray-800'
                    }">${report.status}</span>
                </div>
            </div>
            <div class="bg-red-50 p-4 rounded-xl border border-red-200">
                <label class="block text-xs font-semibold text-red-700 uppercase tracking-wider mb-2">Reason for Report</label>
                <p class="text-sm text-slate-900 leading-relaxed">${report.reason}</p>
            </div>
            ${report.evidence ? `
            <div class="bg-orange-50 p-4 rounded-xl border border-orange-200">
                <label class="block text-xs font-semibold text-orange-700 uppercase tracking-wider mb-2">Evidence Provided</label>
                <p class="text-sm text-slate-900 leading-relaxed">${report.evidence}</p>
            </div>
            ` : ''}
            <form action="/admin/plagiarism/update" method="POST" class="space-y-6 border-t border-slate-200 pt-6">
                <input type="hidden" name="report_id" value="${report.id}">
                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-900 mb-3">Update Status</label>
                    <select name="status" id="status" class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 transition-all duration-300 sm:text-sm">
                        <option value="Pending" ${report.status === 'Pending' ? 'selected' : ''}>Pending</option>
                        <option value="Investigating" ${report.status === 'Investigating' ? 'selected' : ''}>Investigating</option><option value="Resolved" ${report.status === 'Resolved' ? 'selected' : ''}>Resolved</option>
                        <option value="Dismissed" ${report.status === 'Dismissed' ? 'selected' : ''}>Dismissed</option>
                    </select>
                </div>
                <div>
                    <label for="admin_notes" class="block text-sm font-semibold text-slate-900 mb-3">Admin Notes</label>
                    <textarea name="admin_notes" id="admin_notes" rows="4" class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 transition-all duration-300 sm:text-sm" placeholder="Add your notes about this investigation...">${report.admin_notes || ''}</textarea>
                </div>
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <button type="button" onclick="closeReportModal()" class="px-6 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-300 rounded-xl hover:bg-slate-50 transition-all duration-300">
                        Cancel
                    </button>
                    <button type="submit" class="btn-shimmer px-6 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300">
                        Update Report
                    </button>
                </div>
            </form>
        </div>
    `;
    
    modal.classList.remove('hidden');
}

function closeReportModal() {
    document.getElementById('reportModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('reportModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeReportModal();
    }
});
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>