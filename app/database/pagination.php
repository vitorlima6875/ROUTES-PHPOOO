<?php
namespace   app\database;

class pagination   
{   
    private int $currentPage = 2;
    private int $totalPages;
    private int $linksPerPage = 5;
    private int $intemsPerPages = 10;
    private int $totalItems;
    private string $pageIdentifier = 'page';

    public function setTotalItems(string $totalItems)
    {
        $this->totalItems = $totalItems ;
    }

    public function setPageIdentifier(string $indetfier)
    {
        
        $this->pageIdentifier = $indetfier;
    }

    public function setItemPerPages(string $identifier)
    {
        $this->pageIdentifier = $identifier;
    }
    private function calculations()
    {
        $this->currentPage = $_GET['page'] ?? 1;
        
        $offset = ($this->currentPage - 1) * $this->intemsPerPages;
        
        $this->totalPages = ceil($this->totalItems / $this->intemsPerPages);

        return "limit {$this->intemsPerPages} offset {$offset}";
    }

    public function dump()
    {
        return $this->calculations();
    }

    public function links()
    {
        $links = "<ul class='pagination'>";
        if ($this->currentPage > 2) {
            $previous = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $previous]));
            $links.= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Anterior</a></li>";
            $first = http_build_query(array_merge($_GET, [$this->pageIdentifier => 1]));
            $links.= "<li class='page-item'><a href='?{$first}' class='page-link'>Primeira</a></li>";
        }
        
        // 3 - 5 =     7 + 5 = 12
        for ($i=$this->currentPage - $this->linksPerPage; $i <=$this->currentPage + $this->linksPerPage ; $i++) {
            if ($i > 0 && $i <= $this->totalPages) {
                $class = $this->currentPage === $i ? 'active' : '';
                $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $i]));
                $links.="<li class='page-item {$class}'><a href='?{$linkPage}' class='page-link'>{$i}</a></li>";
            }
        }
        
        if ($this->currentPage < $this->totalPages) {
            $next = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $next]));
            $links.= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Próxima</a></li>";
            $last = http_build_query(array_merge($_GET, [$this->pageIdentifier => $this->totalPages]));
            $links.= "<li class='page-item'><a href='?{$last}' class='page-link'>Última</a></li>";
        }

        

        $links.="</ul>";

        return $links;
    }
    

}