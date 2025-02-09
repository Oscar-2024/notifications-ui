const Notifications = {

    // Peticiones para actualizar estado notificación
    makeRequest: function (url, method) {
        return fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        });
    },

    // Calcular la duración en segundos
    calculateDuration: function (endDate)
    {
        const now = new Date();
        const end = new Date(endDate);
        return Math.floor((end - now) / 1000); // Retornar la duración en segundos
    },

    // Enviar la notificación mostrada al servidor
    sendDisplayedNotification: function (notification)
    {
        this.makeRequest(notification.dataset.notificationsDisplayedRoute, 'POST')
            .then(response => { });
    },


    // Mostrar la notificación
    show: function (notification)
    {
        notification.classList.remove('hide');
        notification.classList.add('show');
    },

    // Obtener los elementos del contador
    getCountdownElements: function (countdown)
    {
        return {
            days: countdown.querySelector('#days'),
            hours: countdown.querySelector('#hours'),
            minutes: countdown.querySelector('#minutes'),
            seconds: countdown.querySelector('#seconds')
        };
    },

    // Función para calcular días, horas, minutos y segundos
    calculateTime: function (timeInSeconds)
    {
        return {
            daysValue: Math.floor(timeInSeconds / (3600 * 24)),
            hoursValue: Math.floor((timeInSeconds / 3600) % 24),
            minutesValue: Math.floor((timeInSeconds % 3600) / 60),
            secondsValue: Math.floor(timeInSeconds % 60)
        };
    },

    // Formatear el tiempo para mostrar dos dígitos
    formatTime: function (value)
    {
        return value < 10 ? '0' + value : value;
    },

    // Cerrar la notificación
    close: function (notificationId)
    {
        const notification = document.getElementById('notification-' + notificationId);
        if (notification) {
            notification.style.display = 'none'; // Ocultar la notificación

            this.makeRequest(notification.dataset.notificationsClosedRoute, 'POST')
                .then(response => { });
        }
    },

    // Iniciar el contador de la notificación
    startCountdown: function (notificationId, duration, displayAfter)
    {
        const countdown = document.getElementById('countdown-' + notificationId);
        const {
            days,
            hours,
            minutes,
            seconds,
        } = this.getCountdownElements(countdown);

        // Es necesario restar el tiempo de espera de la notificación
        let timer = duration - (displayAfter / 1000);

        // Función para actualizar el contenido de los elementos del contador
        const updateCountdownDisplay = () => {
            const {
                daysValue,
                hoursValue,
                minutesValue,
                secondsValue,
            } = this.calculateTime(timer);

            days.textContent = this.formatTime(daysValue);
            hours.textContent = this.formatTime(hoursValue);
            minutes.textContent = this.formatTime(minutesValue);
            seconds.textContent = this.formatTime(secondsValue);
        };

        // Inicializar la visualización del contador
        updateCountdownDisplay();

        const interval = setInterval(() => {
            timer--;

            updateCountdownDisplay(); // Actualizar el conteo

            // Si el temporizador llega a cero, limpiar el intervalo y cerrar la notificación
            if (timer < 0) {
                clearInterval(interval);
                this.close(notificationId); // Cerrar la notificación al finalizar el conteo
            }
        }, 1000); // Actualizar cada segundo
    },

    // Inicializar las notificaciones
    init: function ()
    {
        document.querySelectorAll('.notification').forEach(notification => {
            const {
                displayAfter,
                hasCountdown,
                identifier,
                endDate,
            } = notification.dataset;

            const duration = this.calculateDuration(endDate);

            setTimeout(() => {
                this.show(notification);
                this.sendDisplayedNotification(notification);

                // Iniciar el contador solo si tiene countdown y la duración es mayor a 0
                if (hasCountdown === '1' && duration > 0) {
                    this.startCountdown(identifier, duration, displayAfter);
                }
            }, parseInt(displayAfter));
        });
    },
};

// Inicializar las notificaciones al cargar el DOM
document.addEventListener('DOMContentLoaded', () => Notifications.init());
