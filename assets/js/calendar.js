// Calendario Simple - SENA
(function() {
    'use strict';
    
    console.log('=== CALENDARIO INICIANDO ===');
    
    let currentDate = new Date();
    let assignments = [];
    
    // Esperar a que el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        console.log('Inicializando calendario...');
        
        // Cargar datos
        if (window.asignacionesData) {
            assignments = window.asignacionesData;
            console.log('Asignaciones cargadas:', assignments.length);
        }
        
        // Renderizar calendario
        renderCalendar();
        
        // Setup event listeners
        setupEventListeners();
        
        console.log('Calendario inicializado correctamente');
    }
    
    function setupEventListeners() {
        const prevBtn = document.getElementById('prev-month');
        const nextBtn = document.getElementById('next-month');
        const todayBtn = document.getElementById('today-btn');
        const cancelBtn = document.getElementById('cancel-assignment');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });
        }
        
        if (todayBtn) {
            todayBtn.addEventListener('click', function() {
                currentDate = new Date();
                renderCalendar();
            });
        }
        
        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeModal);
        }
    }
    
    function renderCalendar() {
        console.log('Renderizando calendario...');
        
        const calendarGrid = document.getElementById('calendar-grid');
        if (!calendarGrid) {
            console.error('No se encontró calendar-grid');
            return;
        }
        
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        // Actualizar título
        const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                           'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const titleEl = document.getElementById('calendar-month-year');
        if (titleEl) {
            titleEl.textContent = monthNames[month] + ' ' + year;
        }
        
        // Calcular días
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDayOfWeek = firstDay.getDay();
        
        // Construir HTML
        let html = '';
        
        // Encabezados
        html += '<div class="calendar-weekdays">';
        const dayNames = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
        for (let i = 0; i < dayNames.length; i++) {
            html += '<div class="calendar-weekday">' + dayNames[i] + '</div>';
        }
        html += '</div>';
        
        // Días
        html += '<div class="calendar-days">';
        
        // Espacios vacíos
        for (let i = 0; i < startingDayOfWeek; i++) {
            html += '<div class="calendar-day empty"></div>';
        }
        
        // Días del mes
        const today = new Date();
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const isToday = date.toDateString() === today.toDateString();
            const dateStr = formatDate(date);
            
            let classes = 'calendar-day';
            if (isToday) classes += ' today';
            
            html += '<div class="' + classes + '" onclick="openAssignmentModal(\'' + dateStr + '\')">';
            html += '<span class="day-number">' + day + '</span>';
            html += '</div>';
        }
        
        html += '</div>';
        
        calendarGrid.innerHTML = html;
        console.log('Calendario renderizado');
        
        updateStats();
    }
    
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return year + '-' + month + '-' + day;
    }
    
    function updateStats() {
        const totalEl = document.getElementById('stat-total');
        const activeEl = document.getElementById('stat-active');
        
        if (totalEl) totalEl.textContent = assignments.length;
        if (activeEl) activeEl.textContent = '0';
    }
    
    // Funciones globales
    window.openAssignmentModal = function(dateStr) {
        console.log('Abriendo modal para:', dateStr);
        const modal = document.getElementById('assignmentModal');
        const dateDisplay = document.getElementById('modal-date-display');
        const dateInput = document.getElementById('asig_fecha_ini');
        
        if (modal) {
            modal.style.display = 'flex';
        }
        if (dateDisplay) {
            dateDisplay.textContent = 'Fecha: ' + dateStr;
        }
        if (dateInput) {
            dateInput.value = dateStr + 'T08:00';
        }
    };
    
    function closeModal() {
        const modal = document.getElementById('assignmentModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    
    window.closeModal = closeModal;
    
    console.log('=== CALENDARIO CARGADO ===');
})();
