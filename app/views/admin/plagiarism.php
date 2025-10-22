<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="space-y-6 animate-fadeInUp">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-orange-600 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Plagiarism Reports</h2>
        </div>

        <?php if (empty($reports)): ?>
            <div class="p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No reports</h3>
                <p class="mt-1 text-sm text-gray-500">No plagiarism reports have been submitted yet.</p>
            </div>
        <?php else: ?>
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paper</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($reports as $report): ?>
                            <tr class="hover:bg-gradient-to-r hover:from-red-50 hover:to-orange-50 transition-all">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($report['paper_title']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?= htmlspecialchars($report['reporter_name']) ?></td>
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
                                <td class="px-6 py-4 text-sm text-gray-500"><?= date('M d, Y', strtotime($report['created_at'])) ?></td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <button onclick="openReportModal(<?= htmlspecialchars(json_encode($report)) ?>)" class="text-indigo-600 hover:text-indigo-900">Review</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal for reviewing reports -->
<div id="reportModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-2xl bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Review Plagiarism Report</h3>
            <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="modalContent"></div>
    </div>
</div>

<script>
function openReportModal(report) {
    const modal = document.getElementById('reportModal');
    const content = document.getElementById('modalContent');
    
    content.innerHTML = `
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Paper Title</label>
                <p class="mt-1 text-sm text-gray-900">${report.paper_title}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Reported By</label>
                <p class="mt-1 text-sm text-gray-900">${report.reporter_name}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Reason</label>
                <p class="mt-1 text-sm text-gray-900">${report.reason}</p>
            </div>
            ${report.evidence ? `
            <div>
                <label class="block text-sm font-medium text-gray-700">Evidence</label>
                <p class="mt-1 text-sm text-gray-900">${report.evidence}</p>
            </div>
            ` : ''}
            <form action="/admin/plagiarism/update" method="POST" class="space-y-4">
                <input type="hidden" name="report_id" value="${report.id}">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Pending" ${report.status === 'Pending' ? 'selected' : ''}>Pending</option>
                        <option value="Investigating" ${report.status === 'Investigating' ? 'selected' : ''}>Investigating</option>
                        <option value="Resolved" ${report.status === 'Resolved' ? 'selected' : ''}>Resolved</option>
                        <option value="Dismissed" ${report.status === 'Dismissed' ? 'selected' : ''}>Dismissed</option>
                    </select>
                </div>
                <div>
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                    <textarea name="admin_notes" id="admin_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">${report.admin_notes || ''}</textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeReportModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-md hover:from-indigo-700 hover:to-purple-700">
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
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>