<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Traits\ApiResponser;
use App\Traits\ConsumesExternalServices;

class ClientController extends Controller
{
    use ApiResponser, ConsumesExternalServices;

    public $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Cria um cliente
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = $this->clientService->create($request);

        return $this->filterResponse($response);
    }

    /**
     * Recupera lista dos clientes
     * 
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $response = $this->clientService->get();

        return $this->filterResponse($response);
    }

    public function show($id)
    {
        $response = $this->clientService->show($id);

        return $this->filterResponse($response);
    }

    /**
     * Atualiza um cliente pelo id
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $response = $this->clientService->update($request, $id);

        return $this->filterResponse($response);
    }

    /**
     * Exclui um cliente pelo id
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $response = $this->clientService->delete($id);

        return $this->filterResponse($response);
    }
}
