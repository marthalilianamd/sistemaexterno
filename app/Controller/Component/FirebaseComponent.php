<?php
App::uses('HttpSocket', 'Network/Http');
App::uses('Component','Controller');

class FirebaseComponent extends Component
{
    // sending push message to single user by firebase reg id
    /**
     * @param $to
     * @param $message
     * @return string
     * @throws Exception
     */
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'data' => $message,
        );
        return $this->sendMessage($fields);
    }

    // function makes request to firebase servers

    /**
     * @param $fields
     * @return string
     * @throws Exception
     */
    private function sendMessage($fields) {

        $key_api_firebase = Configure::read('FIREBASE_CONFIG.API');
        $url_firebase_send = Configure::read('FIREBASE_CONFIG.URL');

        $request = array(
            'method' => 'POST',
            'header' => array(
                'Authorization: key=' . $key_api_firebase,
                'Content-Type: application/json'
            ),
            'body' => $fields
        );

        $HttpSocket = new HttpSocket(['ssl_allow_self_signed' => false, 'ssl_verify_peer' => false,'ssl_verify_host' => false]);
        try {
            $response = $HttpSocket->post($url_firebase_send, $request);
            $code = $response->code;
            if($code !== '200'){
                throw new \RuntimeException('La respuesta de la petición no fue correcta');
            }
            debug('respuesta de la petición'.$response->body);
            return $response->body;
        }catch (\Exception $e){
            throw new \RuntimeException('Falló la solicitud post',$e);
        }
    }

}