<?php
// app/views/papers/submit.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0 animate-fade-in-up">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Submit Your Paper</h2>
            <p class="mt-3 text-base leading-relaxed text-gray-600">Please fill out all the details for your research paper and upload the document.</p>
            <div class="mt-4 h-1 w-20 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full"></div>
        </div>

        <div class="bg-white shadow-2xl ring-1 ring-gray-900/5 sm:rounded-2xl md:col-span-2 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
            <form action="/submit" method="POST" enctype="multipart/form-data">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Paper Title</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" required class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="abstract" class="block text-sm font-medium leading-6 text-gray-900">Abstract</label>
                            <div class="mt-2">
                                <textarea id="abstract" name="abstract" rows="6" required class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6"></textarea>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Write a brief summary of your paper.</p>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                            <div class="mt-2">
                                <select id="category" name="category_id" required class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6">
                                    <option value="" disabled selected>Select a category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Select the main category your research falls under.</p>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="keywords" class="block text-sm font-medium leading-6 text-gray-900">Keywords</label>
                            <div class="mt-2">
                                <input type="text" name="keywords" id="keywords" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Enter comma-separated keywords (e.g., AI, Web, Research).</p>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="paper-upload" class="block text-sm font-medium leading-6 text-gray-900">Upload Paper</label>
                            <div class="mt-2">
                                <input type="file" name="paper_file" id="paper-upload" required class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 focus:ring-2 focus:ring-inset focus:ring-indigo-600 focus:shadow-lg transition-all duration-300 sm:text-sm">
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Please upload your paper in PDF or DOCX format.</p>
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 bg-gradient-to-r from-slate-50 to-indigo-50/20">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-600 hover:text-gray-900 transition-colors duration-200">Cancel</button>
                    <button type="submit" class="btn-shimmer px-6 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                        <span>Submit Paper</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
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