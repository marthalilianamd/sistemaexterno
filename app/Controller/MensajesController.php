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
	public $components = array( 'Paginator','Firebase','Flash', 'UsuariosUtil');

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
                $numero_movil = $this->getmovil($datos['Mensaje']['usuario_id']);
                try{
                    $respuesta = $this->Firebase->envioUnicoUsuario($registro_movil, $datos, $numero_movil);
                } catch (Exception $e) {
                    new RuntimeException('Mensaje no enviado a usuario. '.$e);
                }
                //debug("Llegando a comprobar");
                if(isset($respuesta['Ok'])) {
                    if($respuesta['respuestaenvio']['success']== 1) { //que el mensaje fue enviado con token vigente
                        $this->Mensaje->create();
                        $this->UsuariosUtil->actualizarEstadoTokenUsuario($this->request->data['Mensaje']['usuario_id'],'Vigente');
                        if ($this->Mensaje->save($this->request->data)) {
                            $this->Flash->success(__('Mensaje enviado y guardado exitosamente!.'));
                            return $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Flash->set(__('El mensaje no fue guardado'));
                        }
                    }else{
                        $this->UsuariosUtil->actualizarEstadoTokenUsuario($this->request->data['Mensaje']['usuario_id'],'Caducado');
                        $this->Flash->set(__('El mensaje no fue enviado!'));
                        $this->Flash->set(__('El Token del movil caducado. El usuario de la App debe renovarlo'));
                    }
                }else{
                    $this->Flash->set(__('El mensaje no fue enviado!'));
                    $this->Flash->set(__('Problemas con la comunicación con la plaforma de mensajes'));
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
}
