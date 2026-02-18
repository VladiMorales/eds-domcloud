function corridaRealizada(){
    Swal.fire({
        title: "Error",
        text:"No es posible realizar cambios a ese boleto",
        icon: "error",
        draggable: true
    });
}

function boletoNoEncontrado(){
    Swal.fire({
        title: "Error",
        text:"ID de Boleto no encontrado",
        icon: "error",
        draggable: true
    });
}

function boletoEliminado(){
    Swal.fire({
        title: "Realizado",
        text:"Boletos y venta eliminados correctamente",
        icon: "success",
        draggable: true
    });
}

function cancelarV(){
    const formulario = document.getElementById('form-cancelar');

    formulario.addEventListener('submit', function(event){
        event.preventDefault();        
        Swal.fire({
            title: "¿Estas seguro que quiere cancelar?",
            text: "No podrás revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, Cancelar",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
}