<?php require __DIR__ . '/../partials/header.php'; ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(249, 115, 22, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Revision Required
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Submit Your Revision</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Review the feedback from our reviewers and editor, then submit your revised paper below.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Sidebar - Feedback -->
            <div class="lg:col-span-1 space-y-6">
                <div class="animate-fade-in-up">
                    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                Reviewer Feedback
                            </h2>
                        </div>
                        
                        <div class="p-6 space-y-6 max-h-[600px] overflow-y-auto">
                            <?php if (!empty($paper['editor_comments'])): ?>
                            <div class="animate-fade-in-up">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-slate-900">Editor's Feedback</h3>
                                        <p class="text-xs text-slate-500">Official comments</p>
                                    </div>
                                </div>
                                <div class="border-l-4 border-indigo-500 bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-r-xl">
                                    <p class="text-sm text-slate-700 leading-relaxed"><?= nl2br(htmlspecialchars($paper['editor_comments'])) ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php foreach ($reviews as $index => $review): ?>
                                <div class="animate-fade-in-up" style="animation-delay: <?= ($index + 1) * 0.1 ?>s;">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold text-sm">
                                            R<?= $index + 1 ?>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-sm font-bold text-slate-900"><?= htmlspecialchars($review['reviewer_name']) ?></h3>
                                            <div class="flex items-center gap-3 mt-1">
                                                <div class="flex items-center gap-1">
                                                    <?php for($i = 0; $i < 5; $i++): ?>
                                                        <svg class="w-4 h-4 <?= $i < $review['score'] ? 'text-yellow-400' : 'text-slate-300' ?>" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="text-xs font-semibold px-2 py-1 rounded-full <?php 
                                                    switch ($review['recommendation']) {
                                                        case 'Accept': echo 'bg-green-100 text-green-800'; break;
                                                        case 'Reject': echo 'bg-red-100 text-red-800'; break;
                                                        default: echo 'bg-yellow-100 text-yellow-800';
                                                    }
                                                ?>"><?= htmlspecialchars($review['recommendation']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-l-4 border-yellow-500 bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-r-xl">
                                        <p class="text-sm text-slate-700 leading-relaxed"><?= nl2br(htmlspecialchars($review['comments'])) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="bg-gradient-to-r from-slate-50 to-indigo-50/30 px-6 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900">Upload Revised Paper</h2>
                        <p class="text-sm text-slate-600 mt-1">Address the feedback and submit your improved version</p>
                    </div>
                    
                    <form action="/paper/revise" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                        
                        <div class="p-6 sm:p-8 space-y-8">
                            <div>
                                <label for="revision_notes" class="block text-sm font-semibold text-slate-900 mb-3">Revision Notes *</label>
                                <textarea id="revision_notes" name="revision_notes" rows="8" required 
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6" 
                                    placeholder="Describe the changes you made in response to the reviewers' feedback...&#10;&#10;For example:&#10;- Addressed reviewer 1's concerns about methodology in Section 3&#10;- Added additional data analysis as suggested by reviewer 2&#10;- Clarified the conclusion based on editor's feedback"></textarea>
                                <p class="mt-3 text-sm text-slate-600 flex items-start gap-2">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Be specific about how you've addressed each reviewer's concerns. This helps expedite the review process.</span>
                                </p>
                            </div>

                            <div>
                                <label for="paper-upload" class="block text-sm font-semibold text-slate-900 mb-3">Upload Revised Paper *</label>
                                <div class="mt-2 flex justify-center rounded-2xl border-2 border-dashed border-slate-300 hover:border-indigo-400 transition-colors duration-300 px-6 py-10 bg-gradient-to-br from-slate-50 to-indigo-50/20">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <div class="flex text-sm text-slate-600 justify-center">
                                            <label for="paper-upload" class="relative cursor-pointer rounded-md font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="paper-upload" name="paper_file" type="file" class="sr-only" required accept=".pdf,.docx">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-2">PDF or DOCX up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-4 border-t border-slate-200 px-6 sm:px-8 py-6 bg-gradient-to-r from-slate-50 to-indigo-50/20">
                            <a href="/" class="text-center px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors duration-200">Cancel</a>
                            <button type="submit" class="btn-shimmer px-8 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Submit Revision</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php require __DIR__ . '/../partials/footer.php'; ?>