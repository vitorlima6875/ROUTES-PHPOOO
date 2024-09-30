<?php
namespace App\Database;

class filters
{
    private array $filters = [];

    public function where(string $field, string $operator, mixed $value, string $logic = '')
    {
        $formatter = '';

        if (is_array($value)) {
            $formatter = "('" . implode("','", $value) . "')";
        } elseif (is_string($value)) {
            $formatter = "'{$value}'";
        } elseif (is_bool($value)) {
            $formatter = $value ? 1 : 0;
        } else {
            $formatter = $value;
        }

        $value = strip_tags($formatter);
        $this->filters['where'][] = "{$field} {$operator} {$value}";

        // Adiciona o operador lógico (AND/OR) se fornecido
        if (!empty($logic)) {
            $this->filters['where'][] = " {$logic} ";
        }
    }

    public function limit(int $limit)
    {
        $this->filters['limit'] = "LIMIT {$limit}";
    }

    public function orderby(string $field, string $order = 'ASC') 
    {
        $this->filters['order'] = "{$field} {$order}";
    }
        // query para fazer join
        // select * from users left join posts on users.id = posts.useID
    public function join(string $foreigTable, string $jointable1, string $operator, string $joinTable2, string $joinType = 'inner join ')
    {
        $this->filters['join'] [] = "{$joinType} {$foreigTable} on {$jointable1} {$operator} {$joinTable2}";
    }



    public function dump()
    {   
        // Concatenando corretamente as cláusulas WHERE, ORDER BY e LIMIT
        $filters = !empty($this->filters['where']) ? ' WHERE ' . implode(' ', $this->filters['where']) : '';
        $filters = !empty($this->filters['join']) ?  implode(' ', $this->filters['join']) : '';
        $filters.= !empty($this->filters['order']) ? ' ORDER BY ' . $this->filters['order'] : '';
        $filters.= !empty($this->filters['limit']) ? ' ' . $this->filters['limit'] : '';
    
        return $filters;
    }
    

}
