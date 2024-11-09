const personalityDescriptions = {
    "ENTJ": "ENTJ — это решительные лидеры с ясной и логичной структурой мышления. Им нравится брать на себя ответственность, они целеустремлённы и могут эффективно организовывать работу других. Часто являются стратегическими мыслителями и ориентированы на достижение долгосрочных целей. Лучше всего взаимодействуют с INTP и INFP, сложнее — с ISFP и ISFJ.",
    "ENTP": "ENTP — это изобретатели и инициаторы. Они любят идеи, находят нестандартные решения и наслаждаются интеллектуальными дискуссиями. Их отличает гибкость и способность видеть возможности в каждой ситуации. Лучше всего взаимодействуют с INFJ и INTJ, сложнее — с ISFJ и ISTJ.",
    "ENFJ": "ENFJ — это харизматичные вдохновители, которые чувствуют потребности других и стремятся к гармонии. Они обладают высокой эмпатией, ориентированы на поддержку и часто занимают роль наставников и лидеров. Лучше всего взаимодействуют с INFP и INTP, сложнее — с ISTP и ESTP.",
    "ENFP": "ENFP — это энтузиасты и вдохновляющие личности, которые ценят творчество и свободу. Им важны связи с людьми, они любят помогать другим раскрывать потенциал и обладают широтой интересов. Лучше всего взаимодействуют с INFJ и INTJ, сложнее — с ISTJ и ISFJ.",
    "ESTJ": "ESTJ — это организаторы, ценящие порядок и стабильность. Они рациональны, ориентированы на результат и любят следовать правилам и структуре. Хорошо справляются с практическими задачами и ответственно подходят к обязанностям. Лучше всего взаимодействуют с ISTP и ISFP, сложнее — с INFP и INTP.",
    "ESTP": "ESTP — это энергичные люди действия, которые быстро реагируют на происходящее. Они любят приключения, склонны к импульсивным решениям и уверенно справляются с практическими проблемами. Лучше всего взаимодействуют с ISTJ и ISFJ, сложнее — с INFJ и INTJ.",
    "ESFJ": "ESFJ — это заботливые и внимательные к людям личности. Они ценят традиции, любят помогать другим и создают комфортную атмосферу. Хорошо работают в команде и стремятся к поддержанию гармонии. Лучше всего взаимодействуют с ISFP и INFP, сложнее — с INTP и INTJ.",
    "ESFP": "ESFP — это оптимистичные и дружелюбные люди, которые любят веселье и живое общение. Они ценят радости настоящего момента, легко находят общий язык с окружающими и умеют радовать других. Лучше всего взаимодействуют с ISFJ и ISTJ, сложнее — с INTJ и INFJ.",
    "INTJ": "INTJ — это стратеги, которые ценят логику, анализ и планирование. Они ориентированы на достижение целей, независимо мыслят и обладают способностью к глубокому осмыслению сложных вопросов. Лучше всего взаимодействуют с ENFP и ENTJ, сложнее — с ESFP и ESTP.",
    "INTP": "INTP — это исследователи и философы, которым нравится анализировать и изучать мир. Они предпочитают теоретический подход, ценят свободу в работе и склонны к логическим рассуждениям. Лучше всего взаимодействуют с ENTJ и ENFJ, сложнее — с ESFJ и ESTJ.",
    "INFJ": "INFJ — это интуитивные идеалисты, которые стремятся помогать другим и делать мир лучше. Они чувствуют чужие эмоции, имеют чёткое представление о своих ценностях и идут к своим целям с настойчивостью. Лучше всего взаимодействуют с ENFP и ENTP, сложнее — с ESTP и ISTP.",
    "INFP": "INFP — это мечтатели и гуманисты, которые ценят искренность, индивидуальность и личные идеалы. Они ориентированы на внутренний мир, склонны к творчеству и могут глубоко сопереживать другим. Лучше всего взаимодействуют с ENFJ и ENTJ, сложнее — с ESTJ и ESFJ.",
    "ISTJ": "ISTJ — это надёжные и практичные личности, которые ценят порядок и следуют правилам. Они тщательно выполняют задачи, внимательны к деталям и отличаются ответственностью. Лучше всего взаимодействуют с ESTP и ESFP, сложнее — с ENFP и ENTP.",
    "ISTP": "ISTP — это аналитики и решатели проблем, которые любят работать руками и быстро адаптируются к изменяющимся условиям. Они предпочитают практическую деятельность и ценят свободу действий. Лучше всего взаимодействуют с ESTJ и ENTJ, сложнее — с ENFJ и ESFJ.",
    "ISFJ": "ISFJ — это доброжелательные и заботливые личности, которые ориентированы на помощь другим. Они ценят традиции, отличаются трудолюбием и стремятся создать комфортную атмосферу для окружающих. Лучше всего взаимодействуют с ESFP и ESTP, сложнее — с ENTP и ENFP.",
    "ISFP": "ISFP — это творческие и спокойные люди, которые ценят красоту и гармонию. Они склонны к самовыражению, умеют наслаждаться моментом и глубоко чувствуют внутренний мир. Лучше всего взаимодействуют с ESFJ и ESTJ, сложнее — с ENTJ и ENTP."
}

Dropzone.autoDiscover = false;

const myDropzone = new Dropzone("#dropzone", {
    url: "./src/Api/v1.php?uploadVideo=true",
    maxFilesize: 15,
    acceptedFiles: "video/mp4",
    maxFiles: 1,
    autoProcessQueue: false,
    addRemoveLinks: true,
    dictDefaultMessage: `
        <div class="flex flex-col items-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m4-12h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-600">
                <p class="text-center">
                    <span class="font-medium text-indigo-600 hover:text-indigo-500">Загрузите видео</span>
                    или перетащите его сюда
                </p>
            </div>
            <p class="text-xs text-gray-500 mt-2">MP4 до 15 МБ</p>
        </div>
    `,
    dictFileTooBig: "Файл слишком большой ({{filesize}}МБ). Максимальный размер: {{maxFilesize}}МБ.",
    dictInvalidFileType: "Можно загружать только MP4 файлы.",
    dictResponseError: "Ошибка загрузки файла.",
    dictCancelUpload: "Отменить загрузку",
    dictUploadCanceled: "Загрузка отменена.",
    dictRemoveFile: "Удалить",
    createImageThumbnails: false,
    init: function() {
        const submitButton = document.querySelector('.submit-video');
        const actionsContainer = document.querySelector('.upload-actions');
        const cardNameInput = document.querySelector('#card-name');

        this.on("addedfile", function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
            actionsContainer.style.display = 'block';
            this.validateForm();
        });

        this.on("removedfile", function() {
            if (this.files.length === 0) {
                actionsContainer.style.display = 'none';
                submitButton.disabled = true;
            }
        });

        this.validateForm = function() {
            const cardName = cardNameInput.value.trim();
            submitButton.disabled = !cardName || this.files.length === 0;
        };

        cardNameInput.addEventListener('input', () => {
            this.validateForm();
        });

        this.on("sending", function(file, xhr, formData) {
            const cardName = cardNameInput.value.trim();
            formData.append("cardName", cardName);
        });

        this.on("success", function(file, response) {
            try {
                const data = typeof response === 'string' ? JSON.parse(response) : response;
                
                if(data.status === "success") {
                    startProcessingCheck(data.cardId);
                    Swal.fire({
                        title: 'Загружено!',
                        text: 'Визитка успешно загружена и отправлена на обработку',
                        icon: 'success',
                        confirmButtonColor: '#4F46E5'
                    }).then(() => {
                        this.removeAllFiles();
                        actionsContainer.style.display = 'none';
                        submitButton.disabled = true;
                        cardNameInput.value = ''; 
                        window.loadCards(window.currentPage);
                    });
                } else {
                    throw new Error(data.message || 'Неизвестная ошибка');
                }
            } catch (e) {
                console.error('Response parsing error:', e);
                Swal.fire({
                    title: 'Ошибка!',
                    text: e.message,
                    icon: 'error',
                    confirmButtonColor: '#4F46E5'
                });
                this.removeFile(file);
            }
        });

        this.on("error", function(file, errorMessage, xhr) {
            let message = errorMessage;
            
            if (typeof errorMessage === 'string') {
                message = errorMessage;
            } else if (errorMessage.message) {
                message = errorMessage.message;
            } else {
                message = 'Произошла ошибка при загрузке файла';
            }
            
            console.error('Upload error:', errorMessage);
            
            Swal.fire({
                title: 'Ошибка!',
                text: message,
                icon: 'error',
                confirmButtonColor: '#4F46E5'
            });
            
            this.removeFile(file);
            actionsContainer.classList.remove('visible');
            submitButton.disabled = true;
        });
    }
});

function startProcessingCheck(cardId) {
    const checkInterval = setInterval(() => {
        $.ajax({
            url: './src/Api/v1.php?checkProcessing=true',
            method: 'POST',
            data: { cardId: cardId },
            dataType: 'json',
            success: function (data) {
                if (data.status === "completed") {
                    clearInterval(checkInterval);
                    window.loadCards(window.currentPage);
                }
            }
        });
    }, 5000);
}

function formatDate(dateStr) {
    if (!dateStr) return '-';
    
    try {
        const parts = dateStr.split(' ');
        const dateParts = parts[0].split('.');
        const timeParts = parts[1].split(':');

        const formattedDate = new Date(
            parseInt(dateParts[2]),  
            parseInt(dateParts[1]) - 1,  
            parseInt(dateParts[0]),  
            parseInt(timeParts[0]), 
            parseInt(timeParts[1]),  
            parseInt(timeParts[2])  
        );

        return formattedDate.toLocaleString('ru-RU', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }).replace(',', '');
    } catch (e) {
        console.error('Error formatting date:', e);
        return dateStr;
    }
}

function getIndicatorColor(value) {
    if (value >= 80) return 'bg-green-100 text-green-800';
    if (value >= 60) return 'bg-blue-100 text-blue-800';
    if (value >= 40) return 'bg-yellow-100 text-yellow-800';
    return 'bg-red-100 text-red-800';
}

document.querySelector('.submit-video').addEventListener('click', function() {
    const cardName = document.querySelector('#card-name').value.trim();
    
    if (!cardName) {
        Swal.fire({
            title: 'Ошибка!',
            text: 'Пожалуйста, введите название визитки',
            icon: 'warning',
            confirmButtonColor: '#4F46E5'
        });
        return;
    }

    if (myDropzone.files.length > 0) {
        myDropzone.processQueue();
    } else {
        Swal.fire({
            title: 'Ошибка!',
            text: 'Пожалуйста, загрузите видео',
            icon: 'warning',
            confirmButtonColor: '#4F46E5'
        });
    }
});

window.loadCards = function(page = 1) {
    window.currentPage = page;

    $.ajax({
        url: './src/Api/v1.php?getMyCards=true',
        method: 'GET',
        data: { page: page },
        dataType: 'json',
        success: function(data) {
            if(data.status === "success") {
                const tbody = $('.cards-table-body');
                tbody.empty();

                data.data.forEach(card => {
                    const isProcessing = !card.score;
                    const statusBadge = isProcessing ? 
                        `<span class="inline-flex items-center rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">Обработка</span>` :
                        `<span class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800">Готово</span>`;

                    tbody.append(`
                        <tr data-card-id="${card.id}">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm text-gray-900">${card.id}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">${card.card_name}</td>
                            <td class="px-3 py-4 text-sm">${formatMetrics(card.score)}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">${formatPersonalityType(card.score)}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">${statusBadge}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${formatDate(card.created_at)}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <button onclick="window.handleVideoPreview('${card.video_path}', '${card.card_name}')"
                                        class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                    </button>
                                    ${!isProcessing ? `
                                        <button onclick="findBestProfession(${card.id})"
                                            class="inline-flex items-center gap-x-1.5 rounded-md bg-green-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                                        </button>
                                    ` : ''}
                                    <button onclick="deleteCard(${card.id}, '${card.card_name}')"
                                        class="inline-flex items-center gap-x-1.5 rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);

                    if(isProcessing) {
                        startProcessingCheck(card.id);
                    }
                });

                initializePersonalityTooltips();

                $('.cards-total').text(data.stats.total.toLocaleString());
                $('.cards-processing').text(processingStatus);

                updatePagination(data.pagination);
            }
        }
    });
};

function findBestProfession(cardId) {
    $.ajax({
        url: './src/Api/v1.php?findBestProfession=true',
        method: 'POST',
        data: { cardId: cardId },
        dataType: 'json',
        success: function (data) {
            if (data.status === "success") {
                Swal.fire({
                    title: 'Наиболее подходящая профессия',
                    html: `
                        <div class="text-center">
                            <p class="font-semibold text-lg mb-2">${data.profession.name}</p>
                            <p class="text-sm text-gray-600">Совпадение: ${data.matchScore.toFixed(2)}%</p>
                            </div>
                        `,
                    icon: 'info',
                    confirmButtonColor: '#4F46E5'
                });
            }
        }
    });
}

function updatePagination(paginationData) {
    const buttons = [];
    const currentPage = paginationData.current;
    const totalPages = paginationData.total;

    buttons.push(`
        <button 
            class="pagination-prev relative inline-flex items-center rounded-l-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}"
            ${currentPage === 1 ? 'disabled' : ''}
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </button>
    `);

    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    if (endPage === totalPages) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    if (startPage > 1) {
        buttons.push(`
            <button data-page="1" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">1</button>
        `);
        if (startPage > 2) {
            buttons.push(`
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700">...</span>
            `);
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        buttons.push(`
            <button 
                data-page="${i}" 
                class="relative inline-flex items-center px-3 py-2 text-sm font-semibold ${i === currentPage
                    ? 'bg-indigo-600 text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                    : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20'
                }"
            >${i}</button>
        `);
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            buttons.push(`
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700">...</span>
            `);
        }
        buttons.push(`
            <button data-page="${totalPages}" class="relative inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">${totalPages}</button>
        `);
    }

    buttons.push(`
        <button 
            class="pagination-next relative inline-flex items-center rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}"
            ${currentPage === totalPages ? 'disabled' : ''}
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </button>
    `);

    $('.pagination-buttons').html(buttons.join(''));
    $('.pagination-start').text(((currentPage - 1) * paginationData.perPage + 1).toLocaleString());
    $('.pagination-end').text(Math.min(currentPage * paginationData.perPage, paginationData.totalRecords).toLocaleString());
    $('.pagination-total').text(paginationData.totalRecords.toLocaleString());

    $(document).off('click', 'button[data-page]').on('click', 'button[data-page]', function() {
        const page = parseInt($(this).data('page'));
        if (page) window.loadCards(page);
    });

    $(document).off('click', '.pagination-prev:not([disabled])').on('click', '.pagination-prev:not([disabled])', function() {
        window.loadCards(currentPage - 1);
    });

    $(document).off('click', '.pagination-next:not([disabled])').on('click', '.pagination-next:not([disabled])', function() {
        window.loadCards(currentPage + 1);
    });
}

function formatMetrics(scoreJson) {
    if (!scoreJson) {
        return `<span class="inline-flex items-center rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">
            Ожидание анализа...
        </span>`;
    }

    try {
        const score = JSON.parse(scoreJson);
        const metrics = [
            { name: 'O', value: score.openness },
            { name: 'C', value: score.conscientiousness },
            { name: 'E', value: score.extraversion },
            { name: 'A', value: score.agreeableness },
            { name: 'N', value: score.neuroticism }
        ];

        return metrics.map(metric => `
            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ${getIndicatorColor(metric.value)}">
                ${metric.name}: ${metric.value}/100
            </span>
        `).join(' ');
    } catch (e) {
        return `<span class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-800">
            Ошибка анализа
        </span>`;
    }
}

function formatPersonalityType(scoreJson) {
    if (!scoreJson) {
        return '-';
    }

    try {
        const score = JSON.parse(scoreJson);
        return score.personality_type ? `
            <div class="inline-flex items-center rounded-md bg-purple-100 px-2 py-1 text-xs font-medium text-purple-800 gap-x-1.5">
                <span>${score.personality_type}</span>
                <span class="cursor-pointer hover:opacity-80 transition-opacity personality-tippy" data-personality="${score.personality_type}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                </span>
            </div>
        ` : '-';
    } catch (e) {
        return '-';
    }
}

window.handleVideoPreview = function (videoPath, cardName) {
    const modal = $('.video-modal');
    const video = $('#previewVideo');
    video.attr('src', videoPath);
    $('.video-modal-title').text(cardName);
    modal.removeClass('hidden');
    video[0].play();
};

function deleteCard(cardId, cardName) {
    Swal.fire({
        title: 'Вы уверены?',
        text: `Вы действительно хотите удалить визитку "${cardName}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Да, удалить',
        cancelButtonText: 'Отмена'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './src/Api/v1.php?deleteMyCard=true',
                method: 'POST',
                data: { cardId: cardId },
                dataType: 'json',
                success: function (data) {
                    if (data.status === "success") {
                        Swal.fire({
                            title: 'Удалено!',
                            text: 'Визитка успешно удалена',
                            icon: 'success',
                            confirmButtonColor: '#4F46E5'
                        }).then(() => {
                            window.loadCards(window.currentPage);
                        });
                    }
                }
            });
        }
    });
}

$(document).ready(function () {
    window.loadCards(1);

    $('.video-modal, .close-video-modal').on('click', function (e) {
        if (e.target === this || $(this).hasClass('close-video-modal')) {
            const modal = $('.video-modal');
            const video = $('#previewVideo');
            video[0].pause();
            video.removeAttr('src');
            modal.addClass('hidden');
        }
    });
});

function initializePersonalityTooltips() {
    tippy.hideAll({ duration: 0 });
    const existingInstances = document.querySelectorAll('[data-tippy-root]');
    existingInstances.forEach(instance => {
        const tippyInstance = instance._tippy;
        if (tippyInstance) {
            tippyInstance.destroy();
        }
    });

    tippy('.personality-tippy', {
        content(reference) {
            const personalityType = reference.getAttribute('data-personality');
            return personalityDescriptions[personalityType] || 'Описание отсутствует';
        },
        placement: 'top',
        arrow: true,
        theme: 'light-border',
        animation: 'scale',
        duration: [200, 150],
        interactive: true
    });
}