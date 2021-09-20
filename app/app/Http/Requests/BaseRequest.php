<?php 

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseRequest
{
    /**
     * @var array
     */
    private $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param array $rules
     * @return void
     */
    public function validate(array $rules): void
    {   
        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails())
            throw new ValidationException($validator);
    }
}