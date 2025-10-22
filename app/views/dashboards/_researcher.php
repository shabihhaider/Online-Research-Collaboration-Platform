<div class="bg-white border border-slate-200 rounded-xl shadow-lg">
    <div class="px-6 py-5 border-b border-slate-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-slate-800">My Submissions</h2>
            <a href="/submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Submit New Paper</a>
        </div>
    </div>
    <div class="p-6">
        <?php if (empty($data['papers'])): ?>
            <p class="text-slate-600">You have not submitted any papers yet. Click the "Submit New Paper" button to get started.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Submitted On</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <?php foreach ($data['papers'] as $paper): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= htmlspecialchars($paper['title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php 
                                            switch ($paper['status']) {
                                                case 'Submitted': echo 'bg-blue-100 text-blue-800'; break;
                                                case 'Under Review': echo 'bg-yellow-100 text-yellow-800'; break;
                                                case 'Revision Requested': echo 'bg-orange-100 text-orange-800'; break;
                                                case 'Accepted': echo 'bg-green-100 text-green-800'; break;
                                                case 'Rejected': echo 'bg-red-100 text-red-800'; break;
                                                default: echo 'bg-slate-100 text-slate-800';
                                            }
                                        ?>
                                    ">
                                        <?= htmlspecialchars($paper['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= date('M d, Y', strtotime($paper['submitted_at'])) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <?php if ($paper['status'] === 'Revision Requested'): ?>
                                        <a href="/paper/revise/<?= $paper['id'] ?>" class="text-indigo-600 hover:text-indigo-800">Submit Revision</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>