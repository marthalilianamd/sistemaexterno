<?php

App::uses('HttpSocket', 'Network/Http');
class UsuariosWsTestController extends AppController
{
    public $components = array('Security', 'RequestHandler');

    public function index(){}

    public function request_edit($id){
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'usuarios_ws/'.$id.'.json';
        $data = null;
        $data['Usuario']['fcm_registro_id']= 'marthasdsadr45t3refbvcx';
        $httpSocket = new HttpSocket();
        $response = $httpSocket->put($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);

        $this -> render('/Usuariosws/request_response');
    }
}