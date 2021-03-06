<?php
namespace ZfcDatagrid\DataSource;

use ZfcDatagrid\Column;
use Zend\Paginator\Adapter\DbSelect as PaginatorAdapter;
use Zend\Db\Sql;

class ZendSelect extends AbstractDataSource
{

    /**
     *
     * @var Sql\Select
     */
    private $select;

    /**
     *
     * @var \Zend\Db\Sql\Sql
     */
    private $sqlObject;

    /**
     * The data result
     *
     * @var PaginatorAdapter
     */
    private $paginatorAdapter;

    /**
     * Data source
     *
     * @param mixed $data            
     */
    public function __construct($data)
    {
        if ($data instanceof Sql\Select) {
            $this->select = $data;
        } else {
            throw new \InvalidArgumentException('A instance of Zend\Db\SqlSelect is needed to use this dataSource!');
        }
    }

    /**
     *
     * @return Sql\Select
     */
    public function getData()
    {
        return $this->select;
    }

    public function setAdapter($adapterOrSqlObject)
    {
        if ($adapterOrSqlObject instanceof \Zend\Db\Sql\Sql) {
            $this->sqlObject = $adapterOrSqlObject;
        } elseif ($adapterOrSqlObject instanceof \Zend\Db\Adapter\Adapter) {
            $this->sqlObject = new \Zend\Db\Sql\Sql($adapterOrSqlObject);
        } else {
            throw new \InvalidArgumentException('Object of "Zend\Db\Sql\Sql" or "Zend\Db\Adapter\Adapter" needed.');
        }
    }

    /**
     *
     * @return \Zend\Db\Sql\Sql
     */
    public function getAdapter()
    {
        return $this->sqlObject;
    }

    public function execute()
    {
        if ($this->sqlObject === null || ! $this->sqlObject instanceof \Zend\Db\Sql\Sql) {
            throw new \Exception('Object "Zend\Db\Sql\Sql" is missing, please call setAdapter() first!');
        }
        
        $select = $this->select;
        
        /**
         * Step 1) Apply needed columns
         */
        $selectColumns = array();
        foreach ($this->columns as $column) {
            if ($column instanceof Column\Standard && ! $column->hasDataPopulation()) {
                // $colString = $column->getSelectPart1();
                // if ($column->getSelectPart2() != '') {
                $colString = $column->getSelectPart2();
                // }
                // $colString .= ' as ' . $column->getUniqueId();
                
                $selectColumns[$column->getUniqueId()] = $colString;
            }
        }
        $select->columns($selectColumns);
        
        /**
         * Step 2) Apply sorting
         */
        if (count($this->getSortConditions()) > 0) {
            // Minimum one sort condition given -> so reset the default orderBy
            $select->reset(Sql\Select::ORDER);
            
            foreach ($this->getSortConditions() as $sortCondition) {
                $column = $sortCondition['column'];
                $select->order($column->getUniqueId() . ' ' . $sortCondition['sortDirection']);
            }
        }
        
        /**
         * Step 3) Apply filters
         */
        $filterColumn = new ZendSelect\Filter($this->getAdapter(), $select);
        foreach ($this->getFilters() as $filter) {
            
            /* @var $filter \ZfcDatagrid\Filter */
            if ($filter->isColumnFilter() === true) {
                $filterColumn->applyFilter($filter);
                
                
            }
        }
        
        /**
         * Step 4) Pagination
         */
        $this->setPaginatorAdapter(new PaginatorAdapter($select, $this->sqlObject));
    }
}
