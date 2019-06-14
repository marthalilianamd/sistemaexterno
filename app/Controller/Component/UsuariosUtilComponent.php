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
    public function consultarUsuario($email){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email),
            'fields' => array('Usuario.usuario_id', 'Usuario.email','Usuario.contrasena')
        );
        $sobreelusuario = $this->usuario->find('first', $filtro);
        if(empty($sobreelusuario['Usuario']['usuario_id'])) {
            $flag = false;
            $sobreelusuario['Usuario']['usuario_id'] = 0;
        }else{
            $flag =true;
        }
        return $result = array (
            'existe' => $flag,
            'idusuario'=> $sobreelusuario['Usuario']['usuario_id'],
            'email' => $sobreelusuario['Usuario']['email'],
            'contrasena' => $sobreelusuario['Usuario']['contrasena']
        );
    }

    public function tokenMovil($email){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email),
            'fields' => array('Usuario.fcm_registro')
        );
        $tokenmovil = $this->usuario->find('first', $filtro);
        //debug($tokenmovil['Usuario']['fcm_registro_id']);
        if(empty($tokenmovil['Usuario']['fcm_registro'])){
            $flag = true;
        }else{
            $flag = false;
        }
        return $result = array (
            'vacio' => $flag,
            'token'=> $tokenmovil['Usuario']['fcm_registro']
        );
    }

    public function verificarContrasena($email,$contrasenaapp){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email),
            'fields' => array('Usuario.contrasena')
        );
        $contrasenaweb = $this->usuario->find('first', $filtro);
        return password_verify($contrasenaapp,$contrasenaweb['Usuario']['contrasena']);
    }

    public function existeUsuario($email){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email)
        );
        return $this->usuario->find('first', $filtro);
    }

    public function obtenerUsuario($email){
        $filtro = array(
            'conditions' => array('Usuario.email' => $email),
            'fields' => array('Usuario.nombre','Usuario.usuario_id',)
        );
        return $this->usuario->find('first', $filtro);
    }

    public function actualizarEstadoTokenUsuario($id,$estadoactual){
        /*$filtro = array(
            'conditions' => array('Usuario.id' => $id),
            'fields' => array('Usuario.estadotoken')
        );
        $campoEstadoToken = $this->usuario->find('first', $filtro);
        $campoEstadoToken['Usuario']['estadotoken'] = $estadoactual;
        */
        $this->usuario->id = $id;
        try {
            $this->usuario->save($this->usuario->estadotoken = $estadoactual);
        } catch (Exception $e) {
            new Exception("El estado del token móvil no pudo ser guardado");
        }
    }
    public function obtenerDatosUsuario($id){
        $filtro = array(
            'conditions' => array('Usuario.usuario_id' => $id),
            'fields' => array('Usuario.nombre','Usuario.movil_numero','Usuario.estadotoken',
                'Usuario.fcm_registro')
        );
        return $this->usuario->find('first', $filtro);
    }

}