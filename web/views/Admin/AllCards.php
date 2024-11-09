<?php
$templates = new Templates();

$templates->documentHead("All Cards");
?>

<body>
    <?php
    $templates->inProdHeader("All Cards");
    ?>
    <main>
        <div class="relative isolate overflow-hidden bg-white">
            <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
                <defs>
                    <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 .5H40M.5 0V40" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)" />
            </svg>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">Всего визиток</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 cards-total">0</dd>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">За последний месяц</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 cards-month">0</dd>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-900/5">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">ID</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Название</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Пользователь</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Метрики</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Тип личности</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Дата создания</th>
                                        <th class="relative py-3.5 pl-3 pr-6">
                                            <span class="sr-only">Действия</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 cards-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <button class="pagination-prev relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Назад
                            </button>
                            <button class="pagination-next relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Вперед
                            </button>
                        </div>
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Показано <span class="font-medium pagination-start">1</span> -
                                    <span class="font-medium pagination-end">20</span> из
                                    <span class="font-medium pagination-total">100</span> результатов
                                </p>
                            </div>
                            <div class="pagination-buttons inline-flex gap-x-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-modal fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <div class="relative w-full max-w-3xl overflow-hidden rounded-lg bg-white shadow-xl">
                        <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                            <button type="button" class="close-video-modal rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                                <span class="sr-only">Close</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 video-modal-title mb-4"></h3>
                            <div class="aspect-video">
                                <video id="previewVideo" class="w-full h-full" controls>
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    $templates->inProdFooter();
    $templates->documentJavascript("All Cards");
    ?>
</body>

</html>