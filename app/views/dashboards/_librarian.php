<div class="space-y-8 animate-fade-in-up">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-xl border border-slate-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-cyan-600/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-green-500 to-cyan-600 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Total Published Papers</p>
                    <p class="text-4xl font-bold bg-gradient-to-r from-green-600 to-cyan-600 bg-clip-text text-transparent"><?= $data['stats']['total_published'] ?></p>
                </div>
            </div>
        </div>
        
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-xl border border-slate-200 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-500/10 to-orange-500/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-yellow-500 to-orange-500 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-wide">Citations Pending</p>
                    <p class="text-4xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent"><?= $data['stats']['pending_citations'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Citations Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-orange-50/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L15.232 5.232z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Pending Citations (To-Do)</h2>
                    <p class="text-sm text-slate-600">Papers published but missing official citations</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($data['pending_papers'])): ?>
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-slate-700 mb-2">All Up to Date!</p>
                    <p class="text-slate-600">No papers are pending a citation. Great job!</p>
                </div>
            <?php else: ?>
                 <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-orange-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($data['pending_papers'] as $index => $paper): ?>
                                <tr class="hover:bg-orange-50/30 transition-colors duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900"><?= htmlspecialchars($paper['title']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center text-white text-xs font-bold">
                                                <?= strtoupper(substr($paper['author_name'], 0, 1)) ?>
                                            </div>
                                            <span class="text-sm text-slate-700"><?= htmlspecialchars($paper['author_name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/library/edit/<?= $paper['library_id'] ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Add Citation
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

    <!-- Full Published Library Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-cyan-50/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-cyan-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Full Published Library</h2>
                    <p class="text-sm text-slate-600">Complete list of all published papers in the system</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <?php if (empty($data['all_papers'])): ?>
                <div class="text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-slate-100 to-slate-200 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <p class="text-lg font-semibold text-slate-700 mb-2">Library Empty</p>
                    <p class="text-slate-600">There are no published papers in the library yet.</p>
                </div>
            <?php else: ?>
                 <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-cyan-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-600 uppercase tracking-wider">Citation Status</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($data['all_papers'] as $index => $paper): ?>
                                <tr class="hover:bg-cyan-50/30 transition-colors duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-900"><?= htmlspecialchars($paper['title']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-500 to-cyan-600 flex items-center justify-center text-white text-xs font-bold">
                                                <?= strtoupper(substr($paper['author_name'], 0, 1)) ?>
                                            </div>
                                            <span class="text-sm text-slate-700"><?= htmlspecialchars($paper['author_name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?php if (!empty($paper['citation'])): ?>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                Complete
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Pending
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/library/edit/<?= $paper['library_id'] ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit Citation
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
</div>