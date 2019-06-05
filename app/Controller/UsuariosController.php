<?php
App::uses('AppController', 'Controller');
App::import('Model', 'Mensaje');
App::import('Component','Usuariosutil');
/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property Mensaje $Mensaje
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property AuthComponent $Auth
 * @property UsuariosUtilComponent $Usuariosutil
 */
class UsuariosController extends AppController {

    /**
     * Components
     * @var array
     */
    public $components = array(
        'Paginator',
        'Flash',
        'Auth',
        'Session',
        'Usuariosutil'
    );

    public function login(){
        if($this->request->is('post')) {
            $existeusuario = $this->Usuariosutil->existeUsuario($this->data['Usuario']['email'],$this->data['Usuario']['contrasena']);
            if ($existeusuario !=null) {
                $okcontrasena = $this->Usuariosutil->verificarContrasena($this->data['Usuario']['email'],
                    $this->data['Usuario']['contrasena']);
                if ($okcontrasena) {
                    //Si existe se redirecciona al usuario a la aplicación creando una variable de sesión
                    $this->Flash->success(__('Bienvenido'));
                    $nombreuser = $this->Usuariosutil->obtenerUsuario($this->data['Usuario']['email']);
                    $this->Session->write('nombreusuario',$nombreuser['Usuario']['nombre']);
                    $this->Session->write('idusuario',$nombreuser['Usuario']['usuario_id']);
                    $this->Session->write('Logueado', true);
                    $this->logueado = true;

                    $this->Redirect(array('controller' => 'mensajes', 'action' => 'index'));
                    exit();
                } else {
                    //Si los datos no son correctos se comunica al usuario y se le devuelve al mismo
                    //formulario de login
                    $this->Flash->set(__('Datos incorrectos'));
                    $this->Redirect(array('action' => 'login'));
                    exit();
                }
            } else {
                $this->Flash->set(__('El usuario no existe'));
                $this->Redirect(array('action' => 'login'));
                exit();
            }
        }
    }

    public function logout(){
        $this->Session->write('Logueado',false);
        $this->redirect($this->Auth->logout());
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
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
			throw new NotFoundException(__('Usuario inválido'));
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
				$this->Flash->success(__('Usuario guardado!'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->set(__('El usuario no fue guardado. Intente de nuevo.'));
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
			throw new NotFoundException(__('Usuario inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Usuario->delete($id)) {
			$this->Flash->success(__('Usuario eliminado!'));
		} else {
			$this->Flash->set(__('El usuario no fue eliminado. Intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function encriptarCadena($cadena){
        return Security::hash($cadena,'sha256', true);
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'add');
        //$this->Auth->autoRedirect=false;

    }

    public function afterFilter(){
        if($this->Session->read('Logueado')) {
            $this->Auth->allow('add', 'delete', 'edit', 'view', 'index');
            parent::afterFilter();
        }
    }

}
