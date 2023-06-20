<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>

    <script src="//code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
<main class="flex justify-between h-screen">
    <section class="w-1/5 border-r border-gray-200 p-2">
        <a href="#" class="flex text-gray-700 fill-gray-700 hover:text-gray-900 hover:fill-gray-900">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M7.71689 5.72315C6.71581 6.18996 6.2827 7.37992 6.74951 8.381C7.21632 9.38208 8.40628 9.81519 9.40736 9.34838L20.2831 4.27696C21.2841 3.81015 21.7172 2.62019 21.2504 1.61911C20.7836 0.618028 19.5937 0.184918 18.5926 0.651729L7.71689 5.72315Z"
                        fill="currentColor"/>
                <path
                        d="M4.74951 15.381C4.2827 14.3799 4.71581 13.19 5.71689 12.7231L16.5926 7.65173C17.5937 7.18492 18.7836 7.61803 19.2504 8.61911C19.7172 9.62019 19.2841 10.8101 18.2831 11.277L7.40736 16.3484C6.40628 16.8152 5.21632 16.3821 4.74951 15.381Z"
                        fill="currentColor"/>
                <path
                        d="M2.74951 22.381C2.2827 21.3799 2.71581 20.19 3.71689 19.7231L14.5926 14.6517C15.5937 14.1849 16.7836 14.618 17.2504 15.6191C17.7172 16.6202 17.2841 17.8101 16.2831 18.277L5.40736 23.3484C4.40628 23.8152 3.21632 23.3821 2.74951 22.381Z"
                        fill="currentColor"/>
            </svg>
            <h1 class="text-xl text-gray-700 font-bold">Admin</h1>
        </a>
        <ul class="font-semibold text-gray-700 mt-4 hover:text-gray-900 transition duration-150 h-full flex justify-between flex-col">
            <div>
                <li><a href="/admin/articles">Articles</a></li>
            </div>
            <div>
                <li><a href="/admin/auth/signin">Login</a></li>
                <li><a href="/admin/auth/signup">Register</a></li>
                <li><a href="/admin/auth/signout">Logout</a></li>
            </div>
        </ul>
    </section>
    <section class="pl-5 pt-2 w-4/5 flex items-center justify-center">
        @yield('content')
    </section>
</main>

<script src="https://cdn.tailwindcss.com"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>
