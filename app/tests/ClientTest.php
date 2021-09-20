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

        $clients = Client::factory()->count(3)->make();

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

    /**
     * /client [POST]
     */
    public function testShouldCreateClient(){

        $parameters = [
            'name' => 'Cliente teste',
            'merchant_id' => 'Movida2',
            'merchant_key' => 'chavealeatoriageradapelaSEparacadaloja'
        ];

        $this->post("esitef/filial", $parameters, $this->header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'filial_id',
                    'merchant_id',
                    'merchant_key',
                    'status',
                    'created_at',
                    'updated_at'
                ]
            ]    
        );
        
    }
    
    /**
     * /esitef/filial/id [PUT]
     */
    public function testShouldUpdateFilial(){

        $parameters = [
            'filial_id' => '998',
            'merchant_id' => 'Movida3',
            'merchant_key' => 'chavealeatoriageradapelaSEparacadaloja',
            'status' => 1
        ];

        $this->put("esitef/filial/4", $parameters, $this->header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'filial_id',
                    'merchant_id',
                    'merchant_key',
                    'status',
                    'created_at',
                    'updated_at'
                ]
            ]    
        );

    }

    /**
     * /esitef/filial/id [DELETE]
     */
    public function testShouldDeleteFilial(){

        $this->delete('esitef/filial/4', [], $this->header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'filial_id',
                    'merchant_id',
                    'merchant_key',
                    'status',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);

    }

}