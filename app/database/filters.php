<?php

namespace   App\Database;

class filters
{
    private array $filters =[];

    public function where(string $field, string $operator, mixed $value, string $logic ='')
    {
        $formatter = '';

        if (is_array($value)) {
            $formatter ="('". implode("','",$value)."')";
        } elseif (is_string($value)){
            $formatter = "'{$value}'";
        }elseif(is_bool($value)){
            $formatter = "'{$value}'";
        }
        dd($formatter);
    } 
}