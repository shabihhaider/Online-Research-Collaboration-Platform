<?php
// app/views/admin/categories.php
require __DIR__ . '/../partials/header.php';
?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50 pt-8 pb-12 overflow-hidden">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(245, 158, 11, 0.1) 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Category Management
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-4">Research Categories</h1>
            <p class="text-lg text-slate-600 max-w-3xl">Organize research papers by creating and managing category classifications.</p>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-slate-50 to-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Add New Category Card -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden animate-fade-in-up">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-amber-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Add New Category</h2>
                </div>
            </div>
            <form action="/admin/categories/add" method="POST">
                <div class="p-6 sm:p-8 space-y-6">
                    <div>
                        <label for="category_name" class="block text-sm font-semibold text-slate-900 mb-3">Category Name *</label>
                        <input type="text" name="category_name" id="category_name" required 
                            class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6"
                            placeholder="e.g., Artificial Intelligence, Machine Learning">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-900 mb-3">Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-amber-600 focus:shadow-lg transition-all duration-300 sm:text-sm sm:leading-6" 
                            placeholder="A brief description of the category and what research topics it covers..."></textarea>
                        <p class="mt-2 text-sm text-slate-600">Optional: Provide a helpful description for researchers.</p>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-4 border-t border-slate-200 px-6 sm:px-8 py-4 bg-gradient-to-r from-slate-50 to-amber-50/20">
                    <button type="submit" class="btn-shimmer px-6 py-3 text-sm font-bold text-white rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Category
                    </button>
                </div>
            </form>
        </div>

        <!-- Existing Categories Table -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-yellow-50/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-500 to-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Existing Categories</h2>
                        <p class="text-sm text-slate-600">Total: <?= count($categories) ?> categories</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-gradient-to-r from-slate-100 to-yellow-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            <?php foreach ($categories as $index => $category): ?>
                                <tr class="hover:bg-yellow-50/30 transition-colors duration-200 animate-fade-in-up" style="animation-delay: <?= $index * 0.05 ?>s;">
                                    <td class="px-6 py-4">
                                        <form action="/admin/categories/edit" method="POST" class="flex items-center gap-3">
                                            <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                            </div>
                                            <input type="text" name="category_name" value="<?= htmlspecialchars($category['name']) ?>" 
                                                class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm transition-all duration-300">
                                    </td>
                                    <td class="px-6 py-4">
                                            <input type="text" name="description" value="<?= htmlspecialchars($category['description']) ?>" 
                                                class="block w-full rounded-lg border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-amber-600 sm:text-sm transition-all duration-300"
                                                placeholder="Add a description...">
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-3">
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                Update
                                            </button>
                                        </form>
                                            <form action="/admin/categories/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" style="display:inline;">
                                                <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>