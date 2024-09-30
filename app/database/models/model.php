<?php

namespace app\database\models;

use PDO;
use PDOException;
use EmptyIterator;
use app\database\filters;
use app\database\connection;
use app\database\pagination;

abstract class model 
{
    private string $fields = '*';
    
    private string $filters = '';
    private string $Pagination = '';
    protected string $table = '';

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(filters $filters)
    {
        $this->filters = $filters->dump(); // Usa o método dump() da classe filters
    }

    public function setPagination(pagination $Pagination)
    {
        $Pagination->setTotalItems($this->count());
        $this->Pagination = $Pagination->dump();
    }

    public function create(array $data)
    {
        try {
            $sql =  "insert into {$this->table} (";
            $sql.= implode(',' , array_keys($data)). ")values (";
            $sql.= ':' .implode(',:' , array_keys($data)). ")";

            $connection = connection::connect();
                
            $prepare = $connection->prepare($sql); 

            return $prepare->execute($data);

            dd($sql);

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function upDate(string $field, string|int $fieldValue, array $data)
    {
        try {
            $sql = "update {$this->table} set ";
                foreach ($data as $key => $value) {
                    $sql.="{$key} = :{$key},";
                }
            $sql = rtrim($sql, ' ,');

            $sql.=" where {$field} = :{$field}";
            
            $data[$field] = $fieldValue;
            
            $connection = connection::connect();
            
            $prepare = $connection->prepare($sql); 

           return $prepare->execute($data);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
    

    


    public function fetchAll()
    {
        try {
            $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters} {$this->Pagination}";
          

            $connection = connection::connect();
            $query = $connection->query($sql);

            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());

        } catch (PDOException $e) {
            dd($e->getMessage());

            
        }
    }
       public function findBy(string $field = '', string $value = '')
       {
            try {

                $sql = (!$this->filters) ? 
                    "SELECT {$this->fields} FROM {$this->table} WHERE {$field} = :{$field}":
                    "SELECT {$this->fields} FROM {$this->table} {$this->filters}";

                $connection = connection::connect();
                
                $prepare = $connection->prepare($sql);

                $prepare->execute(!$this->filters ? [$field => $value] : []);

                return $prepare->fetchObject(get_called_class());

            } catch (PDOException $e) {
               dd($e->getMessage());

                
            }
       }



       public function first($field = 'id', $order = 'asc')
       {
            try {

               $sql= "SELECT {$this->fields} FROM {$this->table} ORDER BY {$field} {$order}  LIMIT 1";
                
               $connection = connection::connect();
            
               $query = $connection->query($sql);
               
               return $query->fetchObject(get_called_class());
            
            } catch (PDOException $e) {
                dd($e->getMessage());
            }
       }

    
       //delete frm users where id =12 = paramentro que se usa para deleta USERS
       //$user->delete('id', "valor" = 12); -> funcao parra chama oo delete e indicar, quem tem que ser excluido.

       public function delete(string $field = ' ', string|int $value = '')
       {
            try {

                $sql = (Empty($this->filters)) ? 
                    "delete FROM {$this->table} WHERE {$field} = :{$field}" :
                    "delete FROM {$this->table} {$this->filters}";
                //dd($sql);

                $connection = connection::connect();
                
                $prepare = $connection->prepare($sql);

                return $prepare->execute(empty($this->filters) ? [$field => $value] : []);
                
            } catch (PDOException $e) {
            dd($e->getMessage());

                
            }
       }
       
       //metodo para contar total de ID no banco de dados 
       public function count()
       {
        try {

            $sql= "SELECT {$this->fields} FROM {$this->table} {$this-> filters}";
             
            $connection = connection::connect();
         
            $query = $connection->query($sql);
            
            return $query->rowCount();
         } catch (PDOException $e) {
             dd($e->getMessage());
         }
       }




}


