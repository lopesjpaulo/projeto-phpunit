<?php 

namespace App\Http\Requests;

class ClientRequest extends BaseRequest
{
    /**
     * @var array
     */
    private $rules;

    /**
     * ClientRepository constructor
     * 
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    /**
     * Função que valida os dados para inserção
     */
    public function validateInsert()
    {
        $this->rules = [
            'name'          => 'required|string',
            'birthday'      => 'required|string|max:10',
            'cpf'           => 'required|string|max:14'
        ];

        parent::validate($this->rules);
    }

    public function validateUpdate()
    {
        $this->rules = [
            'name'          => 'string',
            'birthday'      => 'string|max:10',
            'cpf'           => 'string|max:14'
        ];

        parent::validate($this->rules);
    }
}