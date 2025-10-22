<?php
// app/views/editor/assign.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Paper Details</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Assign at least two reviewers to the following paper.</p>
            
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= htmlspecialchars($paper['title']) ?></dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Author</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= htmlspecialchars($paper['author_name']) ?></dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Abstract</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= htmlspecialchars($paper['abstract']) ?></dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <form action="/editor/assign" method="POST">
                <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">

                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Select Reviewers</h2>
                    <?php if (empty($reviewers)): ?>
                        <p class="text-sm text-gray-600">No available reviewers found in the system. Please add users with the 'Reviewer' role first.</p>
                    <?php else: ?>
                        <fieldset class="space-y-5">
                            <legend class="sr-only">Reviewers</legend>
                            <?php foreach ($reviewers as $reviewer): ?>
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input id="reviewer_<?= $reviewer['id'] ?>" name="reviewer_ids[]" type="checkbox" value="<?= $reviewer['id'] ?>" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="reviewer_<?= $reviewer['id'] ?>" class="font-medium text-gray-900"><?= htmlspecialchars($reviewer['name']) ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </fieldset>
                    <?php endif; ?>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Assign Selected Reviewers</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>