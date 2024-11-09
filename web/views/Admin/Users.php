<?php
$templates = new Templates();

$templates->documentHead("Users");
?>

<body>
    <?php
    $templates->inProdHeader("Users");
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
                        <dt class="text-sm font-medium text-gray-600">Всего сотрудников</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 candidates-total">0</dd>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">Всего визиток сотрудников</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 cards-total">0</dd>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-900/5">
                    <div class="px-4 py-4 sm:px-6 flex justify-between items-center border-b border-gray-200">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Список пользователей</h2>
                        <button onclick="addUser()"
                            class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            Добавить пользователя
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">ID</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Логин</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Имя</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Телеграм</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Группа</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Количество визиток</th>
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
    </main>
    <?php
    $templates->inProdFooter();
    $templates->documentJavascript("Users");
    ?>
</body>

</html>