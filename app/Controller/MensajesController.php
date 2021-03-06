<?php
App::uses('AppController', 'Controller');
App::uses('Component', 'Controller');
App::import('Component','UsuariosUtilComponent');
App::import('Model', 'Usuario');
/**
 * Mensajes Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 * @property FirebaseComponent $Firebase
 * @property FlashComponent $Flash
 * @property AuthComponent $Auth
 * @property UsuariosUtilComponent $UsuariosUtil
 */
class MensajesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array( 'Paginator','Firebase','Flash', 'UsuariosUtil','RequestHandler');

    /** @var usuario */
    private $Usuario;

    //public $uses = array('Usuario');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mensaje->recursive = 0;
		$this->set('mensajes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Mensaje no existe'));
		}
		$options = array('conditions' => array('Mensaje.' . $this->Mensaje->primaryKey => $id));
		$this->set('mensaje', $this->Mensaje->find('first', $options));
	}

    /**
     * add method
     *
     * @return CakeResponse
     * @throws Exception
     */
	public function add() {
		if ($this->request->is('post')) {
            try {
                $datos = $this->request->data;
                $registro_movil = $this->getFcmRegistro($datos['Mensaje']['usuario_id']);
                $numero_movil = $this->getmovil($datos['usuarios']['usuario_id']);
                try{
                    $respuesta = $this->Firebase->envioUnicoUsuario($registro_movil, $datos, $numero_movil);
                } catch (Exception $e) {
                    new RuntimeException('Mensaje no enviado a usuario. '.$e);
                }
                if(isset($respuesta['Ok'])) {
                    $idusuariomensaje= $this->request->data['usuarios']['usuario_id'];
                    $datosusuario = $this->UsuariosUtil->obtenerDatosUsuario($idusuariomensaje);
                    if($respuesta['respuestaenvio']->{"success"} !== 0) {
                        //que el mensaje fue enviado con token vigente
                        $this->Mensaje->usuariodestino_id = $datos['usuarios']['usuario_id'];
                        $this->Mensaje->create();
                        if ($this->Mensaje->save($this->request->data)) {
                            $this->Mensaje->saveField('usuariodestino_id', $datos['usuarios']['usuario_id']);
                            $this->Mensaje->saveField('estado', 'Entregado al móvil autorizado de enviar SMS');
                            $idusuariodestino = $datos['usuarios']['usuario_id'];
                            $this->set(compact( 'idusuariodestino'));
                            $this->Flash->success(__("Mensaje enviado exitosamente al móvil autorizado ". $datosusuario['Usuario']['movil_numero']));
                            $this->UsuariosUtil->actualizarEstadoTokenUsuario($idusuariomensaje,'Vigente');
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Mensaje->saveField('estado', 'No entregado al móvil autorizado de enviar SMS');
                            $this->Flash->set(__('El mensaje no pudo ser guardado en base de datos de este sistema externo'));
                            return $this->redirect(array('action' => 'index'));
                        }
                    }else
                        if($respuesta['respuestaenvio']->{"results"}[0]->{"error"} =='MissingRegistration'){
                            $this->Flash->set(__("Móvil sin token. No está registrado en la App. Mensaje no enviado al ". $datosusuario['Usuario']['movil_numero']));
                            $this->Mensaje->saveField('estado', 'No entregado al móvil autorizado enviar SMS');
                            $this->UsuariosUtil->actualizarEstadoTokenUsuario($idusuariomensaje,'No existe');
                            return $this->redirect(array('action' => 'index'));
                        }
                        if($respuesta['respuestaenvio']->{"results"}[0]->{"error"} =='InvalidRegistration'){
                            $this->Flash->set(__('Token del móvil inválido. Está corrupto!. Mensaje no enviado '));
                            $this->Mensaje->saveField('estado', 'No entregado al móvil autorizado de enviar SMS');
                            return $this->redirect(array('action' => 'index'));
                        }
                        if($respuesta['respuestaenvio']->{"results"}[0]->{"error"} =='NotRegistered'){
                            $this->Flash->set(__("Token del móvil caducado. Mensaje no enviado al ". $datosusuario['Usuario']['movil_numero']));
                            $this->Mensaje->saveField('estado', 'No entregado al móvil autorizado de enviar SMS');
                            $this->UsuariosUtil->actualizarEstadoTokenUsuario($idusuariomensaje,'Caducado');
                            return $this->redirect(array('action' => 'index'));
                        }
                        if($respuesta['respuestaenvio']->{"results"}[0]->{"error"} =='MessageTooBig'){
                            $this->Mensaje->saveField('estado', 'No entregado al móvil autorizado de enviar SMS');
                            $this->Flash->set(__("El mensaje excede el tamaño permitido por políticas. Por favor reducir su contenido". $datosusuario['Usuario']['movil_numero']));
                            return $this->redirect(array('action' => 'index'));
                        }
                }else{
                    $this->Flash->set(__('Mensaje no enviado!'));
                    $this->Mensaje->saveField('estado', 'No entregado al móvil autorizado de enviar SMS');
                    $this->Flash->set(__('Error con la petición a la plataforma de mensajes Firebase'));
                    return $this->redirect(array('action' => 'index'));
                }
            } catch (Exception $e) {
                new RuntimeException('Error, guardando el mensaje en DB. '.$e);
            }
        }
        $usuarios = $this->Mensaje->Usuario->find('list');
        $this->set(compact( 'usuarios'));
	}

    /**
     * edit method
     *
     * @param string $id
     * @return CakeResponse
     * @throws NotFoundException*@throws Exception
     * @throws Exception
     */
	public function edit($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Mensaje no existe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mensaje->save($this->request->data)) {
				$this->Flash->success(__('Mensaje guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('El mensaje no fue guardado. Intenta de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Mensaje.' . $this->Mensaje->primaryKey => $id));
			$this->request->data = $this->Mensaje->find('first', $options);
		}
		$mensajes = $this->Mensaje->find('list');
		$usuarios = $this->Mensaje->Usuario->find('list');
		$this->set(compact('mensajes', 'usuarios'));
	}

    /**
     * delete method
     *
     * @param string $id
     * @return CakeResponse|null
     */
	public function delete($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Mensaje no existe'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Mensaje->delete($id)) {
			$this->Flash->success(__('Mensaje eliminado.'));
		} else {
			$this->Flash->set(__('El mensaje no pudo ser eliminado. Intenta de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function getFcmRegistro($id_usuario){
	    $id = intval($id_usuario);
        $consultaRegistro = $this->Mensaje->Usuario->find("first", array(
            'conditions' => array('Usuario.' . $this->Mensaje->Usuario->primaryKey => $id),
            'fields' => array('Usuario.fcm_registro')
        ));
        return $consultaRegistro['Usuario']['fcm_registro'];
    }

    public function getmovil($id_usuario){
        $id = intval($id_usuario);
        $consultaMovil = $this->Mensaje->Usuario->find("first", array(
            'conditions' => array('Usuario.' . $this->Mensaje->Usuario->primaryKey => $id),
            'fields' => array('Usuario.movil_numero')
        ));
        return $consultaMovil['Usuario']['movil_numero'];
    }

    public function actualizarEstadoMensaje($estado){
        try {
            $this->Mensaje->save($this->Mensaje->estado = $estado);
        } catch (Exception $e) {
            new Exception("El estado del mensaje no pudo ser guardado");
        }
    }
}
