<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel d'administration</title>
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">

    <script src="//code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
<main class="flex h-screen">
    <section class="bg-white w-1/5 border-r border-gray-200 p-5 flex flex-col">
        <div class="mb-8 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 7.585V5z" clip-rule="evenodd" />
            </svg>
            <h1 class="text-2xl font-semibold text-gray-700">Admin Panel</h1>
        </div>
        <ul class="space-y-2 mb-8">
            <li><a href="/admin/articles" class="text-gray-700 hover:text-blue-500 transition duration-150 ease-in-out block">Articles</a></li>
            <li><a href="/admin/categories" class="text-gray-700 hover:text-blue-500 transition duration-150 ease-in-out block">Catégories</a></li>
        </ul>
        <div class="mt-auto">
            @if($authService->check())
                <p class="mb-4 text-sm text-gray-700">Connecté en tant que {{ $authService->user()->email }}</p>
                <a href="/admin/auth/signout" class="block text-center bg-red-500 hover:bg-red-600 text-white rounded py-2 transition duration-150 ease-in-out">Logout</a>
            @else
                <a href="/admin/auth/signin" class="block text-center bg-blue-500 hover:bg-blue-600 text-white rounded py-2 transition duration-150 ease-in-out">Login</a>
                <a href="/admin/auth/signup" class="block text-center bg-green-500 hover:bg-green-600 text-white rounded py-2 mt-2 transition duration-150 ease-in-out">Register</a>
            @endif
        </div>
    </section>
    <section class="flex-grow bg-gray-100 p-5">
        @yield('content')
    </section>
</main>

<script src="https://cdn.tailwindcss.com"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>
