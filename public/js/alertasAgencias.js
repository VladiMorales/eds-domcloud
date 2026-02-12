function agenciaCreada(){
    Swal.fire({
        title: "Agencia Creada Correctamente",
        icon: "success",
        draggable: true
    });
}

function agenciaEditada(){
    Swal.fire({
        title: "Agencia Editada Correctamente",
        icon: "success",
        draggable: true
    });
}

function agenciaEliminada(){
    Swal.fire({
        title: "Agencia Eliminada Correctamente",
        icon: "success",
        draggable: true
    });
}

function eliminarA(id){
    const formulario = document.getElementById('form-eliminar'+id);

    formulario.addEventListener('submit', function(event){
        event.preventDefault();        
        Swal.fire({
            title: "¿Estas seguro que quiere eliminar?",
            text: "No podrás revertir esta acción",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, Eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
}

function llenarInputs(agencia){
    const formulario = document.getElementById('formEdit');
    const nombre = document.getElementById('nombreEdit');

    formulario.action = "/agencias/"+agencia['id'];
    nombre.value = agencia['nombre'];
}