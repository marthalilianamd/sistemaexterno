<?php

App::uses('AppController', 'Controller');
App::import('Component','UsuariosUtilComponent');
App::import('Model', 'Usuario');
/**
 * @property Usuario $Usuario
 * @property UsuariosUtilComponent $UsuariosUtil
 */

class UsuariosWsController extends AppController{
    //Componente para solicitudes HTTP REST - recibe y realiza acción
    //permite cambio de vista a tipo de contenido JSON
    public $components = array('RequestHandler','UsuariosUtil');
    public $helpers = array ('Html','Form');
    public $uses = array('Usuario');

    /**
     * Servicio edit recibe email
     * Funcion que guarda el registro_id del movil del usuario en la sistema web
     * @param $id
     * @throws Exception
     * @return JsonSerializable
     */
    public function edit($id){
        $UsuariosUtil = new UsuariosUtilComponent();
        $acercadelusuario= $UsuariosUtil->consultarUsuario($id);
        $tokenmovil = $UsuariosUtil->tokenMovil($id);
        if($acercadelusuario['existe']){
                $this->Usuario->id = $acercadelusuario['idusuario'];
                //Actualizacion estado del token a vigente cuando se registra desde la APP
                //$this->Usuario->estadotoken = 'Vigente';
                if ($this->Usuario->save($this->request->data)) {
                    $response['error'] = false;
                    $response['message'] = 'El movil se ha registrado en el sistema web exitosamente';
                }else{
                    $response['error'] = true;
                    $response['message'] = 'El movil ya fue registrado. Por favor inicie sesión con su email y contraseña.';
                }
        }else{
            $response['error'] = true;
            $response['message'] = 'El email no existe. Solicitar credenciales al administrador';
        }
       $this->set(array(
           'response' => $response,
           '_serialize' => 'response'
       ));
    }

    /**
     * Servicio view recibe email
     * Funcion retorna contenido de email, contraseña y token después de consultar base de datos del sistema web
     * @param $id
     * @throws Exception
     * @return JsonSerializable
     */
    public function view($id){
        $poscomodin =strpos($id,"-");
        $email = substr($id,0,$poscomodin);
        $contrasena = substr($id,$poscomodin+1,strlen($id)-1);

        $UsuariosUtil = new UsuariosUtilComponent();
        $acercadelusuario= $UsuariosUtil->consultarUsuario($email);
        $contrasenacoincide = $UsuariosUtil->verificarContrasena($email,$contrasena);
        $tokenmovil = $UsuariosUtil->tokenMovil($email);
        if($acercadelusuario['existe']){
            if(!$tokenmovil['vacio']) {
                $response['email'] = $acercadelusuario['email'];
                $response['igualcontrasena'] = $contrasenacoincide;
                $response['token'] = $tokenmovil['token'];
            }else{
                $response['email'] = $acercadelusuario['email'];
                $response['igualcontrasena'] = $contrasenacoincide;
                $response['token'] = $tokenmovil['token'];
            }
        }else {
            $response['email'] = $acercadelusuario['email'];
            $response['igualcontrasena'] = $contrasenacoincide;
            $response['token'] = $tokenmovil['token'];
        }
        $this->set(array(
            'response' => $response,
            '_serialize' =>  'response'
        ));
    }
}