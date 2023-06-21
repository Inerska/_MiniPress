@extends('layout')

@section('content')
    <section class="flex flex-col w-full">
        <h1 class="text-3xl font-semibold mb-5">Créer un article</h1>
        <form method="POST" action="/admin/articles"
              class="p-6 mx-auto max-w-2xl bg-white rounded shadow-md min-w-full">
            <div class="mb-4">
                <label for="title" class="block mb-1 font-bold text-gray-700">Title</label>
                <input type="text" class="w-full px-3 py-2 text-gray-700 bg-gray-200 rounded" id="title" name="title">
            </div>
            <div class="mb-4">
                <label for="summary" class="block mb-1 font-bold text-gray-700">Summary</label>
                <textarea class="w-full h-24 px-3 py-2 text-gray-700 bg-gray-200 rounded" id="summary"
                          name="summary"></textarea>
            </div>
            <div class="mb-6">
                <label for="content" class="block mb-1 font-bold text-gray-700">Content</label>
                <textarea class="w-full h-48 px-3 py-2 text-gray-700 bg-gray-200 rounded" id="content"
                          name="content"></textarea>
            </div>
            <button type="submit" class="w-full px-3 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600 rounded">
                Submit
            </button>
        </form>
    </section>
@endsection
