<?php
// app/views/librarian/edit.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-cyan-50 via-teal-50 to-green-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(6, 182, 212, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-100 text-cyan-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                Library Management
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Edit Citation</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Add or update the official citation for this published paper. This information will be displayed in the public library.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Sidebar - Paper Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden sticky top-6 animate-fade-in-up">
                    <div class="bg-gradient-to-r from-cyan-500 to-teal-600 px-6 py-5">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Paper Information
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="bg-gradient-to-br from-cyan-50 to-teal-50 p-4 rounded-xl border border-cyan-200">
                            <dt class="text-xs font-semibold text-cyan-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                Published Paper Title
                            </dt>
                            <dd class="text-base font-bold text-slate-900 leading-relaxed"><?= htmlspecialchars($entry['title']) ?></dd>
                        </div>
                        
                        <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div>
                                    <p class="text-sm font-semibold text-blue-900 mb-1">Citation Guidelines</p>
                                    <p class="text-xs text-blue-700 leading-relaxed">Provide the full citation in your preferred format (APA, MLA, Chicago, etc.). This will help researchers properly reference this work.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Main Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-r from-slate-50 to-teal-50/30 px-6 sm:px-8 py-6 border-b border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Citation Details</h2>
                        <p class="text-sm text-slate-600">Enter the official citation for this published work</p>
                    </div>
                    
                    <form action="/library/edit" method="POST">
                        <input type="hidden" name="library_id" value="<?= $entry['library_id'] ?>">
                        
                        <div class="p-6 sm:p-8 space-y-8">
                            
                            <!-- Read-only Title Field -->
                            <div>
                                <label for="title" class="block text-sm font-semibold text-slate-900 mb-3">Paper Title (Read-only)</label>
                                <input type="text" name="title" id="title" value="<?= htmlspecialchars($entry['title']) ?>" readonly 
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-slate-500 bg-slate-100 shadow-sm ring-1 ring-inset ring-slate-300 sm:text-sm sm:leading-6 cursor-not-allowed">
                            </div>

                            <!-- Citation Textarea -->
                            <div>
                                <label for="citation" class="block text-sm font-semibold text-slate-900 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                    Official Citation *
                                </label>
                                <textarea id="citation" name="citation" rows="8" required 
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6 font-mono" 
                                    placeholder="Example (APA):&#10;Author, A. A. (Year). Title of the paper. Journal Name, Volume(Issue), page-page. https://doi.org/xxxxx&#10;&#10;Example (MLA):&#10;Author. &quot;Title of the Paper.&quot; Journal Name, vol. X, no. Y, Year, pp. page-page."><?= htmlspecialchars($entry['citation'] ?? '') ?></textarea>
                                <p class="mt-3 text-sm text-slate-600 flex items-start gap-2">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Use standard citation format (APA, MLA, Chicago, etc.). This will be displayed publicly in the library.</span>
                                </p>
                            </div>

                            <!-- Format Examples -->
                            <div class="bg-gradient-to-br from-slate-50 to-cyan-50 p-6 rounded-2xl border border-slate-200">
                                <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Citation Format Examples
                                </h3>
                                <div class="space-y-3 text-xs">
                                    <div class="bg-white p-3 rounded-lg border border-slate-200">
                                        <p class="font-semibold text-cyan-700 mb-1">APA Format:</p>
                                        <p class="text-slate-600 font-mono leading-relaxed">Smith, J., & Johnson, A. (2024). Advanced machine learning techniques. Journal of AI Research, 15(3), 234-256.</p>
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-slate-200">
                                        <p class="font-semibold text-cyan-700 mb-1">MLA Format:</p>
                                        <p class="text-slate-600 font-mono leading-relaxed">Smith, John, and Alice Johnson. "Advanced Machine Learning Techniques." Journal of AI Research, vol. 15, no. 3, 2024, pp. 234-256.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-4 border-t border-slate-200 px-6 sm:px-8 py-6 bg-gradient-to-r from-slate-50 to-teal-50/20">
                            <a href="/" class="text-center px-6 py-3 text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors duration-200">Cancel</a>
                            <button type="submit" class="btn-shimmer px-8 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Save Citation</span>
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