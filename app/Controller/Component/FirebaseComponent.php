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
    public function envioMultipleUsuario($reg_moviles,$datosmensaje, $numeromovil) {
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
    private function enviarMensaje($datos) {
        $key_api_firebase = Configure::read('FIREBASE_CONFIG.SERVER_KEY');
        $url_firebase_send = Configure::read('FIREBASE_CONFIG.URL_SEND');
        $resultado = array();

        $data = json_encode($datos);
        debug($datos);

        $datarequest = array(
            'method' => 'POST',
            'headers' => array(
                'Authorization: key=' . $key_api_firebase,
                'Content-Type: application/json'
            ),
            'body' => $data
        );
        print_r($datarequest);

        $httpsocket = new HttpSocket(array('ssl_verify_peer' => false, 'ssl_verify_host' => false,
            'ssl_verify_peer_name' => false, 'ssl_allow_self_signed' => false));
        try {
            $response = $httpsocket->post($url_firebase_send,$datos,$datarequest);
            print_r("sii entra-->".$response->body);
        }catch (SocketException $e){
            debug('SockectException: '.$e);
            throw new SocketException('Falló el llamado al servicio solicitud post ',$e);
        }
        debug('código: '.$response->code);
        if(!isset($response->code) ||  $response->code !== 200){
            debug("entraa");
            throw new RuntimeException("Falló la petición : {$response}");
        }
        debug('Petición exitosa!');

        if($response->code == 200){
            debug('Petición exitosa');
            debug('Cuerpo de la respuesta: '.$response->body);
            $resultado['respuestaenvio'] = $response->body;
            $resultado['Ok'] = true;
        }else{
            $resultado['respuestaenvio'] = '';
            $resultado['Ok'] = false;
        }
        return $resultado;
    }
}