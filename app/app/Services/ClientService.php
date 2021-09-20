<?php

namespace App\Services;

use App\Http\Requests\ClientRequest;
use App\Http\Responses\ClientResponse;
use App\Repository\ClientRepositoryInterface;
use App\Traits\ErrorResponse;
use Illuminate\Http\Request;

class ClientService
{
    use ErrorResponse;

    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * @var ClientResponse
     */
    private $clientResponse;

    public function __construct(ClientRepositoryInterface $clientRepository, ClientResponse $clientResponse)
    {
        $this->clientRepository = $clientRepository;
        $this->clientResponse = $clientResponse;
    }

    /**
     * Recupera dados dos clientes
     * 
     * @return array
     */
    public function get(): array
    {
        try{
            $clients = $this->clientRepository->paginate(10);

            return $this->clientResponse->formatResponseCollection($clients);
        } catch(\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Recupera dado de um cliente
     * @param int $id
     * @return array
     */
    public function show(int $id): array
    {
        try {
            $client = $this->clientRepository->find($id);
            
            if(!$client) {
                return $this->errorNotFound();
            }

            return $this->clientResponse->formatResponseItem($client);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Salva o cliente
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function create(Request $request): array
    {
        try {
            $requestData = $request->all();

            $validator = new ClientRequest($requestData);

            $validator->validateInsert();

            $client = $this->clientRepository->create($request->all());

            return $this->clientResponse->formatResponseItem($client);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    /**
     * Atualiza o cliente
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function update(Request $request, int $id): array
    {
        try {
            $requestData = $request->all();

            $validator = new ClientRequest($requestData);

            $validator->validateUpdate();

            $client = $this->clientRepository->find($id);

            if(!$client) {
                return $this->errorNotFound();
            }

            $update = $this->clientRepository->update($requestData, $id);

            if($update){
                return $this->clientResponse->formatResponseSuccessUpdate();
            }

            return $this->errorUpdate();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Exclui um cliente
     * @param int $id
     */
    public function delete(int $id)
    {
        try {
            $client = $this->clientRepository->find($id);

            if(!$client) {
                return $this->errorNotFound();
            }

            $delete = $this->clientRepository->delete($id);

            if($delete){
                return $this->clientResponse->formatResponseSuccessDelete();
            }

            return $this->errorDelete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
