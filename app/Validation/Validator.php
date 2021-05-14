<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Factory;

class Validator
{

    private $errors = [];

    public function __construct()
    {
        Factory::setDefaultInstance((new Factory)
                ->withRuleNamespace('App\\Validation\\Rules')
                ->withExceptionNamespace('App\\Validation\\Exceptions'));
    }

    public function validate(array $data, array $rules)
    {
        $validData = [];

        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($this->formatErrorField($field))->assert($data[$field]);
                
                $validData[$field] = $data[$field];
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        return $validData;
    }

    public function ready(array &$data)
    {
        foreach ($data as $key => $value) {
            if ($key === 'password' || $key === 'password_confirmation') {
                continue;
            }

            if (trim($value) === "") {
                $data[$key] = null;
            } else {
                $data[$key] = trim($value);
            }
        }

        return $this;
    }

    public function failed()
    {
        return count($this->errors) !== 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getFirstErrors()
    {
        if ($this->failed()) {
            $firstErrors = [];

            foreach ($this->errors as $key => $value) {
                $firstErrors[$key] = array_shift($value);
            }

            return $firstErrors;
        }

        return null;
    }

    private function formatErrorField($field)
    {
        $var = str_replace('_', ' ', $field);
        return ucfirst($var);
    }
}