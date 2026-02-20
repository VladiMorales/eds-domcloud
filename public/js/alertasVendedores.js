function vendedorCreado(){
    Swal.fire({
        title: "Vendedor Creado Correctamente",
        icon: "success",
        draggable: true
    });
}

function vendedorEditado(){
    Swal.fire({
        title: "Vendedor Editado Correctamente",
        icon: "success",
        draggable: true
    });
}

function vendedorEliminado(){
    Swal.fire({
        title: "Vendedor Eliminado Correctamente",
        icon: "success",
        draggable: true
    });
}

function eliminarV(id){
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

function llenarInputs(vendedor){
    const formulario = document.getElementById('formEdit');
    const nombre = document.getElementById('nombreEdit');

    formulario.action = "/vendedores/"+vendedor['id'];
    nombre.value = vendedor['nombre'];
}