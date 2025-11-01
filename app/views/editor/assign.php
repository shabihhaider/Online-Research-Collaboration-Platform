<?php
// app/views/editor/assign.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(99, 102, 241, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                New Submission
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Assign Reviewers</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Select at least two qualified reviewers to evaluate this paper.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Sidebar - Paper Details -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden sticky top-6 animate-fade-in-up">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-5">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Paper Details
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <div>
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Title</dt>
                            <dd class="text-sm font-semibold text-slate-900 leading-relaxed"><?= htmlspecialchars($paper['title']) ?></dd>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Author</dt>
                            <dd class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                                    <?= strtoupper(substr($paper['author_name'], 0, 1)) ?>
                                </div>
                                <span class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($paper['author_name']) ?></span>
                            </dd>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Abstract</dt>
                            <dd class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-200">
                                <?= htmlspecialchars($paper['abstract']) ?>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-r from-slate-50 to-purple-50/30 px-6 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Select Reviewers</h2>
                        <p class="text-sm text-slate-600">Choose qualified reviewers based on their expertise and current workload</p>
                    </div>
                    
                    <form action="/editor/assign" method="POST">
                        <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                        
                        <div class="p-6 sm:p-8">
                            <?php if (empty($reviewers)): ?>
                                <div class="text-center py-12">
                                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-slate-100 to-slate-200 rounded-full flex items-center justify-center">
                                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                    </div>
                                    <p class="text-lg font-semibold text-slate-700 mb-2">No Reviewers Available</p>
                                    <p class="text-sm text-slate-500">Please add users with the 'Reviewer' role first.</p>
                                </div>
                            <?php else: ?>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-2 mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <p class="text-sm text-blue-800"><strong>Tip:</strong> Select at least 2 reviewers. Consider their pending workload when making your selection.</p>
                                    </div>
                                    
                                    <fieldset class="space-y-3">
                                        <legend class="sr-only">Reviewers</legend>
                                        <?php foreach ($reviewers as $index => $reviewer): ?>
                                            <div class="relative flex items-start p-5 rounded-xl border-2 border-slate-200 hover:border-indigo-300 hover:bg-indigo-50/30 transition-all duration-300 cursor-pointer group animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                                <div class="flex h-6 items-center">
                                                    <input id="reviewer_<?= $reviewer['id'] ?>" name="reviewer_ids[]" type="checkbox" value="<?= $reviewer['id'] ?>" 
                                                        class="h-5 w-5 rounded-lg border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-600 cursor-pointer transition-all">
                                                </div>
                                                <div class="ml-4 flex-1">
                                                    <label for="reviewer_<?= $reviewer['id'] ?>" class="cursor-pointer flex items-center justify-between">
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow-md">
                                                                <?= strtoupper(substr($reviewer['name'], 0, 2)) ?>
                                                            </div>
                                                            <div>
                                                                <span class="text-base font-semibold text-slate-900 block group-hover:text-indigo-700 transition-colors">
                                                                    <?= htmlspecialchars($reviewer['name']) ?>
                                                                </span>
                                                                <span class="text-sm text-slate-500">Qualified Reviewer</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-2">
                                                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold <?= $reviewer['pending_assignments'] == 0 ? 'bg-green-100 text-green-700' : ($reviewer['pending_assignments'] <= 2 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                <?= $reviewer['pending_assignments'] ?> pending
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </fieldset>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-4 border-t border-slate-200 px-6 sm:px-8 py-6 bg-gradient-to-r from-slate-50 to-purple-50/20">
                            <a href="/" class="text-center px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors duration-200">Cancel</a>
                            <button type="submit" class="btn-shimmer px-8 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2" <?= empty($reviewers) ? 'disabled' : '' ?>>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span>Assign Selected Reviewers</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>