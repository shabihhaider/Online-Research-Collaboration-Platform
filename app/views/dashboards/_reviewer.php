<div class="space-y-8 animate-fade-in-up">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-xl border border-slate-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-500/10 to-purple-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Pending Reviews</p>
                    <p class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent"><?= $data['stats']['pending'] ?></p>
                </div>
            </div>
        </div>
        
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-xl border border-slate-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-emerald-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Completed Reviews</p>
                    <p class="text-4xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent"><?= $data['stats']['completed'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Assignments Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-indigo-50/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900">Papers Assigned for Your Review</h2>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($data['assignments'])): ?>
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-slate-700 mb-2">All Caught Up!</p>
                    <p class="text-slate-600">You have no pending assignments at this time.</p>
                </div>
            <?php else: ?>
                 <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($data['assignments'] as $index => $assignment): ?>
                                <tr class="hover:bg-indigo-50/30 transition-colors duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900"><?= htmlspecialchars($assignment['title']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                                                <?= strtoupper(substr($assignment['author_name'], 0, 1)) ?>
                                            </div>
                                            <span class="text-sm text-slate-700"><?= htmlspecialchars($assignment['author_name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/review/submit/<?= $assignment['assignment_id'] ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Submit Review
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Review History Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-emerald-50/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <h2 class="text-xl font-bold text-slate-900">My Review History</h2>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($data['completed_reviews'])): ?>
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-slate-700 mb-2">No Reviews Yet</p>
                    <p class="text-slate-600">You have not completed any reviews yet.</p>
                </div>
            <?php else: ?>
                 <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-emerald-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">My Score</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Recommendation</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Completed On</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($data['completed_reviews'] as $index => $review): ?>
                                <tr class="hover:bg-emerald-50/30 transition-colors duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900"><?= htmlspecialchars($review['title']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center gap-1">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <svg class="w-4 h-4 <?= $i < $review['score'] ? 'text-yellow-400' : 'text-slate-300' ?>" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="text-sm font-bold text-slate-700 ml-1"><?= htmlspecialchars($review['score']) ?>/5</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php 
                                            switch ($review['recommendation']) {
                                                case 'Accept': echo 'bg-green-100 text-green-800'; break;
                                                case 'Reject': echo 'bg-red-100 text-red-800'; break;
                                                case 'Minor Revisions': echo 'bg-blue-100 text-blue-800'; break;
                                                default: echo 'bg-yellow-100 text-yellow-800';
                                            }
                                        ?>">
                                            <?= htmlspecialchars($review['recommendation']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <?= date('M d, Y', strtotime($review['submitted_at'])) ?>
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