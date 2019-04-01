<?php
App::uses('AppController', 'Controller');
/**
 * Mensajes Controller
 *
 * @property Mensaje $Mensaje
 * @property Usuario $Usuario
 * @property Gremio $Gremio
 * @property PaginatorComponent $Paginator
 * @property FirebaseComponent $Firebase
 * @property FlashComponent $Flash
 */
class MensajesController extends AppController {

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
		$this->set('mensajes', $this->Paginator->paginate());
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
			throw new NotFoundException(__('Invalid mensaje'));
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
			$this->Mensaje->create();
            try {
                if ($this->Mensaje->save($this->request->data)) {
                    $this->Flash->success(__('The mensaje has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->set(__('The mensaje could not be saved. Please, try again.'));
                }
            } catch (Exception $e) {
                new RuntimeException('No guardó mensaje en DB. '.$e);
            }
        }
        $gremios = $this->Mensaje->Gremio->find('list');
        $usuarios = $this->Mensaje->Usuario->find('list');
        $this->set(compact('gremios', 'usuarios'));
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
		$usuarios = $this->Mensaje->Usuario->find('list');
        $gremios = $this->Mensaje->Gremio->find('list');
		$this->set(compact('mensajes', 'usuarios','gremios'));
	}

    /**
     * delete method
     *
     * @param string $id
     * @return CakeResponse|null
     */
	public function delete($id = null) {
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

/**
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
