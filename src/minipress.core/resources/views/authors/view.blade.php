@extends('layout')

@section('content')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #loading {
            display: none;
            background: rgba(255, 255, 255, 0.8);
        }
    </style>

    <div class="flex flex-col w-full p-6 space-y-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-bold">Auteurs</h1>

            <a href="/admin/auteurs/create"
               class="inline-block px-6 py-2 text-xs font-medium text-center text-white uppercase transition bg-blue-500 rounded-md shadow ripple hover:shadow-lg hover:bg-blue-600 focus:outline-none {{ !$authService->isAdminAccount() ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ !$authService->isAdminAccount() ? 'onclick=event.preventDefault()' : '' }}>
                + Créer un auteur
            </a>
        </div>

        <div class="relative">
            <table id="authorsTable" class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Id
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nom
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
            <div id="loading" class="absolute inset-0 flex items-center justify-center">
                <div class="loader"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            const table = $('#authorsTable').DataTable({
                ajax: {
                    url: '/api/v1/auteurs',
                    dataSrc: 'data',
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                },
                columns: [
                    {data: 'id'},
                    {data: 'nom'},
                    {data: 'email'},
                ],
                paging: false,
                searching: false,
                info: false,
            });

            table.on('draw.dt', function () {
                $("#tableBody > tr").addClass("px-6 py-4 whitespace-nowrap");
            });
        });
    </script>
@endsection
