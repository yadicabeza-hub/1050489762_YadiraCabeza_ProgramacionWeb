<section>
    <header class="mb-4">
        <h3 class="mb-2" style="font-family: 'Playfair Display', serif; color: #dc3545; font-size: 1.5rem;">
            <i class="bi bi-exclamation-triangle me-2"></i>Eliminar Cuenta
        </h3>
        <p class="text-muted mb-0">
            Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán permanentemente. 
            Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.
        </p>
    </header>

    <button type="button" 
            class="btn btn-danger" 
            style="background: linear-gradient(135deg, #FF6B6B 0%, #DC3545 100%); border: none; color: white; padding: 0.6rem 1.5rem; border-radius: 25px; font-weight: 500;"
            data-bs-toggle="modal" 
            data-bs-target="#deleteAccountModal"
            id="deleteAccountButton">
        <i class="bi bi-trash me-1"></i>Eliminar Cuenta
    </button>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none; overflow: hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #FFB3BA 0%, #FF9AA2 100%); color: #8B0000; border: none;">
                    <h5 class="modal-title" id="deleteAccountModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Confirmar Eliminación de Cuenta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf
                    @method('DELETE')
                    
                    <div class="modal-body p-4">
                        <div class="alert alert-warning alert-spa mb-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>¡Atención!</strong> Esta acción no se puede deshacer.
                        </div>
                        <p class="mb-3">
                            ¿Estás segura de que deseas eliminar tu cuenta?
                        </p>
                        <p class="text-muted small mb-4">
                            Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán permanentemente. 
                            Esto incluye:
                        </p>
                        <ul class="text-muted small mb-4">
                            <li>Tu perfil y datos personales</li>
                            <li>Tu historial de sesiones</li>
                            <li>Todos los datos asociados a tu cuenta</li>
                        </ul>
                    </div>
                    
                    <div class="modal-footer" style="border: none; background: #FFF8F3;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 25px; padding: 0.5rem 1.5rem;">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger" style="background: linear-gradient(135deg, #FF6B6B 0%, #DC3545 100%); border: none; border-radius: 25px; padding: 0.5rem 1.5rem;">
                            <i class="bi bi-trash me-1"></i>Eliminar Cuenta Permanentemente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function() {
    'use strict';
    
    function waitForBootstrap(callback) {
        if (typeof bootstrap !== 'undefined') {
            callback();
        } else {
            setTimeout(function() {
                waitForBootstrap(callback);
            }, 100);
        }
    }
    
    function initDeleteModal() {
        waitForBootstrap(function() {
            var deleteModalElement = document.getElementById('deleteAccountModal');
            if (!deleteModalElement) return;
            
            // Asegurar que el botón abre el modal correctamente
            var deleteButton = document.getElementById('deleteAccountButton');
            if (deleteButton) {
                deleteButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    var modal = bootstrap.Modal.getOrCreateInstance(deleteModalElement, {
                        backdrop: true,
                        keyboard: true
                    });
                    modal.show();
                });
            }
        });
    }
    
    // Ejecutar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDeleteModal);
    } else {
        initDeleteModal();
    }
})();
</script>
@endpush
