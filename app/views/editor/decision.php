<?php
// app/views/editor/decision.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Paper Details</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Review the paper details and the submitted feedback to make a final decision.</p>

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
                        <dt class="text-sm font-medium leading-6 text-gray-900">Document</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            <a href="<?= htmlspecialchars($paper['file_path']) ?>" target="_blank" class="font-semibold text-indigo-600 hover:text-indigo-500">Download Paper</a>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Submitted Reviews</h2>
                <div class="space-y-6">
                    <?php if (empty($reviews)): ?>
                        <p class="text-sm text-gray-600">No reviews have been submitted for this paper yet.</p>
                    <?php else: ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="border-l-4 p-4 rounded-r-lg 
                                <?php 
                                    switch ($review['recommendation']) {
                                        case 'Accept': echo 'border-green-500 bg-green-50'; break;
                                        case 'Reject': echo 'border-red-500 bg-red-50'; break;
                                        default: echo 'border-yellow-500 bg-yellow-50';
                                    }
                                ?>
                            ">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-semibold text-gray-900">Review by <?= htmlspecialchars($review['reviewer_name']) ?></p>
                                    <p class="text-sm font-medium text-gray-700">Score: <span class="font-bold"><?= htmlspecialchars($review['score']) ?> / 5</span></p>
                                </div>
                                <p class="mt-2 text-sm text-gray-600"><strong>Recommendation:</strong> <?= htmlspecialchars($review['recommendation']) ?></p>
                                <blockquote class="mt-4 border-l-4 border-gray-300 pl-4 italic text-gray-800">
                                    <?= nl2br(htmlspecialchars($review['comments'])) ?>
                                </blockquote>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <form action="/editor/decision" method="POST">
                <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" name="decision" value="Rejected" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">Reject</button>
                    <button type="submit" name="decision" value="Revision Requested" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Request Revisions</button>
                    <button type="submit" name="decision" value="Accepted" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500">Accept</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>