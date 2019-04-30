<?php

App::uses('AppController', 'Controller');
App::import('Component','Usuariosutil');
App::import('Model', 'Usuario');
/**
 * @property Usuario $Usuario
 * @property UsuariosUtilComponent $Usuariosutil
 */

class UsuariosWsController extends AppController{
    //Componente para solicitudes HTTP REST - recibe y realiza acción
    //permite cambio de vista a tipo de contenido JSON
    public $components = array('RequestHandler','Usuariosutil');
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
        $Usuariosutil = new UsuariosUtilComponent();
        $acercadelusuario= $Usuariosutil->existeUsuario($id);
        $tokenmovil = $Usuariosutil->tokenMovil($id);
        if($acercadelusuario['existe']){
            //debug('vacio token? '.$vaciotoken);
            /*if($tokenmovil['vacio']) {*/
                $this->Usuario->id = $acercadelusuario['idusuario'];
                //debug($this->request->data);
                if ($this->Usuario->save($this->request->data)) {
                    //debug($this->Usuario->save($this->request->data));
                    $response['error'] = false;
                    $response['message'] = 'El movil se ha registrado en el sistema web exitosamente';
                /*} else {
                    $response['error'] = true;
                    $response['message'] = 'Error al actualizar. El movil no fue registrado. Intentar de nuevo.';
                } */
            }else{
                $response['error'] = true;
                $response['message'] = 'El movil ya fue registrado. Por favor inicie sesion con su email y password.';
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
     * Funcion retorna token si existe en la base de datos del sistema web
     * @param $id
     * @throws Exception
     * @return JsonSerializable
     */
    public function view($id){
        $Usuariosutil = new UsuariosUtilComponent();
        $acercadelusuario= $Usuariosutil->existeUsuario($id);
        $tokenmovil = $Usuariosutil->tokenMovil($id);
        if($acercadelusuario['existe']){
            if(!$tokenmovil['vacio']) {
                $response['token'] = $tokenmovil['token'];
            }else{
                $response['token'] = "";
            }
            $this->set(array(
                'response' => $response,
                '_serialize' => 'response'
            ));
        }
    }
}