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
    public function envioUnicoUsuario($reg_movil, $datosmensaje) {
        $datos = array(
            'to' => $reg_movil,
            'notification' =>
                array(
                    'title' => $datosmensaje['Mensaje']['titulo'],
                    'body' => $datosmensaje['Mensaje']['mensaje']
            /*'data' => array(
                'movil' => $datosmensaje['Mensaje']['titulo']
            )*/
            ));
        return $this->enviarMensaje($datos);
    }

    // Envio de mensaje a multiples usuarios por registro movil en Firebase
    public function envioMultipleUsuario($reg_moviles, $mensaje) {
        $datos = array(
            'to' => $reg_moviles,
            'data' => $mensaje,
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
        $request = array(
            'method' => 'POST',
            'header' => array(
                'Authorization: key=' . $key_api_firebase,
                'Content-Type:application/json'
            ),
        );
        $data = json_encode($datos);
        //debug($data);
        $httpSocket = new HttpSocket(array('ssl_verify_peer' =>false,'ssl_verify_host' => false,
            'ssl_verify_peer_name' => false, 'ssl_allow_self_signed' => false));
        try {
            $response = $httpSocket->post($url_firebase_send,$data,$request);
        }catch (\Exception $e){
            throw new \RuntimeException('Falló la solicitud post ',$e);
        }
        debug($response->code);
        if($response->code === '200'){
            $resultado['respuestaenvio'] = $response->body;
            $resultado['Ok'] = true;
            //throw new \RuntimeException('La respuesta de la petición no fue correcta');
        }else{
            $resultado['respuestaenvio'] = '';
            $resultado['Ok'] = false;
        }
        return $resultado;
    }
}