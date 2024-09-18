<?php
namespace   app\database\models;

use App\Database\filters;
use PDOException;


abstract class model 
{

    private string $fields ='*';
    private string $filters = '';

    protected string $table;


    public function setfields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(filters $filters)
    {
        $this->filters = $filters;
    }



    public function fetchAll()
    {
        try {
            $sql = "select {$this->fields} from {$this->table} {$this->filters}";
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
}
