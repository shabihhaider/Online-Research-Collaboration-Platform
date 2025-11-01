<?php
// app/views/editor/decision.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(16, 185, 129, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Reviews Complete
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Make Final Decision</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Review all feedback and make your editorial decision on this submission.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Sidebar - Paper Details -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden sticky top-6 animate-fade-in-up">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-5">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Paper Information
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
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-bold text-sm">
                                    <?= strtoupper(substr($paper['author_name'], 0, 1)) ?>
                                </div>
                                <span class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($paper['author_name']) ?></span>
                            </dd>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Document</dt>
                            <dd>
                                <a href="<?= htmlspecialchars($paper['file_path']) ?>" target="_blank" 
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Download Paper
                                </a>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Reviews Section -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-r from-slate-50 to-emerald-50/30 px-6 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-1">Submitted Reviews</h2>
                        <p class="text-sm text-slate-600">Comprehensive feedback from assigned reviewers</p>
                    </div>
                    
                    <div class="p-6 sm:p-8 space-y-6 max-h-[500px] overflow-y-auto">
                        <?php if (empty($reviews)): ?>
                            <div class="text-center py-12">
                                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-slate-100 to-slate-200 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <p class="text-lg font-semibold text-slate-700 mb-2">No Reviews Yet</p>
                                <p class="text-sm text-slate-500">Reviews are still pending for this paper.</p>
                            </div>
                        <?php else: ?>
                            <?php 
                            $totalScore = 0;
                            $acceptCount = 0;
                            $rejectCount = 0;
                            $reviseCount = 0;
                            
                            foreach ($reviews as $review) {
                                $totalScore += $review['score'];
                                switch ($review['recommendation']) {
                                    case 'Accept': $acceptCount++; break;
                                    case 'Reject': $rejectCount++; break;
                                    default: $reviseCount++;
                                }
                            }
                            $avgScore = count($reviews) > 0 ? round($totalScore / count($reviews), 1) : 0;
                            ?>
                            
                            <!-- Summary Stats -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 pb-6 border-b border-slate-200">
                                <div class="text-center p-4 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl">
                                    <div class="text-2xl font-bold text-indigo-600"><?= $avgScore ?>/5</div>
                                    <div class="text-xs text-slate-600 mt-1">Avg Score</div>
                                </div>
                                <div class="text-center p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl">
                                    <div class="text-2xl font-bold text-green-600"><?= $acceptCount ?></div>
                                    <div class="text-xs text-slate-600 mt-1">Accept</div>
                                </div>
                                <div class="text-center p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl">
                                    <div class="text-2xl font-bold text-yellow-600"><?= $reviseCount ?></div>
                                    <div class="text-xs text-slate-600 mt-1">Revise</div>
                                </div>
                                <div class="text-center p-4 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl">
                                    <div class="text-2xl font-bold text-red-600"><?= $rejectCount ?></div>
                                    <div class="text-xs text-slate-600 mt-1">Reject</div>
                                </div>
                            </div>
                            
                            <?php foreach ($reviews as $index => $review): ?>
                                <div class="border-l-4 p-6 rounded-r-2xl shadow-md hover:shadow-lg transition-all duration-300 animate-fade-in-up
                                    <?php 
                                        switch ($review['recommendation']) {
                                            case 'Accept': echo 'border-green-500 bg-gradient-to-r from-green-50 to-emerald-50'; break;
                                            case 'Reject': echo 'border-red-500 bg-gradient-to-r from-red-50 to-pink-50'; break;
                                            default: echo 'border-yellow-500 bg-gradient-to-r from-yellow-50 to-orange-50';
                                        }
                                    ?>
                                " style="animation-delay: <?= $index * 0.1 ?>s;">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold shadow-md overflow-hidden">
                                                <?php if (!empty($review['reviewer_pic'])): ?>
                                                    <img src="<?= htmlspecialchars($review['reviewer_pic']) ?>" alt="<?= htmlspecialchars($review['reviewer_name']) ?>" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <span class="bg-gradient-to-br from-slate-600 to-slate-800 text-white w-full h-full flex items-center justify-center">
                                                    <?= strtoupper(substr($review['reviewer_name'], 0, 2)) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <p class="text-base font-bold text-slate-900"><?= htmlspecialchars($review['reviewer_name']) ?></p>
                                                <p class="text-xs text-slate-600">Peer Reviewer</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-3">
                                            <div class="flex items-center gap-1 bg-white px-3 py-1.5 rounded-full shadow-sm">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <svg class="w-4 h-4 <?= $i < $review['score'] ? 'text-yellow-400' : 'text-slate-300' ?>" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                <?php endfor; ?>
                                                <span class="ml-2 text-sm font-bold text-slate-700"><?= htmlspecialchars($review['score']) ?>/5</span>
                                            </div>
                                            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm <?php 
                                                switch ($review['recommendation']) {
                                                    case 'Accept': echo 'bg-green-600 text-white'; break;
                                                    case 'Reject': echo 'bg-red-600 text-white'; break;
                                                    default: echo 'bg-yellow-600 text-white';
                                                }
                                            ?>"><?= htmlspecialchars($review['recommendation']) ?></span>
                                        </div>
                                    </div>
                                    <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-slate-200">
                                        <p class="text-sm text-slate-800 leading-relaxed whitespace-pre-line"><?= htmlspecialchars($review['comments']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Decision Form -->
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="bg-gradient-to-r from-slate-50 to-indigo-50/30 px-6 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-1">Your Decision</h2>
                        <p class="text-sm text-slate-600">Provide feedback and make your final editorial decision</p>
                    </div>
                    
                    <form action="/editor/decision" method="POST">
                        <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                        
                        <div class="p-6 sm:p-8">
                            <label for="editor_comments" class="block text-sm font-semibold text-slate-900 mb-3">Comments to Author *</label>
                            <textarea id="editor_comments" name="editor_comments" rows="8" required
                                class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6" 
                                placeholder="Provide your final feedback to the author. This will be shown with your decision..."></textarea>
                            <p class="mt-3 text-sm text-slate-600 flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Your feedback will be sent to the author along with your decision. Be constructive and specific.</span>
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 border-t border-slate-200 px-6 sm:px-8 py-6 bg-gradient-to-r from-slate-50 to-emerald-50/20">
                        <a href="/" class="text-center sm:text-left px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors duration-200 order-1 sm:order-1">Cancel</a>
                        
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 order-2 sm:order-2">
                            <button type="submit" name="decision" value="Rejected" 
                                class="w-full sm:w-auto px-6 py-3.5 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 inline-flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span>Reject</span>
                            </button>
                            <button type="submit" name="decision" value="Revision Requested" 
                                class="w-full sm:w-auto px-6 py-3.5 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 inline-flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                <span>Request Revisions</span>
                            </button>
                            <button type="submit" name="decision" value="Accepted" 
                                class="w-full sm:w-auto px-6 py-3.5 text-sm font-bold text-white bg-green-600 hover:bg-green-700 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 inline-flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Accept</span>
                            </button>
                        </div>
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