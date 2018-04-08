<?php

namespace App\Core;

use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

/**
 * Class ParamsValidator.
 *
 * @package App\Core
 * @author Henry Harris <henry@104101110114121.com>
 */
class ParamsValidator
{
    /** @var Validator $validator */
    private $validator;

    /**
     * ParamsValidator constructor.
     * 
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $params
     * @param array $rules
     *
     * @return Validator
     */
    public function validateParams(array $params, array $rules)
    {
        $validator = $this->validator->make(
            $params,
            $rules
        );

        return $validator;
    }
}
