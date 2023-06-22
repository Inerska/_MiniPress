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
            <h1 class="text-lg font-bold">Articles</h1>
            <a href="/admin/articles/create"
               class="inline-block px-6 py-2 text-xs font-medium text-center text-white uppercase transition bg-blue-500 rounded-md shadow ripple hover:shadow-lg hover:bg-blue-600 focus:outline-none {{ !$authService->check() ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ !$authService->check() ? 'onclick=event.preventDefault()' : '' }}>
                + Créer un article
            </a>
        </div>

        <div>
            <label for="categoryFilter" class="block text-sm font-medium text-gray-700">Filtrer par catégorie</label>
            <select id="categoryFilter" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option selected value="">Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="relative">
            <table id="myTable" class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Titre
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date de création
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
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
            const table = $('#myTable').DataTable({
                ajax: {
                    url: '/api/v1/articles?display=all',
                    dataSrc: 'data',
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                },
                columns: [
                    {data: 'titre'},
                    {data: 'date_creation'},
                    {
                        data: null,
                        render: function (data, type, row) {
                            const id = row.url.split('/')[2];
                            if (row.published) {
                                return `<button class="unpublish-button bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" data-id="${id}">Unpublish</button>`;
                            } else {
                                return `<button class="publish-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-id="${id}">Publish</button>`;
                            }
                        }
                    },
                ],
                paging: false,
                searching: false,
                info: false,
            });

            $('#myTable').on('click', '.publish-button', function () {
                const id = $(this).data('id');
                $.ajax({
                    url: `/api/v1/articles/${id}/publish`,
                    type: 'PUT',
                    success: function () {
                        table.ajax.reload();
                    }
                });
            });

            $('#myTable').on('click', '.unpublish-button', function () {
                const id = $(this).data('id');
                $.ajax({
                    url: `/api/v1/articles/${id}/unpublish`,
                    type: 'PUT',
                    success: function () {
                        table.ajax.reload();
                    }
                });
            });

            $('#categoryFilter').on('change', function() {
                let selectedCategory = $(this).val();
                if (selectedCategory) {
                    table.ajax.url('/api/v1/categories/' + selectedCategory + '/articles').load();
                } else {
                    table.ajax.url('/api/v1/articles').load();
                }
            });

            table.on('draw.dt', function () {
                $("#tableBody > tr").addClass("px-6 py-4 whitespace-nowrap");
            });
        });
    </script>
@endsection
