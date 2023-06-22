

<?php $__env->startSection('content'); ?>
    <section class="flex flex-col w-full">
        <h1 class="text-3xl font-semibold mb-5">Créer un article</h1>
        <form method="POST" action="/admin/articles/create"
              class="p-6 mx-auto max-w-2xl bg-white rounded shadow-md min-w-full">
            <div class="mb-4">
                <label for="category" class="block mb-1 font-bold text-gray-700">Category</label>
                <select class="w-full px-3 py-2 text-gray-700 bg-gray-200 rounded" id="category" name="category">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->nom); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/articles/create.blade.php ENDPATH**/ ?>