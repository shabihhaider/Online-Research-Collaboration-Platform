<?php
// app/views/library/view.php
require __DIR__ . '/../partials/header.php';

// Re-using placeholder function
function getProfilePlaceholder() {
    return '<svg class="w-full h-full text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>';
}
?>

<!-- Hero Section with Gradient Background -->
<div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] bg-top" style="background-size: 30px 30px;"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="/" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-white/80 backdrop-blur-sm rounded-full shadow-md hover:shadow-xl hover:bg-white hover:-translate-x-1 transition-all duration-300 group border border-indigo-100">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span>Back</span>
                </a>
            </div>
            
           <!-- Title -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                <?= htmlspecialchars($paper['title']) ?>
            </h1>

            <!-- Author Info Card -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 p-5 bg-white/90 backdrop-blur-sm rounded-2xl border border-slate-200 shadow-lg hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="flex items-center gap-4 flex-1">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 ring-4 ring-white shadow-xl flex-shrink-0">
                        <?php if (!empty($paper['profile_pic'])): ?>
                            <img src="<?= htmlspecialchars($paper['profile_pic']) ?>" alt="<?= htmlspecialchars($paper['author_name']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <?= getProfilePlaceholder() ?>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-base sm:text-lg font-bold text-slate-900 truncate"><?= htmlspecialchars($paper['author_name']) ?></p>
                        <p class="text-xs sm:text-sm text-slate-600 flex items-center gap-1.5 mt-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Published on <?= date('M d, Y', strtotime($paper['published_at'])) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<div class="bg-white py-12 lg:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl p-6 sm:p-8 lg:p-12 animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="prose prose-indigo prose-lg max-w-none">
                
                <div class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4 pb-3 border-b-2 border-indigo-200">Abstract</h2>
                    <p class="text-slate-700 leading-relaxed text-base sm:text-lg"><?= nl2br(htmlspecialchars($paper['abstract'])) ?></p>
                </div>

                <div class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4 pb-3 border-b-2 border-indigo-200">Keywords</h2>
                <div class="flex flex-wrap gap-3 not-prose">
                        <?php foreach ($paper['keywords_array'] as $keyword): ?>
                            <span class="px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 rounded-full text-sm font-semibold shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 border border-indigo-200">
                                <?= htmlspecialchars($keyword) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($paper['citation'])): ?>
                <div class="mb-10">
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-4 pb-3 border-b-2 border-indigo-200">Citation</h2>
                    <blockquote class="not-prose border-l-4 border-indigo-500 bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-r-2xl shadow-md">
                        <svg class="w-8 h-8 text-indigo-300 mb-3" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <p class="text-base sm:text-lg italic text-indigo-900 font-medium leading-relaxed"><?= nl2br(htmlspecialchars($paper['citation'])) ?></p>
                    </blockquote>
                </div>
                <?php endif; ?>
                
                <div class="mb-0">
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 pb-3 border-b-2 border-indigo-200">Download</h2>
                    <div class="not-prose">
                        <a href="<?= htmlspecialchars($paper['file_path']) ?>" download class="btn-shimmer no-underline inline-flex items-center justify-center gap-3 px-8 py-4 text-white font-bold rounded-2xl shadow-2xl hover:shadow-indigo-500/50 transform hover:scale-105 transition-all duration-300 w-full sm:w-auto text-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span>Download Paper (PDF/DOCX)</span>
                        </a>
                        <p class="text-sm text-slate-500 mt-4 text-center sm:text-left">Click to download the full research paper</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
        </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>