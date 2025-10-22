<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Reviewer Feedback</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Review the feedback below and submit your revised paper.</p>
            
            <div class="mt-6 space-y-4">
                <?php foreach ($reviews as $review): ?>
                    <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded-r-lg">
                        <p class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($review['reviewer_name']) ?></p>
                        <p class="text-sm text-gray-600 mt-2"><strong>Score:</strong> <?= $review['score'] ?>/5</p>
                        <p class="text-sm text-gray-600"><strong>Recommendation:</strong> <?= htmlspecialchars($review['recommendation']) ?></p>
                        <blockquote class="mt-2 border-l-4 border-gray-300 pl-4 italic text-gray-800 text-sm">
                            <?= nl2br(htmlspecialchars($review['comments'])) ?>
                        </blockquote>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <form action="/paper/revise" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="paper_id" value="<?= $paper['id'] ?>">
                <div class="px-4 py-6 sm:p-8">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Submit Revised Paper</h2>
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8">
                        <div>
                            <label for="revision_notes" class="block text-sm font-medium leading-6 text-gray-900">Revision Notes</label>
                            <div class="mt-2">
                                <textarea id="revision_notes" name="revision_notes" rows="6" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Describe the changes you made in response to the reviewers' feedback..."></textarea>
                            </div>
                        </div>

                        <div>
                            <label for="paper-upload" class="block text-sm font-medium leading-6 text-gray-900">Upload Revised Paper</label>
                            <div class="mt-2">
                                <input type="file" name="paper_file" id="paper-upload" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Upload your revised paper (PDF or DOCX)</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Submit Revision</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>