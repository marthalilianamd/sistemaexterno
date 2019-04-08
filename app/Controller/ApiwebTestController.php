<?php

App::uses('HttpSocket', 'Network/Http');
class ApiwebTestController extends AppController
{
    public $components = array('Security', 'RequestHandler');

    public function index(){}

    public function request_index(){
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'usuarios_ws.json';
        $data = null;
        $httpSocket = new HttpSocket();
        $response = $httpSocket->get($link, $data);
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);

        $this -> render('/Apiwebtest/request_response');
    }

    public function request_view($id){
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'usuarios_ws/'.$id.'.json';
        $data = null;
        $httpSocket = new HttpSocket();
        $response = $httpSocket->get($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);

        $this -> render('/Apiwebtest/request_response');
    }

    public function request_edit($id){
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'usuarios_ws/'.$id.'.json';
        $data = null;
        $httpSocket = new HttpSocket();
        $data['Usuario']['fcm_registro_id']= 'marthasdsadr45t3refbvcx';
        $response = $httpSocket->put($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);

        $this -> render('/Apiwebtest/request_response');
    }

    public function request_add(){
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'usuarios_ws.json';
        $data = null;
        $httpSocket = new HttpSocket();
        $data['Usuario']['nombre'] = 'carolina cruz';
        $data['Usuario']['email'] = 'ccarolinacali@hotmail.com';
        $data['Usuario']['movil_numero'] = 6584343422;
        $data['Usuario']['api_key'] = 'carocrizwerSADASbvsae';
        $data['Usuario']['fcm_registro_id'] = 'fcmy632y3SASAS2sdasdas';
        $data['Usuario']['fecha_creacion'] = date("Y-m-d H:i:s");
        $response = $httpSocket->post($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);

        $this -> render('/Apiwebtest/request_response');
    }

    public function request_delete($id){
        // remotely post the information to the server
        $link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'usuarios_ws/'.$id.'.json';
        $data = null;
        $httpSocket = new HttpSocket();
        $response = $httpSocket->delete($link, $data );
        $this->set('response_code', $response->code);
        $this->set('response_body', $response->body);

        $this -> render('/Apiwebtest/request_response');
    }
}