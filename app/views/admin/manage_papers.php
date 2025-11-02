<?php require __DIR__ . '/../partials/header.php'; ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(16, 185, 129, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Paper Management
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Manage All Papers</h1>
            <p class="text-lg text-slate-600 max-w-3xl">View, update status, and manage all research papers in the system.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-2xl overflow-hidden animate-fade-in-up">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-emerald-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">All Papers</h2>
                        <p class="text-sm text-slate-600">Total: <?= count($papers) ?> papers</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-emerald-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Current Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Change Status</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($papers as $index => $paper): ?>
                                <tr class="hover:bg-emerald-50/30 transition-colors duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900 max-w-xs">
                                        <div class="truncate"><?= htmlspecialchars($paper['title']) ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white text-xs font-bold">
                                                <?= strtoupper(substr($paper['author_name'], 0, 1)) ?>
                                            </div>
                                            <span class="text-sm text-slate-700"><?= htmlspecialchars($paper['author_name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php 
                                            switch ($paper['status']) {
                                                case 'Submitted': echo 'bg-blue-100 text-blue-800'; break;
                                                case 'Under Review': echo 'bg-yellow-100 text-yellow-800'; break;
                                                case 'Revision Requested': echo 'bg-orange-100 text-orange-800'; break;
                                                case 'Accepted': echo 'bg-green-100 text-green-800'; break;
                                                case 'Rejected': echo 'bg-red-100 text-red-800'; break;
                                                default: echo 'bg-slate-100 text-slate-800';
                                            }
                                        ?>">
                                            <?= htmlspecialchars($paper['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="/admin/manage/paper/status" method="POST" class="flex gap-2">
                                            <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                                            <select name="status" class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm transition-all duration-300">
                                                <option value="Submitted" <?= $paper['status'] == 'Submitted' ? 'selected' : '' ?>>Submitted</option>
                                                <option value="Under Review" <?= $paper['status'] == 'Under Review' ? 'selected' : '' ?>>Under Review</option>
                                                <option value="Revision Requested" <?= $paper['status'] == 'Revision Requested' ? 'selected' : '' ?>>Revision Requested</option>
                                                <option value="Accepted" <?= $paper['status'] == 'Accepted' ? 'selected' : '' ?>>Accepted</option>
                                                <option value="Rejected" <?= $paper['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                            </select>
                                            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                                Save
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="/admin/manage/paper/delete" method="POST" onsubmit="return confirm('Are you sure? This will delete the paper, assignments, and reviews.');" style="display: inline;">
                                            <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>