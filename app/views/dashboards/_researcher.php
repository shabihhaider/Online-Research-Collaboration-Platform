<?php
// We split the keywords string into an array
function getKeywords($keywordsStr) {
    return array_filter(array_map('trim', explode(',', $keywordsStr)));
}

// A simple SVG placeholder for the profile picture
function getProfilePlaceholder() {
    return '<svg class="w-full h-full text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>';
}
?>

<div class="space-y-12">

    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden animate-fade-in-up hover:shadow-2xl transition-all duration-300">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-indigo-50/30">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-indigo-900 bg-clip-text text-transparent">My Submissions</h2>
                <a href="/submit" class="btn-shimmer px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Submit New Paper
                    </span>
                </a>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($data['papers'])): ?>
                <p class="text-slate-600">You have not submitted any papers yet. Click the "Submit New Paper" button to get started.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Submitted On</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($data['papers'] as $paper): ?>
                                <tr class="hover:bg-indigo-50/30 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900"><?= htmlspecialchars($paper['title']) ?></td>
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

    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-purple-50/30">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-purple-900 bg-clip-text text-transparent">Research Library</h2>
        </div>
        <div class="p-6">
            <?php if (empty($data['published_papers'])): ?>
                <p class="text-slate-600">No papers have been published to the library yet.</p>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($data['published_papers'] as $paper): ?>
                        <div class="flex flex-col bg-white border border-slate-200 rounded-2xl shadow-lg overflow-hidden 
                            transition-all duration-500 ease-out 
                            hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-300 group animate-fade-in-up">
                            
                            <div class="flex items-center p-4 bg-gradient-to-r from-slate-50 to-indigo-50/20 border-b border-slate-200">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-500 ring-2 ring-white shadow-md">
                                    <?php if (!empty($paper['profile_pic'])): ?>
                                        <img src="<?= htmlspecialchars($paper['profile_pic']) ?>" alt="<?= htmlspecialchars($paper['author_name']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <?= getProfilePlaceholder() ?>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($paper['author_name']) ?></p>
                                    <p class="text-xs text-slate-500">
                                        Published on: <?= date('M d, Y', strtotime($paper['published_at'])) ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="p-5 flex-grow">
                                <h3 class="text-lg font-semibold text-slate-800 mb-2 group-hover:text-indigo-600 transition-colors">
                                    <?= htmlspecialchars($paper['title']) ?>
                                </h3>
                                
                                <div class="mb-4">
                                    <p class="text-xs font-medium text-slate-400 uppercase mb-2">Topics</p>
                                    <div class="flex flex-wrap gap-2">
                                        <?php foreach (getKeywords($paper['keywords']) as $keyword): ?>
                                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 rounded-full text-xs font-medium">
                                                <?= htmlspecialchars($keyword) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 bg-gradient-to-r from-slate-50 to-indigo-50/20 border-t border-slate-200">
                                <a href="/library/paper/<?= $paper['paper_id'] ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 hover:gap-3 transition-all duration-300">
                                    <span>Read Paper</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>