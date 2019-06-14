<?php

App::uses('AppController', 'Controller');
App::import('Component','UsuariosUtilComponent');
App::import('Model', 'Usuario');
/**
 * @property Mensaje $Mensaje
 * @property UsuariosUtilComponent $UsuariosUtil
 */

class MensajeWsController extends AppController{
    //Componente para solicitudes HTTP REST - recibe y realiza acción
    //permite cambio de vista a tipo de contenido JSON
    public $components = array('RequestHandler','UsuariosUtil');
    public $helpers = array ('Html','Form');
    public $uses = array('Usuario');

    /**
     * Servicio edit recibe email
     * Funcion que guarda el estado del mensaje en el servidor web
     * @param $id
     * @throws Exception
     * @return JsonSerializable
     */
    public function edit($id){
        $UsuariosUtil = new UsuariosUtilComponent();
        $acercadelusuario= $UsuariosUtil->consultarUsuario($id);
        if($acercadelusuario['existe']) {
            $this->Mensaje->usuario_id = $acercadelusuario['usuario_id'];

            if ($this->Mensaje->save($this->request->data)) {
                $response['error'] = false;
                $response['message'] = 'Estado del mensaje almacenado en el servidor web';

            } else {
                $response['error'] = true;
                $response['message'] = 'Error. No fue posible guardar el estado del mensaje';
            }
        }else{
            $response['error'] = true;
            $response['message'] = 'Error. Enviando a guardar el estado del mensaje.';
        }

       $this->set(array(
           'response' => $response,
           '_serialize' => 'response'
       ));
    }

}