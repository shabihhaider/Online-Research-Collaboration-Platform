<?php
// app/views/library/index.php
require __DIR__ . '/../partials/header.php';

// Re-using helper functions for consistency
function getKeywords($keywordsStr) {
    return array_filter(array_map('trim', explode(',', $keywordsStr)));
}
function getProfilePlaceholder() {
    return '<svg class="w-full h-full text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>';
}
?>

<div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 pt-24 sm:pt-28 lg:pt-32 pb-28 sm:pb-32 lg:pb-36 text-center">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
    
    <!-- Floating Shapes -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-300/10 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>
    
    <div class="relative z-10 px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
                Research Library
            </h1>
            <p class="mt-4 text-lg sm:text-xl lg:text-2xl text-white/90 max-w-3xl mx-auto font-medium leading-relaxed px-4">
                Browse thousands of papers from leading researchers around the world
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <div class="flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                    <span class="text-sm font-semibold">Peer-Reviewed</span>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="text-sm font-semibold">High Quality</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden -mt-32 sm:-mt-36 lg:-mt-40 relative z-20 hover:shadow-indigo-200/50 transition-all duration-500">
            <div class="p-6 sm:p-8 lg:p-12">
                <?php if (empty($papers)): ?>
                    <div class="text-center py-16 sm:py-20 animate-fade-in-up">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <p class="text-xl font-semibold text-slate-700 mb-2">No Papers Yet</p>
                        <p class="text-slate-500">No papers have been published to the library yet.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        <?php foreach ($papers as $paper): ?>
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
        
        <!-- Stats Section (Optional Enhancement) -->
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1"><?= count($papers) ?></p>
                <p class="text-sm text-slate-600 font-medium">Published Papers</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1"><?= count(array_unique(array_column($papers, 'author_name'))) ?></p>
                <p class="text-sm text-slate-600 font-medium">Active Researchers</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-pink-500 to-orange-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <p class="text-3xl font-bold text-slate-900 mb-1">100%</p>
                <p class="text-sm text-slate-600 font-medium">Open Access</p>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>