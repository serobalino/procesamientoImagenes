<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SubirArchivo extends Controller{
    public function index(){
        return view('subir');
    }


    /**
     * function que sube una imagen
     * **/

    public function subir(Request $datos){
        $nombre     =   session()->getId();
        $archivo    =   $datos->file('file');
        $save       =   Storage::disk('img')->put($nombre,File::get($archivo));
        return ([true]);
    }

    /**
     * debuelve la iamgen guardada
     *
    */
    public function imagen(){
        $nombre     =   session()->getId();
        $existe     =   Storage::disk('img')->exists($nombre);
        if($existe){
            $archivo    =   Storage::disk('img')->get($nombre);
            return Image::make($archivo)->response();
            exit;
        }else{
            return [false];
        }

    }

    public function elegir(){
        return view('elegir');
    }


    public function colorPix($x=0,$y=0){
        $nombre     =   session()->getId();

        $direccion  = storage_path('imagenes')."\\";

        $img    = Image::make($direccion.$nombre);
        return($img->pickColor($x,$y,'hex'));
    }

    /**
     * funcion que genera la imagen con el color remplazado
     * Recibe el volor en hexadecima a cambiar y el que hay q buscar
     *
     * y el valor de la tolerancia
     *
     * y guarda en jpg el resultado
     *
    */

    public function procesarCambio(Request $datos){
        $nombre     =   session()->getId();
        $nombre2    =   "2 $nombre";
        $direccion  = storage_path('imagenes')."\\";
        $extencion  =   ".jpg";


        $img    = Image::make($direccion.$nombre);
        $img->save($direccion.$nombre.$extencion);

        $alto   = (int)$img->height();
        $ancho  = (int)$img->width();

        $buscar     =   $datos->buscar;
        $remplazar  =   $datos->remplazar;
        $cantidad   =   $datos->valor;
        $saltos =   111413;

        $buscaDec   =   hexdec($buscar);
        for ($i = 0; $i < $ancho; $i++) {
            for ($j = 0; $j < $alto; $j++) {
                $actual =   $img->pickColor($i,$j,'int');
                if($actual<=$buscaDec+$saltos*$cantidad && $actual>=$buscaDec-$saltos*$cantidad)
                    $img->pixel($remplazar, $i,$j);
            }
        }
        $img->save($direccion.$nombre2.$extencion);

        return (['val'=>true]);
    }

    /**
     *
     * Devuelve la imagen cambiada de color
    **/

    public function imagen2(){
        $nombre     =   session()->getId();
        $existe     =   Storage::disk('img')->exists("2 $nombre.jpg");
        if($existe){
            $archivo    =   Storage::disk('img')->get("2 $nombre.jpg");
            return Image::make($archivo)->response();
            exit;
        }else{
            return [false];
        }
    }

    public function cambiar(){
        return view('cambiar');
    }



    public function subirMontado(Request $datos){
        $nombre     =   session()->getId();
        $archivo    =   $datos->file('file');
        $save       =   Storage::disk('img')->put("3 $nombre",File::get($archivo));

        $img = Image::make(storage_path('imagenes').'\\2 '.session()->getId().'.jpg');
        $img2= Image::make(storage_path('imagenes')."\\3 $nombre");
        $img2->resize(($img->width())/2, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->insert($img2,'top-right');
        $img->save(storage_path('imagenes')."\\res $nombre");
        return ([true]);
    }

    public function imagen3(){
        $nombre     =   session()->getId();
        $existe     =   Storage::disk('img')->exists("res $nombre");
        if($existe){
            $archivo    =   Storage::disk('img')->get("res $nombre");
            return Image::make($archivo)->response();
            exit;
        }else{
            return [false];
        }
    }


    public function resultado(){
        $imagenes['1']  =   route('imagen');
        $imagenes['2']  =   route('imagen2');
        $imagenes['3']  =   route('imagen3');

        return view('resultado',['imagenes'=>$imagenes]);
    }
}
