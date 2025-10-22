<?php
// app/views/pages/home.php

// Include the header partial
require __DIR__ . '/../partials/header.php';
?>

<div class="p-4 bg-white border rounded-lg shadow-sm">

    <?php if (isset($_SESSION['user'])): ?>
        <?php $roleId = $_SESSION['user']['role_id']; ?>

        <?php if ($roleId == 1): // --- 1. RESEARCHER DASHBOARD --- ?>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">My Submissions</h2>
                <a href="/submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Submit New Paper</a>
            </div>
            <?php if (empty($data['papers'])): ?>
                <p class="text-gray-700">You have not submitted any papers yet.</p>
            <?php else: ?>
                 <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted On</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['papers'] as $paper): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($paper['title']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php 
                                                switch ($paper['status']) {
                                                    case 'Submitted': echo 'bg-blue-100 text-blue-800'; break;
                                                    case 'Under Review': echo 'bg-yellow-100 text-yellow-800'; break;
                                                    case 'Revision Requested': echo 'bg-orange-100 text-orange-800'; break;
                                                    case 'Accepted': echo 'bg-green-100 text-green-800'; break;
                                                    case 'Rejected': echo 'bg-red-100 text-red-800'; break;
                                                    default: echo 'bg-gray-100 text-gray-800';
                                                }
                                            ?>
                                        ">
                                            <?= htmlspecialchars($paper['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($paper['submitted_at'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <?php if ($paper['status'] === 'Revision Requested'): ?>
                                            <a href="/paper/revise/<?= $paper['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Submit Revision</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        <?php elseif ($roleId == 2): // --- 2. REVIEWER DASHBOARD --- ?>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Papers Assigned for Your Review</h2>
            <?php if (empty($data['assignments'])): ?>
                <p class="text-gray-700">You have no pending assignments at this time.</p>
            <?php else: ?>
                 <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['assignments'] as $assignment): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($assignment['title']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500"><?= htmlspecialchars($assignment['author_name']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending Your Review</span></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"><a href="/review/submit/<?= $assignment['assignment_id'] ?>" class="text-indigo-600 hover:text-indigo-900">Submit Review</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        <?php elseif ($roleId == 3): // --- 3. EDITOR DASHBOARD --- ?>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">New Submissions Awaiting Review</h2>
            <?php if (empty($data['submitted_papers'])): ?>
                <p class="text-gray-700">There are no new submissions at this time.</p>
            <?php else: ?>
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted On</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['submitted_papers'] as $paper): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($paper['title']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500"><?= htmlspecialchars($paper['author_name']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($paper['submitted_at'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/editor/assign/<?= $paper['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Assign Reviewers</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <hr class="my-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Papers Awaiting Final Decision</h2>
            <?php if (empty($data['decision_papers'])): ?>
                <p class="text-gray-700">There are no papers awaiting a final decision at this time.</p>
            <?php else: ?>
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['decision_papers'] as $paper): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($paper['title']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500"><?= htmlspecialchars($paper['author_name']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/editor/decision/<?= $paper['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Make Decision</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        <?php elseif ($roleId == 4): // --- 4. LIBRARIAN DASHBOARD --- ?>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Library Management</h2>
            <p class="text-gray-700 mb-4">The following papers have been accepted and published. You can add or edit citations as needed.</p>
            <?php if (empty($data['published_papers'])): ?>
                <p class="text-gray-700">There are no published papers in the library yet.</p>
            <?php else: ?>
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published On</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($data['published_papers'] as $paper): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($paper['title']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500"><?= htmlspecialchars($paper['author_name']) ?></div></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($paper['published_at'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/library/edit/<?= $paper['library_id'] ?>" class="text-indigo-600 hover:text-indigo-900">Add/Edit Citation</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        <?php elseif ($roleId == 5): // --- 5. ADMIN DASHBOARD --- ?>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Admin Dashboard</h2>
            <p class="text-gray-700">From here you can manage all system settings.</p>
            <div class="mt-4">
                <a href="/admin/users" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Manage User Registrations</a>
            </div>

        <?php else: ?>
            <p class="text-gray-700">Welcome to your dashboard.</p>
        <?php endif; ?>

    <?php else: // --- GUEST HOMEPAGE --- ?>
        <p class="text-gray-700">Welcome to the Online Research Collaboration Platform.</p>
    <?php endif; ?>

</div>

<?php
// Include the footer partial
require __DIR__ . '/../partials/footer.php';
?>