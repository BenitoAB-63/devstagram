import Dropzone from "dropzone";

Dropzone.autoDiscover=false;

const dropzone=new Dropzone("#dropzone",{
    //mensaje por defecto
    dictDefaultMessage: "Sube aquí tu imagen",
    //Formatos permitidos
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    //Habilitamos que el user pueda eliminar la imagen
    addRemoveLinks: true,
    //Texto de borar el archivo
    dictRemoveFile: "Borrar Archivo",
    //Maximo de imagenes
    maxFiles: 1,
    //Que no se pueda subir multiples
    uploadMultiple:false,

    init: function(){
        //Si se ha subido una imagen
        if(document.querySelector('[name="imagen"]').value.trim()){
            //Creamos un objeto
            const imagenPublicada={};
            //Establecemos un tamaño(el que sea)
            imagenPublicada.size=1234;  
            //Establecemos un name=nombre de la imagen
            imagenPublicada.name=document.querySelector('[name="imagen"]').value;

            //Primero indicamos el objeto
            this.options.addedfile.call(this, imagenPublicada);
            //Indicamos cual es la ultima imagen subida
            this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`);
            //Añadimos las clases de dropzone
            imagenPublicada.previewElement.classList.add('dz-success','dz-complete');
        }
    }

});



//Success retornara lo que devolvamos del controlador
dropzone.on('success',function(file, response){
   
    document.querySelector('[name="imagen"]').value=response.imagen;
});

dropzone.on('removedfile',function(){
    document.querySelector('[name="imagen"]').value="";
});