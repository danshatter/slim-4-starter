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
                $rule->assert($data[$field]);
                
                $validData[$field] = $data[$field];
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages([
                    'alpha' => $this->formatErrorField($field).' must contain only letters "(a-z)"',
                    'noWhitespace' => $this->formatErrorField($field).' must not contain white spaces',
                    'alnum' => $this->formatErrorField($field).' must contain only letters "(a-z)", digits "(0-9)"',
                    'email' => $this->formatErrorField($field).' must be an valid email',
                    'equals' => $this->formatErrorField($field).' must equal '.$this->formatErrorField('password'),
                    'notEmpty' => $this->formatErrorField($field).' is required',
                    'length' => $this->formatErrorField($field).' length must be greater than or equal to {{minValue}}',
                    'phone' => $this->formatErrorField($field).' must be a valid phone number'
                ]);
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

    private function formatErrorField($field)
    {
        $var = str_replace('_', ' ', $field);
        return ucfirst($var);
    }
}