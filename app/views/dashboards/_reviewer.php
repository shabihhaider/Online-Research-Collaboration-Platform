<div class="bg-white border border-slate-200 rounded-xl shadow-lg">
    <div class="px-6 py-5 border-b border-slate-200">
        <h2 class="text-xl font-semibold text-slate-800">Papers Assigned for Your Review</h2>
    </div>
    <div class="p-6">
        <?php if (empty($data['assignments'])): ?>
            <p class="text-slate-600">You have no pending assignments at this time.</p>
        <?php else: ?>
             <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Author</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <?php foreach ($data['assignments'] as $assignment): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= htmlspecialchars($assignment['title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= htmlspecialchars($assignment['author_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/review/submit/<?= $assignment['assignment_id'] ?>" class="text-indigo-600 hover:text-indigo-800">Submit Review</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>