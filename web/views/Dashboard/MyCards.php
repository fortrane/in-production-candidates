<?php
$templates = new Templates();

$templates->documentHead("My Cards");
?>

<body>
    <?php
    $templates->inProdHeader("My Cards");
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
                <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5 mb-8">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 mb-4">Загрузка визитки</h2>

                    <div class="bg-rose-50 p-4 rounded-lg mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-rose-800">Важная информация по эксплуатации:</h3>
                                <p class="mt-2 text-sm text-rose-700">Демо-версия запущена на CPU, поэтому скорость работы в десятки раз ниже, чем на реальном стенде. Метрика представлена в <span class="font-semibold">human-readable</span> виде, сам скрипт работает со значениями, которые могут быть от 0.0 до 1.0. Мы обучали модель и на стенде используется неполная, потому что требуется больше эпох и времени, а в частности мощности. <span class="font-semibold">Описание работы с этой страницей:</span></p>
                                <div class="mt-2 text-sm text-rose-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li>Напишите название для видео;</li>
                                        <li>Загрузите видео-визитку;</li>
                                        <li>Нажмите на кнопку "Отправить видео";</li>
                                        <li>Подождите какое то время, пока скрипт обработает его;</li>
                                        <li>Снизу в таблице вы получите OCEAN метрику, тип личности (можно навести мышку и посмотреть описание), а так же посмотреть визитку, подобрать по зеленой кнопке профессию и удалить данное видео из системы.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Требования к видео:</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li>Формат файла: MP4</li>
                                        <li>Максимальный размер: 15 МБ</li>
                                        <li>Рекомендуемая длительность: 10-15 секунд</li>
                                        <li>Говорите четко и смотрите в камеру</li>
                                        <li>Загрузить можно только одно видео за раз</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="upload-form space-y-6">
                        <div>
                            <label for="card-name" class="block text-sm/6 font-medium text-gray-900">Название визитки</label>
                            <div class="mt-1">
                                <input type="text" 
                                    id="card-name" 
                                    name="card-name" 
                                    class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 outline-none" 
                                    placeholder="Введите название визитки">
                            </div>
                        </div>
                        <div class="upload-container">
                            <div id="dropzone" class="dropzone"></div>
                        </div>
                        <div class="upload-actions">
                            <button type="button" class="submit-video inline-flex items-center rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="-ml-0.5 mr-2 h-4 w-4" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Отправить видео
                            </button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">Всего моих визиток</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 cards-total">0</dd>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm ring-1 ring-gray-900/5">
                        <dt class="text-sm font-medium text-gray-600">В обработке</dt>
                        <dd class="mt-2 text-3xl font-semibold tracking-tight text-gray-900 cards-processing">0</dd>
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
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Метрики</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Тип личности</th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Статус</th>
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
    $templates->documentJavascript("My Cards");
    ?>
</body>

</html>