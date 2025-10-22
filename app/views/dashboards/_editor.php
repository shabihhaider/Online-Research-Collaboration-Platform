<div class="space-y-8">
    <div class="bg-white border border-slate-200 rounded-xl shadow-lg">
        <div class="px-6 py-5 border-b border-slate-200">
            <h2 class="text-xl font-semibold text-slate-800">New Submissions Awaiting Review</h2>
        </div>
        <div class="p-6">
            <?php if (empty($data['submitted_papers'])): ?>
                <p class="text-slate-600">There are no new submissions at this time.</p>
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
                             <?php foreach ($data['submitted_papers'] as $paper): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= htmlspecialchars($paper['title']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= htmlspecialchars($paper['author_name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/editor/assign/<?= $paper['id'] ?>" class="text-indigo-600 hover:text-indigo-800">Assign Reviewers</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-lg">
        <div class="px-6 py-5 border-b border-slate-200">
            <h2 class="text-xl font-semibold text-slate-800">Papers Awaiting Final Decision</h2>
        </div>
        <div class="p-6">
            <?php if (empty($data['decision_papers'])): ?>
                <p class="text-slate-600">There are no papers awaiting a final decision at this time.</p>
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
                             <?php foreach ($data['decision_papers'] as $paper): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= htmlspecialchars($paper['title']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= htmlspecialchars($paper['author_name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/editor/decision/<?= $paper['id'] ?>" class="text-indigo-600 hover:text-indigo-800">Make Decision</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>