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

let professions = [];
let candidates = [];

$(document).ready(function () {

    loadProfessions();
    loadStatistics();

    $('#team-positions').select2({
        placeholder: 'Выберите профессии',
        width: '100%'
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

function loadStatistics() {
    $.ajax({
        url: './src/Api/v1.php?getRecruitmentStats=true',
        method: 'GET',
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === "success") {
                window.statsData = response.stats;
                $('.candidates-total').text(response.stats.totalUsers);
                $('.cards-total').text(response.stats.totalCards);
            }
        }
    });
}

function loadProfessions() {
    $.ajax({
        url: './src/Api/v1.php?getProfessions=true',
        method: 'GET',
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === "success") {
                professions = response.data;
                updateProfessionsTable();
                updateProfessionSelects();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error loading professions:', error);
        }
    });
}

function updateProfessionsTable() {
    const tbody = $('.professions-table-body');
    tbody.empty();

    professions.forEach(profession => {
        const metrics = JSON.parse(profession.ocean_json.replace(/\n/g, ''));

        tbody.append(`
            <tr data-id="${profession.id}">
                <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm text-gray-900">${profession.profession_name}</td>
                <td class="px-3 py-4 text-sm">
                    <input type="number" class="ocean-input w-20 rounded-md border border-gray-300 p-1" 
                           data-metric="openness" step="0.1" min="0" max="1" 
                           value="${metrics.openness}">
                </td>
                <td class="px-3 py-4 text-sm">
                    <input type="number" class="ocean-input w-20 rounded-md border border-gray-300 p-1" 
                           data-metric="conscientiousness" step="0.1" min="0" max="1" 
                           value="${metrics.conscientiousness}">
                </td>
                <td class="px-3 py-4 text-sm">
                    <input type="number" class="ocean-input w-20 rounded-md border border-gray-300 p-1" 
                           data-metric="extraversion" step="0.1" min="0" max="1" 
                           value="${metrics.extraversion}">
                </td>
                <td class="px-3 py-4 text-sm">
                    <input type="number" class="ocean-input w-20 rounded-md border border-gray-300 p-1" 
                           data-metric="agreeableness" step="0.1" min="0" max="1" 
                           value="${metrics.agreeableness}">
                </td>
                <td class="px-3 py-4 text-sm">
                    <input type="number" class="ocean-input w-20 rounded-md border border-gray-300 p-1" 
                           data-metric="neuroticism" step="0.1" min="0" max="1" 
                           value="${metrics.neuroticism}">
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                        <button onclick="saveProfession(${profession.id})" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v3a1 1 0 0 0 1 1h5"/><path d="M18 18v-6a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v6"/><path d="M18 22H4a2 2 0 0 1-2-2V6"/><path d="M8 18a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9.172a2 2 0 0 1 1.414.586l2.828 2.828A2 2 0 0 1 22 6.828V16a2 2 0 0 1-2.01 2z"/></svg>
                        </button>
                        <button onclick="deleteProfession(${profession.id})" class="inline-flex items-center gap-x-1.5 rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </td>
            </tr>
        `);
    });

    if (window.statsData) {
        $('.candidates-total').text(window.statsData.totalUsers);
        $('.cards-total').text(window.statsData.totalCards);
    }
}

function validateOceanInputs(row) {
    const inputs = row.find('.ocean-input');
    let sum = 0;
    inputs.each(function () {
        sum += parseFloat($(this).val() || 0);
    });

    if (Math.abs(sum - 1) > 0.01) {
        Swal.fire({
            title: 'Ошибка!',
            text: 'Сумма всех значений должна быть равна 1',
            icon: 'error',
            confirmButtonColor: '#4F46E5'
        });
        return false;
    }
    return true;
}

function addProfession() {
    Swal.fire({
        title: 'Добавление профессии',
        html: `
            <input id="profession-name" class="swal2-input" placeholder="Название профессии">
            <div class="grid grid-cols-5 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">O</label>
                    <input type="number" id="ocean-o" class="swal2-input" step="0.1" min="0" max="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">C</label>
                    <input type="number" id="ocean-c" class="swal2-input" step="0.1" min="0" max="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">E</label>
                    <input type="number" id="ocean-e" class="swal2-input" step="0.1" min="0" max="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">A</label>
                    <input type="number" id="ocean-a" class="swal2-input" step="0.1" min="0" max="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">N</label>
                    <input type="number" id="ocean-n" class="swal2-input" step="0.1" min="0" max="1">
                </div>
            </div>
        `,
        focusConfirm: false,
        preConfirm: () => {
            const name = document.getElementById('profession-name').value;
            const metrics = {
                openness: parseFloat(document.getElementById('ocean-o').value),
                conscientiousness: parseFloat(document.getElementById('ocean-c').value),
                extraversion: parseFloat(document.getElementById('ocean-e').value),
                agreeableness: parseFloat(document.getElementById('ocean-a').value),
                neuroticism: parseFloat(document.getElementById('ocean-n').value)
            };

            if (!name || Object.values(metrics).some(v => isNaN(v))) {
                Swal.showValidationMessage('Пожалуйста, заполните все поля');
                return false;
            }

            const sum = Object.values(metrics).reduce((a, b) => a + b, 0);
            if (Math.abs(sum - 1) > 0.01) {
                Swal.showValidationMessage('Сумма весов должна быть равна 1');
                return false;
            }

            return { name, metrics };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './src/Api/v1.php?addProfession=true',
                method: 'POST',
                data: {
                    name: result.value.name,
                    metrics: JSON.stringify(result.value.metrics)
                },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status === "success") {
                        Swal.fire('Успешно!', 'Профессия добавлена', 'success');
                        loadProfessions();
                    } else {
                        Swal.fire('Ошибка!', response.message, 'error');
                    }
                }
            });
        }
    });
}

function saveProfession(id) {
    const row = $(`tr[data-id="${id}"]`);
    if (!validateOceanInputs(row)) return;

    const metrics = {
        openness: parseFloat(row.find('[data-metric="openness"]').val()),
        conscientiousness: parseFloat(row.find('[data-metric="conscientiousness"]').val()),
        extraversion: parseFloat(row.find('[data-metric="extraversion"]').val()),
        agreeableness: parseFloat(row.find('[data-metric="agreeableness"]').val()),
        neuroticism: parseFloat(row.find('[data-metric="neuroticism"]').val())
    };

    $.ajax({
        url: './src/Api/v1.php?updateProfession=true',
        method: 'POST',
        data: {
            id: id,
            metrics: JSON.stringify(metrics)
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === "success") {
                Swal.fire({
                    title: 'Успешно!',
                    text: 'Изменения сохранены',
                    icon: 'success',
                    confirmButtonColor: '#4F46E5'
                });
                loadProfessions();
            }
        }
    });
}

function deleteProfession(id) {
    Swal.fire({
        title: 'Вы уверены?',
        text: "Это действие нельзя будет отменить",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Да, удалить',
        cancelButtonText: 'Отмена'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './src/Api/v1.php?deleteProfession=true',
                method: 'POST',
                data: { id: id },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status === "success") {
                        Swal.fire('Удалено!', 'Профессия удалена', 'success');
                        loadProfessions();
                    }
                }
            });
        }
    });
}

function updateProfessionSelects() {
    const singleSelect = $('#single-position');
    const teamSelect = $('#team-positions');

    singleSelect.empty();
    teamSelect.empty();

    singleSelect.append('<option value="">Выберите профессию</option>');

    professions.forEach(profession => {
        const option = `<option value="${profession.id}">${profession.profession_name}</option>`;
        singleSelect.append(option);
        teamSelect.append(option);
    });
}

function findCandidates() {
    const professionId = $('#single-position').val();
    if (!professionId) {
        Swal.fire('Ошибка!', 'Выберите профессию', 'warning');
        return;
    }

    $.ajax({
        url: './src/Api/v1.php?findCandidates=true',
        method: 'POST',
        data: { professionId: professionId },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === "success") {
                const resultsDiv = $('.candidates-results');
                resultsDiv.empty();

                response.candidates.forEach(candidate => {
                    resultsDiv.append(`
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900">${candidate.fullName} (${candidate.name})</h5>
                                    <p class="text-sm text-gray-500">Совпадение: ${candidate.match_score.toFixed(1)}%</p>
                                </div>
                                <button onclick="showCandidateDetails(${candidate.id})" 
                                        class="text-indigo-600 hover:text-indigo-900">
                                    Подробнее
                                </button>
                            </div>
                        </div>
                    `);
                });

                $('.candidates-list').removeClass('hidden');
            }
        }
    });
}

function findTeam() {
    const selectedProfessions = $('#team-positions').val();
    if (!selectedProfessions || selectedProfessions.length === 0) {
        Swal.fire({
            title: 'Ошибка!',
            text: 'Выберите хотя бы одну профессию',
            icon: 'warning',
            confirmButtonColor: '#4F46E5'
        });
        return;
    }

    $.ajax({
        url: './src/Api/v1.php?findTeam=true',
        method: 'POST',
        data: { professions: selectedProfessions },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === "success") {
                const resultsDiv = $('.team-results');
                resultsDiv.empty();

                response.team.forEach(member => {
                    resultsDiv.append(`
                        <div class="bg-white p-4 rounded-lg shadow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h5 class="text-sm font-medium text-gray-900">${member.fullName} (${member.name})</h5>
                                    <p class="text-sm text-gray-500">${member.profession}</p>
                                    <p class="text-sm text-gray-500">Совпадение: ${(member.match_score).toFixed(1)}%</p>
                                </div>
                                <button onclick="showCandidateDetails(${member.id})" 
                                        class="text-indigo-600 hover:text-indigo-900">
                                    Подробнее
                                </button>
                            </div>
                        </div>
                    `);
                });

                $('.team-list').removeClass('hidden');
            } else {
                Swal.fire({
                    title: 'Ошибка!',
                    text: response.message || 'Не удалось сформировать команду',
                    icon: 'error',
                    confirmButtonColor: '#4F46E5'
                });
                $('.team-list').addClass('hidden');
            }
        },
        error: function () {
            Swal.fire({
                title: 'Ошибка!',
                text: 'Не удалось выполнить запрос',
                icon: 'error',
                confirmButtonColor: '#4F46E5'
            });
        }
    });
}

function showCandidateDetails(candidateId) {
    $.ajax({
        url: './src/Api/v1.php?getCandidateDetails=true',
        method: 'POST',
        data: { candidateId: candidateId },
        success: function(response) {
            response = JSON.parse(response);
            if(response.status === "success") {
                Swal.fire({
                    title: `${response.candidate.fullName} (${response.candidate.name})`,
                    html: `
                        <div class="text-left">
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <h3 class="font-semibold text-gray-900">Психотип:</h3>
                                    <div class="inline-flex items-center rounded-md bg-purple-100 px-2 py-1 text-xs font-medium text-purple-800 gap-x-1.5">
                                    <span>${response.candidate.metrics.personality_type}</span>
                                    <span class="cursor-pointer hover:opacity-80 transition-opacity personality-tippy" data-personality="${response.candidate.metrics.personality_type}">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                    </span>
                                </div>
                                </div>
                                
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h3 class="font-semibold text-gray-900 mb-3">Метрики OCEAN</h3>
                                    <div class="grid gap-3">
                                        <div class="md:flex grid items-center md:justify-between md:gap-y-0 gap-y-1">
                                            <span class="text-sm font-medium text-gray-600">Открытость опыту:</span>
                                            <div class="flex items-center gap-2">
                                                <div class="md:w-32 w-[85%] h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-indigo-600 rounded-full" style="width: ${response.candidate.metrics.openness}%"></div>
                                                </div>
                                                <span class="text-sm font-semibold text-gray-900">${response.candidate.metrics.openness}%</span>
                                            </div>
                                        </div>
                                        <div class="md:flex grid items-center md:justify-between md:gap-y-0 gap-y-1">
                                            <span class="text-sm font-medium text-gray-600">Добросовестность:</span>
                                            <div class="flex items-center gap-2">
                                                <div class="md:w-32 w-[85%] h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-indigo-600 rounded-full" style="width: ${response.candidate.metrics.conscientiousness}%"></div>
                                                </div>
                                                <span class="text-sm font-semibold text-gray-900">${response.candidate.metrics.conscientiousness}%</span>
                                            </div>
                                        </div>
                                        <div class="md:flex grid items-center md:justify-between md:gap-y-0 gap-y-1">
                                            <span class="text-sm font-medium text-gray-600">Экстраверсия:</span>
                                            <div class="flex items-center gap-2">
                                                <div class="md:w-32 w-[85%] h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-indigo-600 rounded-full" style="width: ${response.candidate.metrics.extraversion}%"></div>
                                                </div>
                                                <span class="text-sm font-semibold text-gray-900">${response.candidate.metrics.extraversion}%</span>
                                            </div>
                                        </div>
                                        <div class="md:flex grid items-center md:justify-between md:gap-y-0 gap-y-1">
                                            <span class="text-sm font-medium text-gray-600">Доброжелательность:</span>
                                            <div class="flex items-center gap-2">
                                                <div class="md:w-32 w-[85%] h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-indigo-600 rounded-full" style="width: ${response.candidate.metrics.agreeableness}%"></div>
                                                </div>
                                                <span class="text-sm font-semibold text-gray-900">${response.candidate.metrics.agreeableness}%</span>
                                            </div>
                                        </div>
                                        <div class="md:flex grid items-center md:justify-between md:gap-y-0 gap-y-1">
                                            <span class="text-sm font-medium text-gray-600">Невротизм:</span>
                                            <div class="flex items-center gap-2">
                                                <div class="md:w-32 w-[85%] h-2 bg-gray-200 rounded-full">
                                                    <div class="h-2 bg-indigo-600 rounded-full" style="width: ${response.candidate.metrics.neuroticism}%"></div>
                                                </div>
                                                <span class="text-sm font-semibold text-gray-900">${response.candidate.metrics.neuroticism}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 md:flex grid items-center justify-center gap-2">
                                <button onclick="showVideo('${response.candidate.video_url}', '${response.candidate.name}')" 
                                        class="inline-flex text-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="5 3 19 12 5 21 5 3"/>
                                    </svg>
                                    Посмотреть видеовизитку
                                </button>
                                <a href="https://t.me/${response.candidate.telegram}" 
                                        class="inline-flex text-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm gap-2">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"/><path d="m21.854 2.147-10.94 10.939"/></svg>
                                    Открыть телеграм
                                </a>
                            </div>
                        </div>
                    `,
                    width: '600px',
                    showConfirmButton: false,
                    showCloseButton: true,
                    didOpen: () => {
                        setTimeout(() => {
                            initializePersonalityTooltips();
                        }, 100);
                    }
                });
            }
        }
    });
 }
 
function showVideo(videoUrl, candidateName) {
    Swal.fire({
        title: `Видеовизитка ${candidateName}`,
        html: `
            <div class="relative aspect-video w-full max-w-3xl mx-auto">
                <video 
                    id="previewVideo"
                    class="w-full h-full rounded-lg shadow-lg" 
                    controls 
                    src="${videoUrl}"
                >
                    Your browser does not support the video tag.
                </video>
            </div>
        `,
        width: '800px',
        showConfirmButton: false,
        showCloseButton: true,
        didOpen: () => {
            const video = document.getElementById('previewVideo');
            video.play();
        },
        willClose: () => {
            const video = document.getElementById('previewVideo');
            video.pause();
        }
    });
 }