

function corridaCreada(){
    Swal.fire({
        title: "Corrida Creada Correctamente",
        icon: "success",
        draggable: true
    });
}

function corridaEditada(){
    Swal.fire({
        title: "Corrida Editada Correctamente",
        icon: "success",
        draggable: true
    });
}

function corridaEliminada(){
    Swal.fire({
        title: "Corrida Eliminada Correctamente",
        icon: "success",
        draggable: true
    });
}

function eliminarC(id){
    const formulario = document.getElementById('form-eliminar'+id);

    formulario.addEventListener('submit', function(event){
        event.preventDefault();
        console.log("eliminando");
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

function llenarInputs(corrida){   
    const formulario = document.getElementById('formEdit');
    const fecha = document.getElementById('fechaEdit');
    const horario = document.getElementById('horarioEdit');
    const precio = document.getElementById('precioEdit');

    formulario.action = "/corridas/"+corrida['id'];
    fecha.value = corrida['fecha'];
    horario.value = corrida['horario'];
    precio.value = corrida['precio_boleto']
    
}
