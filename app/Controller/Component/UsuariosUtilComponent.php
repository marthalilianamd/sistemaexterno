<?php
App::uses('Component','Controller');
/**
 * @property Usuario $usuario
 */
class UsuariosUtilComponent extends Component{

    /** @var usuario */
    private $usuario;
    /**
     * UsuariosUtilComponent constructor.
     */
    public function __construct() {
        $this->usuario =  ClassRegistry::init('Usuario');
    }

    /**
     * Verifica si existe email retorna el id del usuario dentro del sistema web
     * @param $email
     * @return array
     */
    public function existeUsuario($email){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email),
            'fields' => array('Usuario.usuario_id')
        );
        $idusuario = $this->usuario->find('first', $filtro);
        if(empty($idusuario['Usuario']['usuario_id'])) {
            $flag = false;
            $idusuario['Usuario']['usuario_id'] = 0;
        }else{
            $flag =true;
        }
        return $result = array (
            'existe' => $flag,
            'idusuario'=> $idusuario['Usuario']['usuario_id']
        );
    }

    public function tokenMovil($email){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email),
            'fields' => array('Usuario.fcm_registro_id')
        );
        $tokenmovil = $this->usuario->find('first', $filtro);
        //debug($tokenmovil['Usuario']['fcm_registro_id']);
        if(empty($tokenmovil['Usuario']['fcm_registro_id'])){
            $flag = true;
        }else{
            $flag = false;
        }
        return $result = array (
            'vacio' => $flag,
            'token'=> $tokenmovil['Usuario']['fcm_registro_id']
        );
    }
}