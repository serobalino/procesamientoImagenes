<template>
    <div class="container">
        <div class="jumbotron">
            <h1>Elíja una imágen para continuar</h1>
            <p>Procesamiento de Imágenes.</p>
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
                url: '/',
                thumbnailWidth: 200,
                maxFilesize: 0.05,
                maxFiles:1,
                acceptedFiles:'image/*',
                headers: { 'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'],}
            }
        }),
        methods:{
            exito: function(file, xhr, formData){
                location.replace(this.siguiente);
            }
        }
    }
</script>
