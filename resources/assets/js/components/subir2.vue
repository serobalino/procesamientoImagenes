<template>
    <div class="container">
        <div class="jumbotron">
            <h1>Elíja una imagen para montar</h1>
            <p>Procesamiento de Imágenes.</p>
            <div class="row"></div>
            <div class="btn-group">
                <a class="btn btn-danger" href="/elegir"> Volver a elegir el color</a>
            </div>

        </div>
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="exito"/>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.css'
    export default {
        components: {
            vueDropzone: vue2Dropzone
        },
        props: ['siguiente'],
        data:()=>({
            dropzoneOptions: {
                url: '/cambiar',
                thumbnailWidth: 200,
                maxFilesize: 5,
                maxFiles:1,
                acceptedFiles:'image/*',
                headers: { 'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN']},
                dictDefaultMessage:"<span class='glyphicon glyphicon-upload'></span> Arrastre o Examine la imagen para montar"
            }
        }),
        methods:{
            exito: function(file, xhr, formData){
                location.replace(this.siguiente);
            }
        }
    }
</script>
<style>
    .dropzone {
        border: 2px dashed #636B6F;
        border-radius: 5px;
        background:   radial-gradient(ellipse at center, rgba(238,238,238,1) 0%, rgba(255,255,255,1) 100%);
    }
    .dz-message>span{
        font-size: 2em;
    }
    .dropzone .dz-message .note {
        font-size: 0.8em;
        font-weight: 200;
        display: block;
        margin-top: 1.4rem;
    }

</style>
