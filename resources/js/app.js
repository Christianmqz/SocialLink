import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if(document.querySelector('#dropzone')) {

    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,

        // Mantiene la imagen en el formulario, aún sin pasar la validación 
        init: function () {
            if(document.querySelector('[name="imagen"]').value.trim()) {
                const imagenPublicada = {};
                imagenPublicada.size = 1010;
                imagenPublicada.name = 
                    document.querySelector('[name="imagen"]').value;
                
                this.options.addedfile.call(this, imagenPublicada);

                this.options.thumbnail.call(this, imagenPublicada, `/build/uploads/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
            }
        }
    });

    // dropzone.on(evento, funcion callback)
    // Los eventos, toman distintos parámetros dependiendo el evento
    /* Ejemplos de eventos: 
    "sending" - Al momento de subir la imagen  
    "success" - Al momento de mandar exitosamente la imagen
    "error" - Al momento de haber un error 
    "removedfile" -  Al momento de eliminar una imagen subida
    */

    dropzone.on("success", function(file, response) {
        // Se agrega el id de la imagen al campo value del formulario en create.blade.php
        document.querySelector('[name="imagen"]').value = response.imagen;
    });

    dropzone.on("removedfile", function() {
        // Limpia el contenido de value, una vez que el usuario elimina la imagen subida
        document.querySelector('[name="imagen"]').value = "";
    });
}

