<template>
    <div class="container" :style="'background-color: '+buscar">
        <div class="jumbotron">
            <h1>Cambio de color</h1>
            <p>Procesamiento de Imágenes.</p>
            <span>Marque en la imagen el color que desee</span>
            <div class="row"></div>
            <div class="btn-group">
                <a class="btn btn-danger" href="/"> Volver a subir la iamgen</a>
            </div>
        </div>
        <br>
        <div class="container-fluid" :style="'background-color: '+colores.hex">
            <div v-if="mensaje!==''">
                <div class="alert alert-danger">
                    {{mensaje}}
                </div>
            </div>
            <div class="col-md-6">
                Color
                <slider-picker v-model="colores" />
            </div>
            <div class="col-md-6">
                Tolerancia
                <vue-slider v-model="valor" :min="-5" :max="5"></vue-slider>
            </div>
            <div class="col-md-12">
                <br>
                    <img :src="imagen" alt="imagen subida" class="img-responsive img-thumbnail center-block" style="cursor: crosshair;"/>
                <br>
            </div>
        </div>
        <br>
        <button class="btn btn-block btn-success" v-on:click="next" v-if="ver">
            Siguiente
        </button>
        <br><br><br>
    </div>
</template>

<script>
    import {Slider} from 'vue-color';
    import vueSlider from 'vue-slider-component';
    export default {
        components: {
            'slider-picker': Slider,vueSlider
        },
        props: ['imagen','siguiente'],
        data:()=>({
            colores:0,
            valor:0,
            buscar:'#fff',
            mensaje:'',
            ver:false,
        }),
        watch:{
            buscar:function(val){
                if(this.colores!==0 && val!=='#fff'){
                    this.ver=true;
                }
            },
            colores:function(val){
                if(val!==0 && this.buscar!=='#fff'){
                    this.ver=true;
                }
            }
        },
        methods:{
            next:function(){
                axios.post('/elegir',{
                    'remplazar':this.colores.hex,
                    'valor':this.valor,
                    'buscar':this.buscar,
                }).then(response =>{
                    this.ver=false;
                    if(response.data.val){
                        location.replace(this.siguiente);
                    }else{
                        this.mensaje="Ha ocurrido un error vuelva a subir una imágen."
                    }
                }).catch(e => {
                    console.error(e);
                });
            }

        },
        mounted(){
            let vm=this;
            $('img').click(function(e) {
                let offset = $(this).offset();
                let X = parseInt((e.pageX - offset.left));
                let Y = parseInt((e.pageY - offset.top));
                axios.get('/elegir/'+X+'/'+Y).then(response =>{
                    vm.buscar=response.data;
                }).catch(e => {
                    console.error(e);
                });
            });
        }
    }
</script>

