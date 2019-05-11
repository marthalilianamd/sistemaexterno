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
            'data' => array(
                'title' => $datosmensaje['Mensaje']['titulo'],
                'message' =>  $datosmensaje['Mensaje']['mensaje']
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
    private function enviarMensaje($fields) {
        $key_api_firebase = Configure::read('FIREBASE_CONFIG.API');
        $url_firebase_send = Configure::read('FIREBASE_CONFIG.URL');
        $resultado = array();
        $request = array(
            'method' => 'POST',
            'header' => array(
                'Authorization: key=' . $key_api_firebase,
                'Content-Type: application/json'
            ),
            'body' => $fields
        );
        $HttpSocket = new HttpSocket();
        try {
            $response = $HttpSocket->post($url_firebase_send, $request);
            debug($response->code);
        }catch (\Exception $e){
            throw new \RuntimeException('Falló la solicitud post ',$e);
        }
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