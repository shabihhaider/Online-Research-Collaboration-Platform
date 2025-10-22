<?php
// app/views/auth/register.php

require __DIR__ . '/../partials/header.php';
?>

<div class="flex min-h-full flex-col items-center justify-center px-6">
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white border border-slate-200 rounded-xl shadow-lg p-8 md:p-10">
            <div class="flex flex-col items-center text-center">
                <a href="/" class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </a>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">Create a new account</h2>
            </div>

            <form class="mt-8 space-y-6" action="/register" method="POST">
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-slate-700">Full name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required class="block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-slate-700">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-slate-700">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-slate-700">Confirm Password</label>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <input type="hidden" name="role_id" value="1">

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create account</button>
                </div>
            </form>
        </div>

        <p class="text-center text-sm text-slate-500">
            Already a member?
            <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign in</a>
        </p>
    </div>
</div>

<?php
require __DIR__ . '/../partials/footer.php';
?>