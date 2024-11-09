function animateNumber($element, newValue) {
    $({ number: parseInt($element.text()) }).animate({
        number: newValue
    }, {
        duration: 1000,
        easing: 'swing',
        step: function(now) {
            $element.text(Math.floor(now));
        }
    });
}

function loadStatistics() {
    $.ajax({
        url: './src/Api/v1.php?authUser',
        method: 'GET',
        data: {
            getStatistics: true
        },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if(data.status === "success") {
                    animateNumber($('.all-cards'), data.data.totalCards);
                    animateNumber($('.cards-in-month'), data.data.monthlyCards);
                    animateNumber($('.candidates-in-system'), data.data.totalUsers);
                } else {
                    addNotification("Ошибка", "Не удалось загрузить статистику", "Danger");
                }
            } catch(e) {
                addNotification("Ошибка", "Ошибка обработки данных", "Danger");
            }
        },
        error: function() {
            addNotification("Ошибка", "Не удалось загрузить статистику", "Danger");
        }
    });
}

$(document).ready(function() {
    loadStatistics();
    setInterval(loadStatistics, 300000);
});