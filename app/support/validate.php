<?php
namespace   app\support;
use app\traits\validations;
use Exception;

class validate 
{
    use validations;
    private function getParam($validation, $param)
    {
        if(substr_count($validation, ':') == 1 ){
            [$validation, $param] = explode (':', $validation);
        }
        return [$validation, $param];
    }


    private function validationExist($validation)
    {
        if (!method_exists($this, $validation)){
            throw new Exception("O método {$validation} na validação não existe.");
            }
    }

    public function validate(array $validationsfields)
    {
        $inputsvalidation =[];
        foreach ($validationsfields as $field => $validation) {
            $havePipes = str_contains($validation, '|');
            
            if(!$havePipes){
                $param = '';

               [$validation, $param] = $this->getParam($validation, $param);
                
               $this->validationExist($validation);
                
                $inputsvalidation[$field] = $this->$validation($field, $param);
                
            } else {
                 $validations = explode( '|',$validation);
                 $param = '';

                 $inputsvalidation[$field] = $this->multipleValidations($validation, $$field, $param);
                }
            }

        return $this->returnValidation($inputsvalidation);
    }
    private function multipleValidations($validations, $field, $param)
    {
        foreach ($validations as $validation) {
            [$validation, $param] = $this->getParam($validation, $param);

            $this->validationExist($validation);

            $inputsValidation[$field] = $this->$validation($field, $param);
            
            if ($this->inputsValidation[$field] === null) {
                break;
            }
            return $inputsValidation[$field];
        }
    }
    private function returnValidation($inputsvalidation)
    {
        
        csrf::validateToken();

        if (in_array(null,$this->$inputsvalidation, true)){
            return null;
        }
        return $this->$inputsvalidation;
    }
}