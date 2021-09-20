<?php 

namespace App\Http\Responses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class BaseResponse
{
    /**
     * @var TransformerAbstract
     */
    private $transformer;

    private $fractal;

    /**
     * BaseResponse constructor
     * 
     * @param TransformerAbstract $transformer
     */
    public function __construct(TransformerAbstract $transformer)
    {
        $this->transformer = $transformer;
        $this->fractal = new Manager();
    }

    /**
     * @param Model $model
     * @return array
     */
    public function formatResponseItem(Model $model): array
    {
        $resource = new Item($model, $this->transformer);
        
        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @return array
     */
    public function formatResponseCollection(LengthAwarePaginator $paginator): array
    {
        $resource = new Collection($paginator->getCollection(), $this->transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        
        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * Retorna mensagem de sucesso padronizada ao atualizar um registro
     */
    public function formatResponseSuccessUpdate()
    {
        return ['data' => 'Registro atualizado com sucesso!'];
    }

    public function formatResponseSuccessDelete()
    {
        return ['data' => 'Registro excluído com sucesso!'];
    }
}