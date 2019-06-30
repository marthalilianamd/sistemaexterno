<?php

App::uses('AppController', 'Controller');
App::import('Component','UsuariosUtilComponent');
App::import('Model', 'Mensaje');
App::import('Model', 'Usuario');
/**
 * @property Mensaje $Mensaje
 * @property Mensaje $Usuario
 * @property UsuariosUtilComponent $UsuariosUtil
 */

class MensajeswsController extends AppController{
    //Componente para solicitudes HTTP REST - recibe y realiza acción
    //permite cambio de vista a tipo de contenido JSON
    public $components = array('RequestHandler','UsuariosUtil');
    public $helpers = array ('Html','Form');
    public $uses = array('Mensaje','Usuario');

    /**
     * Servicio edit recibe email
     * Funcion que guarda el estado de (enviado) del mensaje  en el servidor web
     * @param $id
     * @throws Exception
     * @return JsonSerializable
     */
    public function edit($id){
        $UsuariosUtil = new UsuariosUtilComponent();
        $acercadelusuario= $UsuariosUtil->consultarUsuario($id);
        $acercadelmensaje = $UsuariosUtil->consultarRegistroMensaje($acercadelusuario['idusuario']);

        if($acercadelmensaje['existe']) {
            $this->request->data['Mensaje']['mensaje_id'] = $acercadelmensaje['idmensaje'];
            $this->request->data['Mensaje']['usuario_id'] = $acercadelusuario['idusuario'];
            $this->request->data['Mensaje']['estadosms'] = $this->request->data['estadosms'];

            $filtro = array(
                'conditions' => array('Mensaje.mensaje_id' => $acercadelmensaje['idmensaje']),
                'fields' => array('Mensaje.usuariodestino_id',)
            );
            $sobreelmensaje = $this->mensaje->find('first', $filtro);
            $this->request->data['Mensaje']['usuariodestino_id']= $sobreelmensaje['Mensaje']['usuariodestino_id'];

            if ($this->Mensaje->save($this->request->data)) {
                $response['error'] = false;
                $response['message'] = 'Estado SMS guardado en el servidor web';
            } else {
                $response['error'] = true;
                $response['message'] = 'No se guardó Estado SMS en el servidor web';
            }
        }else{
            $response['error'] = true;
            $response['message'] = 'Error. Enviando a guardar el estado del mensaje SMS';
        }
        $this->set(array(
            'response' => $response,
            '_serialize' => 'response'
        ));
    }
}