<?php
$templates = new Templates();

$templates->documentHead("Find Candidate");
?>

<body>
    <?php
    $templates->inProdHeader("Find Candidate");
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

                <div class="bg-rose-50 p-4 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-rose-800">Описание данной страницы:</h3>
                            <p class="mt-2 text-sm text-rose-700">Здесь вы можете добавить профессии, по которым потом будете искать кандидата или команду, а так же внести изменения уже в существующий сет. Вводить значения можно от 0.0 до 1.0 <span class="font-semibold">(float)</span>. Система автоматически даст сигнал, если вы вводите неверные значения, либо их сумма больше единицы.</p>
                            <p class="mt-2 text-sm text-rose-700">Снизу страницы вы можете найти кандидата на должность, либо составить команду. Поиск в первом случае будет среди всех визиток кандадата и выбор упадет на лучшую, а во втором среди всех уникальных визиток, а так же включен алгоритм, что в команде не может один человек заниматься несколько должностей. Во всех случаях достаточно выбрать профессии и нажмать на кнопку.</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">Всего сотрудников</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 candidates-total">0</dd>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">Всего визиток</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 cards-total">0</dd>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-900/5 mb-8">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Управление профессиями</h3>
                        <button type="button" onclick="addProfession()" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                            <svg class="sm:-ml-0.5 sm:mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            <span class="sm:block hidden">Добавить профессию</span>
                        </button>
                    </div>
                    <div class="overflow-x-auto max-h-[400px]">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">Название</th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">O</th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">C</th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">E</th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">A</th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">N</th>
                                    <th class="relative py-3.5 pl-3 pr-6">
                                        <span class="sr-only">Действия</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 professions-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-900/5 p-6">
                        <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">Поиск кандидатов на должность</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="single-position" class="block text-sm font-medium text-gray-700">Выберите профессию</label>
                                <select id="single-position" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 outline-none mt-1">
                                    <option value="">Выберите профессию</option>
                                </select>
                            </div>
                            <button type="button" onclick="findCandidates()" class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Найти кандидатов
                            </button>
                        </div>
                        <div class="mt-6 candidates-list hidden">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Результаты поиска:</h4>
                            <div class="space-y-2 candidates-results"></div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-900/5 p-6">
                        <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">Формирование команды</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="team-positions" class="block text-sm font-medium text-gray-700">Выберите необходимые профессии</label>
                                <select id="team-positions" multiple class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 outline-none mt-1">
                                </select>
                            </div>
                            <button type="button" onclick="findTeam()" class="w-full inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Сформировать команду
                            </button>
                        </div>
                        <div class="mt-6 team-list hidden">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Предлагаемая команда:</h4>
                            <div class="space-y-2 team-results"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    $templates->inProdFooter();
    $templates->documentJavascript("Find Candidate");
    ?>
</body>

</html>