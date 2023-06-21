@extends('layout')

@section('content')
    <section class="flex flex-col w-full">
        <h1 class="text-3xl font-semibold mb-5">Créer une catégorie</h1>
        <form method="POST" action="/admin/categories/create"
              class="p-6 mx-auto max-w-2xl bg-white rounded shadow-md min-w-full">
            <div class="mb-4">
                <label for="nom" class="block mb-1 font-bold text-gray-700">Nom</label>
                <textarea class="w-full h-24 px-3 py-2 text-gray-700 bg-gray-200 rounded" id="nom"
                          name="nom"></textarea>
            </div>
            <button type="submit" class="w-full px-3 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600 rounded">
                Submit
            </button>
        </form>
    </section>
@endsection
