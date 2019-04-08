<?php

App::uses('AppController','Controller');

/**
 * @property Usuario $Usuario
 */

class UsuariosWsController extends AppController
{
    public $uses = array('Usuario');
    public $helpers = array('Html', 'Form');
    //manejador de solicitudes HTTP REST - recibe y realiza acción
    public $components = array('RequestHandler');

    public function index(){
        $usuarios = $this->Usuario->find('all');
        $this->set(array(
            'usuarios' => $usuarios,
            '_serialize' => array('usuarios')
        ));
    }

    public function view($id){
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalido usuario'));
        }
        $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
        $this->set(array(
            'usuario' => $this->Usuario->find('first', $options),
            '_serialize' => array('usuario')
        ));
    }

    public function add(){
        $message = '';
        $this->Usuario->create();
        try {
            if ($this->Usuario->save($this->request->data)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        } catch (Exception $e) {
            new RuntimeException('Error en función "save" creando usuario');
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    /**
     * Servicio
     * Funcion que actualiza el fcm_registro_id de un usuario
     * @param $id
     * @throws Exception
     */
   public function edit($id){
       $this->Usuario->id = $id;
       if ($this->Usuario->save($this->request->data)) {
           $message = 'Saved';
       } else {
           $message = ' Error';
       }
       $this->set(array(
           'message' => $message,
           '_serialize' => array('message')
       ));
   }


    /**
     * Servicio de edicion de usuario
     * Funcion que actualiza los datos de un usuario
     * @param $id
     * @throws Exception

    public function edit($id){
        if (!$this->Usuario->exists($id)) {
            throw new NotFoundException(__('Invalid usuario'));
        }
        if ($this->request->is(array('usuario','put'))) {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->Usuario->find('first', $options);
            $this->Usuario->id = $id;
            if ($this->Usuario->save($this->request->data)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
*/


    public function delete($id) {
        if ($this->Usuario->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}