<?php

App::uses('HttpSocket', 'Network/Http');
App::uses('Component','Controller');

class FirebaseComponent extends Component
{
    // Envia mensaje a uno o varios usuarios por registro movil generado por Firebase
    /**
     * @param $reg_movil
     * @param $mensaje
     * @return array
     * @throws Exception
     */
    public function envioUnicoUsuario($reg_movil, $datosmensaje, $numeromovil) {
        $datos = array(
            'to' => $reg_movil,
            'data' => array(
                'title' => $datosmensaje['Mensaje']['titulo'],
                'body' => $datosmensaje['Mensaje']['mensaje'],
                'phone' => $numeromovil
            ),
            'priority' => 'high'
        );

        return $this->enviarMensaje($datos);
    }

    // Envio de mensaje a multiples usuarios por registro movil en Firebase

    /**
     * @param $reg_moviles
     * @param $datosmensaje
     * @param $numeromovil
     * @return array
     * @throws Exception
     */
    public function envioMultipleUsuario($reg_moviles, $datosmensaje, $numeromovil) {
        $datos = array(
            'to' => $reg_moviles,
            'data' => array(
                'title' => $datosmensaje['Mensaje']['titulo'],
                'body' => $datosmensaje['Mensaje']['mensaje'],
                'phone' => $numeromovil
            ),
            'priority' => 'high'
        );
        return $this->enviarMensaje($datos);
    }

    // Función que hace la solicitud al servidor de Firebase
    /**
     * @param $datos
     * @return array
     * @throws Exception
     */
    public function enviarMensaje($datos) {
        $key_api_firebase = Configure::read('FIREBASE_CONFIG.SERVER_KEY');
        $url_firebase_send = Configure::read('FIREBASE_CONFIG.URL_SEND');
        $headers = array(
            'Authorization:key='.$key_api_firebase,
            'Content-Type:application/json');

        $data = json_encode($datos);
        //debug($data);
        $httpsocket = new HttpSocket(array('ssl_verify_peer' => false,'ssl_verify_host' => false,
            'ssl_verify_peer_name' => false, 'ssl_allow_self_signed' => false));
        try {
            $response = $httpsocket->post($url_firebase_send,$data,$headers);
        }catch (SocketException $e){
            throw new SocketException('Falló el llamado al servicio solicitud post ',$e);
        }
        print_r($response->body);
        if(!isset($response->code) ||  !$response->isOk()){
            throw new RuntimeException("Falló la petición : {$response}");
        }
        debug('Petición exitosa!');
        $resultado = array();
        if($response->isOk()){
            debug('Petición exitosa');
            debug('Cuerpo de la respuesta: '.json_decode($response->body, true));
            $resultado['respuestaenvio'] = json_decode($response->body, true);
            $resultado['Ok'] = true;
        }else{
            $resultado['respuestaenvio'] = '';
            $resultado['Ok'] = false;
        }
        return $resultado;
    }
}