window.currentPage = 1;

function deleteUser(userId, login) {
    Swal.fire({
        title: 'Вы уверены?',
        text: `Вы действительно хотите удалить пользователя "${login}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Да, удалить',
        cancelButtonText: 'Отмена'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './src/Api/v1.php?deleteUser=true',
                method: 'POST',
                data: { userId: userId },
                dataType: 'json',
                success: function (data) {
                    if (data.status === "success") {
                        Swal.fire({
                            title: 'Удалено!',
                            text: 'Пользователь был успешно удален',
                            icon: 'success',
                            confirmButtonColor: '#4F46E5'
                        }).then(() => {
                            window.loadUsers(window.currentPage);
                        });
                    } else {
                        Swal.fire({
                            title: 'Ошибка!',
                            text: data.message || 'Не удалось удалить пользователя',
                            icon: 'error',
                            confirmButtonColor: '#4F46E5'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Ошибка!',
                        text: 'Не удалось удалить пользователя',
                        icon: 'error',
                        confirmButtonColor: '#4F46E5'
                    });
                }
            });
        }
    });
}

function editUser(userId) {
    const userRow = $(`tr[data-user-id="${userId}"]`);
    const login = userRow.find('.user-login').text().trim();
    const fullName = userRow.find('.user-full-name').text().trim();
    const telegram = userRow.find('.user-telegram').text().trim();
    const role = userRow.find('.user-role').text().trim();

    Swal.fire({
        title: 'Редактирование пользователя',
        html: `
            <div class="mb-4">
                <input id="edit-login" class="swal2-input" placeholder="Логин" value="${login}">
            </div>
            <div class="mb-4">
                <input id="edit-full-name" class="swal2-input" placeholder="Имя" value="${fullName}">
            </div>
            <div class="mb-4">
                <input id="edit-telegram" class="swal2-input" placeholder="Телеграм" value="${telegram}">
            </div>
            <div class="mb-4">
                <select id="edit-role" class="swal2-select">
                    <option value="admin" ${role === 'admin' ? 'selected' : ''}>Администратор</option>
                    <option value="user" ${role === 'user' ? 'selected' : ''}>Пользователь</option>
                </select>
            </div>
            <div class="mb-4">
                <input id="edit-password" type="password" class="swal2-input" placeholder="Новый пароль (оставьте пустым, если не меняете)">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Сохранить',
        cancelButtonText: 'Отмена',
        confirmButtonColor: '#4F46E5',
        preConfirm: () => {
            const newLogin = document.getElementById('edit-login').value.trim();
            const newRole = document.getElementById('edit-role').value;
            const newPassword = document.getElementById('edit-password').value.trim();
            const newFullName = document.getElementById('edit-full-name').value.trim();
            const newTelegram = document.getElementById('edit-telegram').value.trim();

            if (!newLogin) {
                Swal.showValidationMessage('Логин не может быть пустым');
                return false;
            }

            return {
                login: newLogin,
                role: newRole,
                password: newPassword,
                fullName: newFullName,
                telegram: newTelegram
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './src/Api/v1.php?editUser=true',
                method: 'POST',
                data: {
                    userId: userId,
                    login: result.value.login,
                    role: result.value.role,
                    password: result.value.password,
                    fullName: result.value.fullName,
                    telegram: result.value.telegram
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire({
                            title: 'Сохранено!',
                            text: 'Данные пользователя обновлены',
                            icon: 'success',
                            confirmButtonColor: '#4F46E5'
                        }).then(() => {
                            window.loadUsers(window.currentPage);
                        });
                    } else {
                        Swal.fire({
                            title: 'Ошибка!',
                            text: data.message || 'Не удалось обновить данные',
                            icon: 'error',
                            confirmButtonColor: '#4F46E5'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Ошибка!',
                        text: 'Не удалось обновить данные',
                        icon: 'error',
                        confirmButtonColor: '#4F46E5'
                    });
                }
            });
        }
    });
}

function addUser() {
    Swal.fire({
        title: 'Добавление пользователя',
        html: `
            <div class="mb-4">
                <input id="add-login" class="swal2-input" placeholder="Логин">
            </div>
            <div class="mb-4">
                <input id="add-full-name" class="swal2-input" placeholder="Имя">
            </div>
            <div class="mb-4">
                <input id="add-telegram" class="swal2-input" placeholder="Телеграм">
            </div>
            <div class="mb-4">
                <input id="add-password" type="password" class="swal2-input" placeholder="Пароль">
            </div>
            <div class="mb-4">
                <select id="add-role" class="swal2-select">
                    <option value="admin">Администратор</option>
                    <option value="user">Пользователь</option>
                </select>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Добавить',
        cancelButtonText: 'Отмена',
        confirmButtonColor: '#4F46E5',
        preConfirm: () => {
            const login = document.getElementById('add-login').value.trim();
            const password = document.getElementById('add-password').value.trim();
            const role = document.getElementById('add-role').value;
            const fullName = document.getElementById('add-full-name').value.trim();
            const telegram = document.getElementById('add-telegram').value;

            if (!login) {
                Swal.showValidationMessage('Логин не может быть пустым');
                return false;
            }
            if (!password) {
                Swal.showValidationMessage('Пароль не может быть пустым');
                return false;
            }

            return {
                login: login,
                password: password,
                role: role,
                fullName: fullName,
                telegram: telegram
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: './src/Api/v1.php?addUser=true',
                method: 'POST',
                data: result.value,
                dataType: 'json',
                success: function(data) {
                    if (data.status === "success") {
                        Swal.fire({
                            title: 'Добавлено!',
                            text: 'Новый пользователь успешно создан',
                            icon: 'success',
                            confirmButtonColor: '#4F46E5'
                        }).then(() => {
                            window.loadUsers(window.currentPage);
                        });
                    } else {
                        Swal.fire({
                            title: 'Ошибка!',
                            text: data.message || 'Не удалось создать пользователя',
                            icon: 'error',
                            confirmButtonColor: '#4F46E5'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Ошибка!',
                        text: 'Не удалось создать пользователя',
                        icon: 'error',
                        confirmButtonColor: '#4F46E5'
                    });
                }
            });
        }
    });
}

window.loadUsers = function(page = 1) {
    window.currentPage = page;

    $.ajax({
        url: './src/Api/v1.php?getAllUsers=true',
        method: 'GET',
        data: { page: page },
        dataType: 'json',
        success: function(data) {
            if (data.status === "success") {
                const tbody = $('.cards-table-body');
                tbody.empty();

                data.data.forEach(user => {

                    let telegram = user.telegram ? user.telegram : "N/A";
                    let fullName = user.full_name ? user.full_name : "N/A";

                    tbody.append(`
                        <tr data-user-id="${user.id}">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm text-gray-900">${user.id}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 user-login">${user.login}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 user-full-name">${fullName}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 user-telegram"><a href="https://t.me/${telegram}" target="_blank" class="text-indigo-600 font-medium hover:opacity-80 transition-opacity">${telegram}</a></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 user-role">${user.role}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.cards_count}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${formatDate(user.created_at)}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <button onclick="editUser(${user.id})"
                                        class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                                    </button>
                                    
                                    <button onclick="deleteUser(${user.id}, '${user.login}')"
                                        class="inline-flex items-center gap-x-1.5 rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
    
                    $('.candidates-total').text(data.stats.total.toLocaleString());
                    $('.cards-total').text(data.stats.totalCards.toLocaleString());
    
                    window.currentPage = data.pagination.current;
                    $('.pagination-buttons').html(createPaginationButtons(
                        window.currentPage,
                        data.pagination.total
                    ));
    
                    $('.pagination-start').text(((currentPage - 1) * data.pagination.perPage + 1).toLocaleString());
                    $('.pagination-end').text(Math.min(currentPage * data.pagination.perPage, data.pagination.totalRecords).toLocaleString());
                    $('.pagination-total').text(data.pagination.totalRecords.toLocaleString());
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Ошибка!',
                    text: 'Не удалось загрузить данные',
                    icon: 'error',
                    confirmButtonColor: '#4F46E5'
                });
            }
        });
    };

    function createPaginationButtons(currentPage, totalPages) {
        const buttons = [];
    
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
    
        return buttons.join('');
    }
    
    function formatDate(dateStr) {
        if (!dateStr) return '';
        
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
    }
    
    $(document).ready(function() {
        window.loadUsers(1);
    
        $('.users-table-header').prepend(`
            <button onclick="addUser()" 
                class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Добавить пользователя
            </button>
        `);
    });
    
    $(document).on('click', 'button[data-page]', function() {
        const page = parseInt($(this).data('page'));
        if (page) window.loadUsers(page);
    });
    
    $(document).on('click', '.pagination-prev:not([disabled])', function() {
        window.loadUsers(window.currentPage - 1);
    });
    
    $(document).on('click', '.pagination-next:not([disabled])', function() {
        window.loadUsers(window.currentPage + 1);
    });