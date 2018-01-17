<template>
    <div class="container">
        <div class="jumbotron">
            <h1>Elíja una imágen para continuar</h1>
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
                headers: { 'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'],}
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
