

<?php $__env->startSection('content'); ?>

    <div class="flex flex-col w-full">
        <table id="myTable" class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 p-5">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                    Titre
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                    Date de création
                </th>
            </tr>
            </thead>
            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
            </tbody>
        </table>

        <a href="/admin/categories/create"
           class="inline-block px-6 py-3 mt-3 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-500 rounded shadow ripple hover:shadow-lg hover:bg-blue-600 focus:outline-none">+ Créer
            une catégorie</a>

    </div>

    <script>
        $(document).ready(function () {
            const table = $('#myTable').DataTable({
                ajax: {
                    url: '/api/v1/categories',
                    dataSrc: 'data'
                },
                columns: [
                    {data: 'id'},
                    {data: 'nom'}
                ],
                paging: false,
                searching: false,
                info: false
            });

            table.on('draw.dt', function () {
                $("#tableBody > tr").addClass("px-6 py-4 whitespace-nowrap");
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/categories/view.blade.php ENDPATH**/ ?>