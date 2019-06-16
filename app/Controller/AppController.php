<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'DebugKit.Toolbar',
        'RequestHandler',
        'Session',
        'Security',
        'Auth' => array(
            'loginRedirect' => array(
                'Controller' => 'mensajes','action'=> 'index'
            ),
            'logoutRedirect' => array(
                'Controller' => 'usuarios','action'=> 'login'
            ),
            'authorize' => array('Controller'),
        ));


    //dividir las solicitudes de entrada para saber si es controlador de Rest y otro
    public function beforeFilter() {
        if(in_array($this->params['controller'],array('usuariosws')) ||
            in_array($this->params['controller'],array('mensajesws'))){
            // For RESTful web service requests, we check the name of our contoller
            $this->Auth->allow();
            // this line should always be there to ensure that all rest calls are secure
            // forma más segura de proteger la aplicación de los ataques de intermediarios
            //$this->Security->requireSecure();
            $this->Security->unlockedActions = array('edit','view', 'add');
        }
        if((in_array($this->params['controller'],array('usuarios')) ||
            in_array($this->params['controller'],array('mensajes'))) && $this->Session->read('Logueado')){
            // setup out Auth
            $this->Auth->allow();
            $this->set('logged_in', $this->Auth->loggedIn());
            $this->Security->unlockedActions = array('login','add','edit','delete','index','view');
        }else{
            if(!$this->Session->read('Logueado')){
                $this->Auth->allow('login');
            }
        }
        parent::beforeFilter();
    }

}
