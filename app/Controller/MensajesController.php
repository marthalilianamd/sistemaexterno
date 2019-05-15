<?php
App::uses('AppController', 'Controller');
App::import('Model', 'Usuario');
App::import('Model', '');
/**
 * Mensajes Controller
 *
 * @property Mensaje $Mensaje
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 * @property FirebaseComponent $Firebase
 * @property FlashComponent $Flash
 */
class MensajesController extends AppController {

    public $uses = array('Usuario','Mensaje');

/**
 * Components
 *
 * @var array
 */
	public $components = array(
	    'Paginator',
        'Firebase',
        'Flash'
    );


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mensaje->recursive = 0;
		$this->set('mensajes', $this->Mensaje->find('all', $this->Paginator->paginate()));
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
                //debug($datos);
                $registro_movil = $this->getFcmRegistro($this->request->data['Mensaje']['usuario_id']);
                try{
                    $respuesta = $this->Firebase->envioUnicoUsuario($registro_movil, $datos);
                    debug($respuesta);
                } catch (Exception $e) {
                    new RuntimeException('Mensaje no enviado a usuario. '.$e);
                }
                if($respuesta['Ok']) {
                    $this->Mensaje->create();
                    if ($this->Mensaje->save($this->request->data)) {
                        $this->Flash->success(__('Mensaje enviado y guardado exitosamente!.'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Flash->set(__('El mensaje no fue guardado. Intenta de nuevo.'));
                    }
                }else{
                    $this->Flash->set(__('El mensaje no fue enviado. Intenta de nuevo.'));
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
        $consultaRegistro = $this->Usuario->find("first", array(
            'conditions' => array('Usuario.usuario_id' == $id_usuario),
            'fields' => array('Usuario.fcm_registro')
        ));
        return $consultaRegistro['Usuario']['fcm_registro'];
    }

/*************************************************************************
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Mensaje->recursive = 0;
		$this->set('mensajes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Invalid mensaje'));
		}
		$options = array('conditions' => array('Mensaje.' . $this->Mensaje->primaryKey => $id));
		$this->set('mensaje', $this->Mensaje->find('first', $options));
	}

    /**
     * admin_add method
     *
     * @return CakeResponse|null
     * @throws Exception
     */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Mensaje->create();
			if ($this->Mensaje->save($this->request->data)) {
				$this->Flash->success(__('The mensaje has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('The mensaje could not be saved. Please, try again.'));
			}
		}
		$mensajes = $this->Mensaje->find('list');
		$usuarios = $this->Mensaje->find('list');
		$this->set(compact('mensajes', 'usuarios'));
	}

    /**
     * admin_edit method
     *
     * @param string $id
     * @return CakeResponse
     * @throws NotFoundException*@throws Exception
     * @throws Exception
     */
	public function admin_edit($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Invalid mensaje'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mensaje->save($this->request->data)) {
				$this->Flash->success(__('The mensaje has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('The mensaje could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mensaje.' . $this->Mensaje->primaryKey => $id));
			$this->request->data = $this->Mensaje->find('first', $options);
		}
		$mensajes = $this->Mensaje->find('list');
		$usuarios = $this->Mensaje->find('list');
		$this->set(compact('mensajes', 'usuarios'));
	}

    /**
     * admin_delete method
     *
     * @param string $id
     * @return CakeResponse|null
     */
	public function admin_delete($id = null) {
		if (!$this->Mensaje->exists($id)) {
			throw new NotFoundException(__('Invalid mensaje'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Mensaje->delete($id)) {
			$this->Flash->success(__('The mensaje has been deleted.'));
		} else {
			$this->Flash->set(__('The mensaje could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
