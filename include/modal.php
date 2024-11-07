
<!-- Vertically centered modal -->
<div class="modal modal-dialog modal-dialog-centered" tabindex="-1" id="miModalAplicar">
    <div class="modal-dialog" style="">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Sube tu CV</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="miboton1">Enviar</button>
        </div>
        </div>
    </div>
</div>
<!-- JavaScript para el botón "Enviar" -->
<script>
document.getElementById('miboton1').addEventListener('click', function() {
    // Mostrar mensaje en ventana emergente
    alert("Has aplicado a esta oferta de trabajo");

    // Cerrar el modal después de mostrar el mensaje
    var modal = bootstrap.Modal.getInstance(document.getElementById('miModalAplicar'));
    modal.hide();
});
</script>