<?php
// app/views/librarian/edit.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Citation</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Add or update the official citation for the published paper. This will be displayed in the public library.</p>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <form action="/library/edit" method="POST">
                <input type="hidden" name="library_id" value="<?= $entry['library_id'] ?>">

                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8">
                        <div>
                            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Paper Title</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" value="<?= htmlspecialchars($entry['title']) ?>" readonly class="block w-full rounded-md border-0 py-1.5 text-gray-500 bg-gray-50 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div>
                            <label for="citation" class="block text-sm font-medium leading-6 text-gray-900">Citation</label>
                            <div class="mt-2">
                                <textarea id="citation" name="citation" rows="6" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= htmlspecialchars($entry['citation'] ?? '') ?></textarea>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Enter the full citation (e.g., APA, MLA format).</p>
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save Citation</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>