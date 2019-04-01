<?php
App::uses('AppController', 'Controller');
/**
 * Gremios Controller
 *
 * @property Gremio $Gremio
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 */
class GremiosController extends AppController {

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
		$this->Gremio->recursive = 0;
		$this->set('gremios', $this->Paginator->paginate());
        $this->set('gremios', $this->Gremio->find('all'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Gremio->exists($id)) {
			throw new NotFoundException(__('Invalid gremio'));
		}
		$options = array('conditions' => array('Gremio.' . $this->Gremio->primaryKey => $id));
		$this->set('gremio', $this->Gremio->find('first', $options));
	}

    /**
     * add method
     *
     * @return CakeResponse
     * @throws Exception
     */
	public function add() {
        $this->loadModel('Gremio');
		if ($this->request->is('post')) {
			$this->Gremio->create();
			if ($this->Gremio->save($this->request->data)) {
				$this->Flash->success(__('The gremio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('The gremio could not be saved. Please, try again.'));
			}
		}
		$gremios = $this->Gremio->find('list');
		$this->set(compact('gremios'));
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
		if (!$this->Gremio->exists($id)) {
			throw new NotFoundException(__('Invalid gremio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Gremio->save($this->request->data)) {
				$this->Flash->success(__('The gremio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('The gremio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Gremio.' . $this->Gremio->primaryKey => $id));
			$this->request->data = $this->Gremio->find('first', $options);
		}
		$gremios = $this->Gremio->find('list');
		$this->set(compact('gremios'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return CakeResponse
 *@throws NotFoundException
 */
	public function delete($id = null) {
		if (!$this->Gremio->exists($id)) {
			throw new NotFoundException(__('Invalid gremio'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Gremio->delete($id)) {
			$this->Flash->success(__('The gremio has been deleted.'));
		} else {
			$this->Flash->set(__('The gremio could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Gremio->recursive = 0;
		$this->set('gremios', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Gremio->exists($id)) {
			throw new NotFoundException(__('Invalid gremio'));
		}
		$options = array('conditions' => array('Gremio.' . $this->Gremio->primaryKey => $id));
		$this->set('gremio', $this->Gremio->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return CakeResponse
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Gremio->create();
			if ($this->Gremio->save($this->request->data)) {
				$this->Flash->success(__('The gremio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The gremio could not be saved. Please, try again.'));
			}
		}
		$gremios = $this->Gremio->find('list');
		$this->set(compact('gremios'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Gremio->exists($id)) {
			throw new NotFoundException(__('Invalid gremio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Gremio->save($this->request->data)) {
				$this->Flash->success(__('The gremio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The gremio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Gremio.' . $this->Gremio->primaryKey => $id));
			$this->request->data = $this->Gremio->find('first', $options);
		}
		$gremios = $this->Gremio->find('list');
		$this->set(compact('gremios'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->Gremio->exists($id)) {
			throw new NotFoundException(__('Invalid gremio'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Gremio->delete($id)) {
			$this->Flash->success(__('The gremio has been deleted.'));
		} else {
			$this->Flash->error(__('The gremio could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
