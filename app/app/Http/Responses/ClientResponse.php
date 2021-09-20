<?php

namespace App\Http\Responses;

use App\Transformers\ClientTransformer;

class ClientResponse extends BaseResponse
{
    /**
     * ClientResponse constructor
     * 
     * @param ClientTransformer $transformer
     */
    public function __construct(ClientTransformer $transformer)
    {
        parent::__construct($transformer);
    }
}