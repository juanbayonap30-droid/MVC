// Funciones para manejar modales - Diseño Moderno
class ModalManager {
    constructor() {
        this.currentModal = null;
        this.currentData = null; // Para almacenar los datos actuales
        this.init();
    }

    init() {
        // Cerrar modal al hacer click en el fondo
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal') && this.currentModal) {
                this.closeModal();
            }
        });

        // Cerrar modal con tecla ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.currentModal) {
                this.closeModal();
            }
        });
    }

    openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            this.currentModal = modal;
            document.body.style.overflow = 'hidden';
        }
    }

    closeModal() {
        if (this.currentModal) {
            this.currentModal.classList.remove('active');
            this.currentModal = null;
            this.currentData = null;
            document.body.style.overflow = '';
        }
    }

    showInstructorDetails(instructor) {
        const modal = document.getElementById('instructorModal');
        if (!modal) {
            console.error('Modal instructorModal no encontrado');
            return;
        }

        // Almacenar datos actuales
        this.currentData = instructor;

        // Actualizar título del modal
        const titleElement = document.getElementById('modal-inst-id-title');
        if (titleElement) {
            titleElement.textContent = instructor.id.toString().padStart(3, '0');
        }

        // Actualizar contenido del modal con valores seguros
        const setTextContent = (id, value) => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = value || '-';
            } else {
                console.warn(`Elemento ${id} no encontrado`);
            }
        };

        setTextContent('modal-inst-id', instructor.id);
        setTextContent('modal-inst-nombres', instructor.nombres);
        setTextContent('modal-inst-apellidos', instructor.apellidos);
        setTextContent('modal-inst-correo', instructor.correo);
        setTextContent('modal-inst-telefono', instructor.telefono);
        
        // Actualizar centro de formación
        const centroElement = document.getElementById('modal-inst-centro');
        console.log('Elemento centro encontrado:', centroElement);
        console.log('Valor del centro:', instructor.centro);
        if (centroElement) {
            const centroValue = instructor.centro || 'Sin asignar';
            centroElement.textContent = centroValue;
            console.log('Centro asignado al elemento:', centroValue);
        } else {
            console.error('No se encontró el elemento modal-inst-centro');
        }

        this.openModal('instructorModal');
    }

    showFichaDetails(ficha) {
        const modal = document.getElementById('fichaModal');
        if (!modal) return;

        // Almacenar datos actuales
        this.currentData = ficha;

        // Actualizar título del modal
        const titleElement = document.getElementById('modal-fich-id-title');
        if (titleElement) {
            titleElement.textContent = ficha.id.toString().padStart(3, '0');
        }

        // Actualizar contenido del modal
        document.getElementById('modal-fich-id').textContent = ficha.id;
        document.getElementById('modal-prog-id').textContent = ficha.programa_id;
        document.getElementById('modal-inst-lider').textContent = ficha.instructor_lider;
        document.getElementById('modal-fich-jornada').textContent = ficha.jornada;

        this.openModal('fichaModal');
    }

    showAsignacionDetails(asignacion) {
        const modal = document.getElementById('asignacionModal');
        if (!modal) return;

        // Almacenar datos actuales
        this.currentData = asignacion;

        // Actualizar título del modal
        const titleElement = document.getElementById('modal-asig-id-title');
        if (titleElement) {
            titleElement.textContent = asignacion.id.toString().padStart(3, '0');
        }

        // Actualizar contenido del modal
        document.getElementById('modal-asig-id').textContent = asignacion.id;
        document.getElementById('modal-asig-instructor').textContent = asignacion.instructor_id;
        document.getElementById('modal-asig-instructor-nombre').textContent = asignacion.instructor_nombre;
        document.getElementById('modal-asig-fecha-ini').textContent = asignacion.fecha_ini;
        document.getElementById('modal-asig-fecha-fin').textContent = asignacion.fecha_fin;
        document.getElementById('modal-asig-ficha').textContent = asignacion.ficha_id;
        document.getElementById('modal-asig-ambiente').textContent = asignacion.ambiente_id;
        document.getElementById('modal-asig-competencia').textContent = asignacion.competencia_id;

        this.openModal('asignacionModal');
    }

    showAmbienteDetails(ambiente) {
        const modal = document.getElementById('ambienteModal');
        if (!modal) return;

        // Almacenar datos actuales
        this.currentData = ambiente;

        // Actualizar título del modal
        const titleElement = document.getElementById('modal-amb-id-title');
        if (titleElement) {
            titleElement.textContent = ambiente.id.toString().padStart(3, '0');
        }

        // Actualizar contenido del modal
        document.getElementById('modal-amb-id').textContent = ambiente.id;
        document.getElementById('modal-amb-nombre').textContent = ambiente.nombre;
        document.getElementById('modal-amb-sede').textContent = ambiente.sede_id;

        this.openModal('ambienteModal');
    }

    showProgramaDetails(programa) {
        const modal = document.getElementById('programaModal');
        if (!modal) return;

        // Almacenar datos actuales
        this.currentData = programa;

        // Actualizar título del modal
        const titleElement = document.getElementById('modal-prog-codigo-title');
        if (titleElement) {
            titleElement.textContent = programa.codigo.toString().padStart(3, '0');
        }

        // Actualizar contenido del modal
        document.getElementById('modal-prog-codigo').textContent = programa.codigo;
        document.getElementById('modal-prog-denominacion').textContent = programa.denominacion;
        document.getElementById('modal-prog-titulo').textContent = programa.tit_id;
        document.getElementById('modal-prog-tipo').textContent = programa.tipo;

        this.openModal('programaModal');
    }

    showCompetenciaDetails(competencia) {
        const modal = document.getElementById('competenciaModal');
        if (!modal) return;

        // Almacenar datos actuales
        this.currentData = competencia;

        // Actualizar título del modal
        const titleElement = document.getElementById('modal-comp-id-title');
        if (titleElement) {
            titleElement.textContent = competencia.id.toString().padStart(3, '0');
        }

        // Actualizar contenido del modal
        document.getElementById('modal-comp-id').textContent = competencia.id;
        document.getElementById('modal-comp-nombre-corto').textContent = competencia.nombre_corto;
        document.getElementById('modal-comp-horas').textContent = competencia.horas;
        document.getElementById('modal-comp-unidad').textContent = competencia.unidad_competencia;

        this.openModal('competenciaModal');
    }
}

// Inicializar el gestor de modales cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    window.modalManager = new ModalManager();
    
    // Debug: Verificar que el modal manager se inicializó
    console.log('Modal Manager inicializado');
});

// Funciones globales para usar desde HTML
function verDetallesInstructor(id, nombres, apellidos, correo, telefono, centro) {
    console.log('Abriendo modal instructor:', id);
    console.log('Centro de formación recibido:', centro);
    
    // Asegurar que todos los valores sean strings válidos
    const centroValue = (centro && centro.trim() !== '') ? centro : 'Sin asignar';
    
    window.modalManager.showInstructorDetails({
        id: id,
        nombres: nombres || '',
        apellidos: apellidos || '',
        correo: correo || '',
        telefono: telefono || '',
        centro: centroValue
    });
}

function verDetallesFicha(id, programaId, instructorLider, jornada) {
    console.log('Abriendo modal ficha:', id);
    window.modalManager.showFichaDetails({
        id: id,
        programa_id: programaId,
        instructor_lider: instructorLider,
        jornada: jornada
    });
}

function verDetallesAsignacion(id, instructorId, instructorNombre, fechaIni, fechaFin, fichaId, ambienteId, competenciaId) {
    console.log('Abriendo modal asignación:', id);
    window.modalManager.showAsignacionDetails({
        id: id,
        instructor_id: instructorId,
        instructor_nombre: instructorNombre,
        fecha_ini: fechaIni,
        fecha_fin: fechaFin,
        ficha_id: fichaId,
        ambiente_id: ambienteId,
        competencia_id: competenciaId
    });
}

function cerrarModal() {
    console.log('Cerrando modal');
    window.modalManager.closeModal();
}

// Funciones para editar registros
function editarInstructor() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        window.modalManager.closeModal();
        window.location.href = `index.php?controller=instructor&action=edit&id=${id}`;
    } else {
        alert('Error: No se pudo obtener la información del instructor');
    }
}

function editarFicha() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        window.modalManager.closeModal();
        window.location.href = `index.php?controller=ficha&action=edit&id=${id}`;
    } else {
        alert('Error: No se pudo obtener la información de la ficha');
    }
}

function editarAsignacion() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        window.modalManager.closeModal();
        window.location.href = `index.php?controller=asignacion&action=edit&id=${id}`;
    } else {
        alert('Error: No se pudo obtener la información de la asignación');
    }
}

// Funciones para eliminar registros
function eliminarInstructor() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        const nombres = window.modalManager.currentData.nombres;
        const apellidos = window.modalManager.currentData.apellidos;
        
        if (confirm(`¿Está seguro de que desea eliminar al instructor ${nombres} ${apellidos}?\n\nEsta acción no se puede deshacer.`)) {
            window.modalManager.closeModal();
            window.location.href = `index.php?controller=instructor&action=delete&id=${id}`;
        }
    } else {
        alert('Error: No se pudo obtener la información del instructor');
    }
}

function eliminarFicha() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        
        if (confirm(`¿Está seguro de que desea eliminar la ficha ${id}?\n\nEsta acción no se puede deshacer.`)) {
            window.modalManager.closeModal();
            window.location.href = `index.php?controller=ficha&action=delete&id=${id}`;
        }
    } else {
        alert('Error: No se pudo obtener la información de la ficha');
    }
}

function eliminarAsignacion() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        
        if (confirm(`¿Está seguro de que desea eliminar la asignación ${id}?\n\nEsta acción no se puede deshacer.`)) {
            window.modalManager.closeModal();
            window.location.href = `index.php?controller=asignacion&action=delete&id=${id}`;
        }
    } else {
        alert('Error: No se pudo obtener la información de la asignación');
    }
}
// Funciones para mostrar detalles de nuevos modelos
function verDetallesAmbiente(id, nombre, sedeId) {
    console.log('Abriendo modal ambiente:', id);
    window.modalManager.showAmbienteDetails({
        id: id,
        nombre: nombre,
        sede_id: sedeId
    });
}

function verDetallesPrograma(codigo, denominacion, titId, tipo) {
    console.log('Abriendo modal programa:', codigo);
    window.modalManager.showProgramaDetails({
        codigo: codigo,
        denominacion: denominacion,
        tit_id: titId,
        tipo: tipo
    });
}

function verDetallesCompetencia(id, nombreCorto, horas, unidadCompetencia) {
    console.log('Abriendo modal competencia:', id);
    window.modalManager.showCompetenciaDetails({
        id: id,
        nombre_corto: nombreCorto,
        horas: horas,
        unidad_competencia: unidadCompetencia
    });
}

// Funciones para editar nuevos modelos
function editarAmbiente() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        window.modalManager.closeModal();
        window.location.href = `index.php?controller=ambiente&action=edit&id=${id}`;
    } else {
        alert('Error: No se pudo obtener la información del ambiente');
    }
}

function editarPrograma() {
    if (window.modalManager && window.modalManager.currentData) {
        const codigo = window.modalManager.currentData.codigo;
        window.modalManager.closeModal();
        window.location.href = `index.php?controller=programa&action=edit&id=${codigo}`;
    } else {
        alert('Error: No se pudo obtener la información del programa');
    }
}

function editarCompetencia() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        window.modalManager.closeModal();
        window.location.href = `index.php?controller=competencia&action=edit&id=${id}`;
    } else {
        alert('Error: No se pudo obtener la información de la competencia');
    }
}

// Funciones para eliminar nuevos modelos
function eliminarAmbiente() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        const nombre = window.modalManager.currentData.nombre;
        
        if (confirm(`¿Está seguro de que desea eliminar el ambiente "${nombre}"?\n\nEsta acción no se puede deshacer.`)) {
            window.modalManager.closeModal();
            window.location.href = `index.php?controller=ambiente&action=delete&id=${id}`;
        }
    } else {
        alert('Error: No se pudo obtener la información del ambiente');
    }
}

function eliminarPrograma() {
    if (window.modalManager && window.modalManager.currentData) {
        const codigo = window.modalManager.currentData.codigo;
        const denominacion = window.modalManager.currentData.denominacion;
        
        if (confirm(`¿Está seguro de que desea eliminar el programa "${denominacion}"?\n\nEsta acción no se puede deshacer.`)) {
            window.modalManager.closeModal();
            window.location.href = `index.php?controller=programa&action=delete&id=${codigo}`;
        }
    } else {
        alert('Error: No se pudo obtener la información del programa');
    }
}

function eliminarCompetencia() {
    if (window.modalManager && window.modalManager.currentData) {
        const id = window.modalManager.currentData.id;
        const nombreCorto = window.modalManager.currentData.nombre_corto;
        
        if (confirm(`¿Está seguro de que desea eliminar la competencia "${nombreCorto}"?\n\nEsta acción no se puede deshacer.`)) {
            window.modalManager.closeModal();
            window.location.href = `index.php?controller=competencia&action=delete&id=${id}`;
        }
    } else {
        alert('Error: No se pudo obtener la información de la competencia');
    }
}