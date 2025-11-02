<?php
// app/views/reviews/submit.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(79, 70, 229, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Review Assignment
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Submit Your Review</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Provide your expert feedback and evaluation for this research paper.</p>
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
                            <dd class="text-sm font-semibold text-slate-900 leading-relaxed"><?= htmlspecialchars($assignment['title']) ?></dd>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Author</dt>
                            <dd class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                                    <?= strtoupper(substr($assignment['author_name'], 0, 1)) ?>
                                </div>
                                <span class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($assignment['author_name']) ?></span>
                            </dd>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Abstract</dt>
                            <dd class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-200 max-h-64 overflow-y-auto">
                                <?= nl2br(htmlspecialchars($assignment['abstract'])) ?>
                            </dd>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Document</dt>
                            <dd>
                                <a href="<?= htmlspecialchars($assignment['file_path']) ?>" target="_blank" 
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 w-full justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Download Paper
                                </a>
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-r from-slate-50 to-purple-50/30 px-6 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Your Review</h2>
                        <p class="text-sm text-slate-600">Provide detailed, constructive feedback for the author</p>
                    </div>
                    
                    <form action="/review/submit" method="POST">
                        <input type="hidden" name="assignment_id" value="<?= $assignment['assignment_id'] ?>">
                        
                        <div class="p-6 sm:p-8 space-y-8">
                            
                            <!-- Comments Section -->
                            <div>
                                <label for="comments" class="block text-sm font-semibold text-slate-900 mb-3">Detailed Comments *</label>
                                <textarea id="comments" name="comments" rows="10" required 
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6" 
                                    placeholder="Provide comprehensive feedback on:&#10;• Research methodology and approach&#10;• Quality and clarity of writing&#10;• Originality and significance&#10;• Strengths and areas for improvement&#10;• Specific suggestions for revision"></textarea>
                                <p class="mt-3 text-sm text-slate-600 flex items-start gap-2">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Be constructive, specific, and objective. Your feedback helps improve the quality of research.</span>
                                </p>
                            </div>

                            <!-- Overall Score Section -->
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-2xl border border-indigo-200">
                                <label class="text-base font-bold text-slate-900 mb-4 block flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    Overall Score *
                                </label>
                                <fieldset class="mt-4">
                                    <legend class="sr-only">Score</legend>
                                    <div class="grid grid-cols-5 gap-3">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <div class="relative">
                                            <input id="score_<?= $i ?>" name="score" type="radio" value="<?= $i ?>" required class="peer sr-only">
                                            <label for="score_<?= $i ?>" class="flex flex-col items-center justify-center p-4 bg-white rounded-xl border-2 border-slate-300 cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 peer-checked:border-indigo-600 peer-checked:bg-indigo-600 transition-all duration-300 group">
                                                <svg class="w-8 h-8 mb-2 text-slate-400 group-hover:text-indigo-600 peer-checked:group-[]:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                <span class="text-2xl font-bold text-slate-700 group-hover:text-indigo-700 peer-checked:group-[]:text-white transition-colors"><?= $i ?></span>
                                                <span class="text-xs font-medium text-slate-500 group-hover:text-indigo-700 peer-checked:group-[]:text-white mt-1 transition-colors">
                                                    <?php 
                                                        $labels = ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
                                                        echo $labels[$i-1];
                                                    ?>
                                                </span>
                                            </label>
                                        </div>
                                        <?php endfor; ?>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Recommendation Section -->
                            <div>
                                <label for="recommendation" class="block text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Final Recommendation *
                                </label>
                                <select id="recommendation" name="recommendation" required 
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6">
                                    <option value="" disabled selected>Select your recommendation</option>
                                    <option value="Accept">✓ Accept - Ready for publication</option>
                                    <option value="Minor Revisions">↻ Minor Revisions - Small improvements needed</option>
                                    <option value="Major Revisions">⟲ Major Revisions - Significant changes required</option>
                                    <option value="Reject">✗ Reject - Does not meet standards</option>
                                </select>
                                <p class="mt-3 text-sm text-slate-600">Your recommendation should align with your score and comments.</p>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-4 border-t border-slate-200 px-6 sm:px-8 py-6 bg-gradient-to-r from-slate-50 to-purple-50/20">
                            <a href="/" class="text-center px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors duration-200">Cancel</a>
                            <button type="submit" class="btn-shimmer px-8 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Submit Review</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
require __DIR__ . '/../partials/footer.php';
?>