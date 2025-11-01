<?php
// app/views/profile/edit.php

// Include the header partial
require __DIR__ . '/../partials/header.php';

// Simple SVG placeholder
function getProfilePlaceholder() {
    return '<svg class="w-full h-full text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>';
}
?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0 animate-fade-in-up">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Edit Profile</h2>
            <p class="mt-3 text-base leading-relaxed text-gray-600">Update your personal information and publisher picture.</p>
            <div class="mt-4 h-1 w-20 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full"></div>
        </div>

        <div class="bg-white shadow-2xl ring-1 ring-gray-900/5 sm:rounded-2xl md:col-span-2 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
            <form action="/profile/update" method="POST" enctype="multipart/form-data">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        
                        <div class="sm:col-span-6">
                            <label class="block text-sm font-semibold leading-6 text-gray-900 mb-3">Publisher Picture</label>
                            <div class="mt-2 flex items-center gap-x-6">
                                <div class="h-24 w-24 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 overflow-hidden ring-4 ring-indigo-100 shadow-xl hover:ring-indigo-200 transition-all duration-300">
                                    <?php if (!empty($user['profile_pic'])): ?>
                                        <img src="<?= htmlspecialchars($user['profile_pic']) ?>" alt="Profile" class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <?= getProfilePlaceholder() ?>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="profile_pic" id="profile_pic" class="block w-full text-sm text-slate-600
                                    file:mr-4 file:py-2.5 file:px-5
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-bold
                                    file:bg-gradient-to-r file:from-indigo-500 file:to-purple-500 file:text-white
                                    file:shadow-md hover:file:shadow-lg file:transition-all file:duration-300
                                    hover:file:scale-105 cursor-pointer
                                "/>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Upload your picture (JPG, PNG, GIF, WEBP). Max 5MB.</p>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">Full name</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" required value="<?= htmlspecialchars($user['name']) ?>" class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-semibold leading-6 text-gray-900 mb-2">Email address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" required value="<?= htmlspecialchars($user['email']) ?>" class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 bg-gradient-to-r from-slate-50 to-indigo-50/20">
                    <a href="/" class="text-sm font-semibold leading-6 text-gray-600 hover:text-gray-900 transition-colors duration-200">Cancel</a>
                    <button type="submit" class="btn-shimmer px-6 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Save Profile</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>