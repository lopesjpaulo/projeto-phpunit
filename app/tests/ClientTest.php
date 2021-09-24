<?php

use App\Models\Client;

class ClientTest extends TestCase
{
    private $header;

    public function __construct()
    {
        parent::__construct();
        $this->header = [
            'Authorization' => 'key_secret_vetor',
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * /client [GET]
     */
    public function testShouldReturnAllClients(){

        $clients = Client::factory()->count(3)->create();

        $this->get("client", $this->header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'name',
                    'birthday',
                    'cpf',
                    'created_at'
                ]
            ]
        ]);
        
    }

    /**
     * /client/id [GET]
     */
    public function testShouldReturnClient(){

        $this->get("client/1", $this->header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'name',
                    'birthday',
                    'cpf',
                    'created_at'
                ]
            ]    
        );

    }
}