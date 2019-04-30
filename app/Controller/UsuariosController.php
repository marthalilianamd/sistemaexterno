<?php
App::uses('AppController', 'Controller');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 */
class UsuariosController extends AppController {

    /**
     * Components
     * @var array
     */
    public $components = array(
        'Paginator',
        'Flash',
    );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
		$this->set('usuario', $this->Usuario->find('first', $options));
	}

    /**
     * add method
     *
     * @return CakeResponse
     * @throws Exception
     */
	public function add() {
		if ($this->request->is('post')) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->request->data)) {
				$this->Flash->success(__('The usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('The usuario could not be saved. Please, try again.'));
			}
		}
		$usuarios = $this->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

    /**
     * edit method
     *
     * @param string $id
     * @return CakeResponse
     * @throws NotFoundException
     * @throws Exception
     */
	public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Usuario inválido'));
        }
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Usuario inválido'));
		}
		if ($this->request->is(array('usuario','put'))) {
            $this->Usuario->id = $id;
			if ($this->Usuario->save($this->request->data)) {
				$this->Flash->success(__('El usuario ha sido actualizado'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('El usuario podría no ser guardado, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
			$this->request->data = $this->Usuario->find('first', $options);
		}
		$usuarios = $this->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

    /**
     * delete method
     *
     * @param string $id
     * @return CakeResponse|null
     */
	public function delete($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Usuario->delete($id)) {
			$this->Flash->success(__('The usuario has been deleted.'));
		} else {
			$this->Flash->set(__('The usuario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
		$this->set('usuario', $this->Usuario->find('first', $options));
	}

    /**
     * admin_add method
     *
     * @return CakeResponse
     * @throws Exception
     */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->request->data)) {
				$this->Flash->success(__('The usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The usuario could not be saved. Please, try again.'));
			}
		}
		$usuarios = $this->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return CakeResponse
     * @throws Exception
     */
	public function admin_edit($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Usuario->save($this->request->data)) {
				$this->Flash->success(__('The usuario has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The usuario could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
			$this->request->data = $this->Usuario->find('first', $options);
		}
		$usuarios = $this->Usuario->find('list');
		$this->set(compact('usuarios'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return CakeResponse
 */
	public function admin_delete($id = null) {
		if (!$this->Usuario->exists($id)) {
			throw new NotFoundException(__('Invalid usuario'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Usuario->delete($id)) {
			$this->Flash->success(__('The usuario has been deleted.'));
		} else {
			$this->Flash->error(__('The usuario could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
