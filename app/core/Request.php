<?php
namespace   app\core;

use Exception;

class Request 
{
    public static function input($name)
    {
        if(isset($_POST [$name])){
            return $_POST [$name];
        }

        throw new Exception("O index {$name} não existe");
    }


    public static function all()
    {
       return $_POST;
    }

    public static function only(string|array $only)
    {
        $fieldsPost = self::all();
        $fieldsPostKeys = array_keys($fieldsPost);

        $arr = [];
         foreach ($fieldsPostKeys as $index => $value) {
            $onlyField = (is_string($only) ? $only : (isset($only[$index]) ? $only[$index] : null));
            if(isset($filderPost[$onlyField])){
                $arr[$onlyField] = $fieldsPost[$onlyField];
            }
        }
        return $fieldsPostKeys;
    }
    
    public static function excepts(string|array $excepts)
    {
        $fieldsPost = self::all();
        //dd($fieldsPost);
        
        if(is_array($excepts)){
            foreach($excepts as $index => $value) {
                unset($fieldsPost[$value]);
            }
        }

        if(is_string($excepts)){
            unset($fieldsPost[$excepts]);
        }

        return $fieldsPost;
    }

    public static function query($name)
    {
        if(!isset($_GET[$name]))
        {
            throw new Exception("Não existe query string {$name}");
        }
        return $_GET[$name];
    }

    public static function toJson(array $data)
    {
        return Json_encode($data);
    }

   

    public static function toArray(string $data)
    {
        if(isJson($data)) {
            return json_decode($data);
        }
    }

}