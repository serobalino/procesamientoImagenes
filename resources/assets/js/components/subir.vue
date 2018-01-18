<template>
    <div class="container">
        <div class="jumbotron">
            <h1>Elíja una imagen para continuar</h1>
            <p>Procesamiento de Imágenes.</p>
        </div>
        <div v-if="err!==''">
            <div class="alert alert-danger">
                {{err}} <a href="#limpiar" v-on:click="limpiar">Limpiar</a>
            </div>
        </div>

        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="exito" @vdropzone-error="errores"/>
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
            err:'',
            dropzoneOptions: {
                url: '/',
                thumbnailWidth: 200,
                maxFilesize: 0.1,
                maxFiles:1,
                acceptedFiles:'image/*',
                headers: { 'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN']},
                dictDefaultMessage:"<span class='glyphicon glyphicon-upload'></span> Arrastre o Examine la Imagen"
            }
        }),
        methods:{
            exito: function(file, xhr, formData){
                location.replace(this.siguiente);
            },
            errores:function(file, message, xhr){
                this.err=message;
            },
            limpiar:function(){
                this.$refs.myVueDropzone.removeAllFiles();
                this.err='';
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
