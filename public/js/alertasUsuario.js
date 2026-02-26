

function usuarioCreado(){
    Swal.fire({
        title: "Usuario Creado Correctamente",
        icon: "success",
        draggable: true
    });
}

function usuarioEditado(){
    Swal.fire({
        title: "Usuario Editado Correctamente",
        icon: "success",
        draggable: true
    });
}

function usuarioEliminado(){
    Swal.fire({
        title: "Usuario Eliminado Correctamente",
        icon: "success",
        draggable: true
    });
}

function eliminarU(id){
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


function llenarInputs(usuario){    
    const formulario = document.getElementById('formEdit');
    const name = document.getElementById('nameEdit');
    const username = document.getElementById('usernameEdit');
    const tipo = document.getElementById('tipoEdit');
    const comision = document.getElementById('comisionEdit');

    formulario.action = "/usuarios/"+usuario['id'];
    name.value = usuario['name'];
    username.value = usuario['username'];     
    tipo.value = usuario['tipo'];
    comision.value = usuario['comision']    
}