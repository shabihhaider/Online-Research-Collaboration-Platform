<?php
// app/views/reviews/submit.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Paper Details</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Review the paper details and download the document. Fill out your feedback on the right.</p>
            
            <div class="mt-6 border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= htmlspecialchars($assignment['title']) ?></dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Author</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?= htmlspecialchars($assignment['author_name']) ?></dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Document</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            <a href="<?= htmlspecialchars($assignment['file_path']) ?>" target="_blank" class="font-semibold text-indigo-600 hover:text-indigo-500">Download Paper</a>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <form action="/review/submit" method="POST">
                <input type="hidden" name="assignment_id" value="<?= $assignment['assignment_id'] ?>">

                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Your Review</h2>
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8">
                        <div>
                            <label for="comments" class="block text-sm font-medium leading-6 text-gray-900">Comments</label>
                            <div class="mt-2">
                                <textarea id="comments" name="comments" rows="8" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Provide constructive feedback for the author.</p>
                        </div>
                        <div>
                             <label class="text-sm font-medium leading-6 text-gray-900">Overall Score</label>
                             <fieldset class="mt-2">
                                <legend class="sr-only">Score</legend>
                                <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <div class="flex items-center">
                                        <input id="score_<?= $i ?>" name="score" type="radio" value="<?= $i ?>" required class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="score_<?= $i ?>" class="ml-3 block text-sm font-medium leading-6 text-gray-900"><?= $i ?></label>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                             </fieldset>
                        </div>
                        <div>
                            <label for="recommendation" class="block text-sm font-medium leading-6 text-gray-900">Recommendation</label>
                            <div class="mt-2">
                                <select id="recommendation" name="recommendation" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option>Accept</option>
                                    <option>Minor Revisions</option>
                                    <option>Major Revisions</option>
                                    <option>Reject</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>