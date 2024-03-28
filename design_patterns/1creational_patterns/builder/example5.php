<?php

interface QueryBuilderInterface
{
    public function select(string $tablename);

    public function limit(int $limit, int $offset);

    public function getSql(): string;
}

class MysqlBuilder implements QueryBuilderInterface
{
    public $query;

    protected function reset(): void
    {
        $this->query = new stdClass();
    }

    public function select(string $tablename)
    {

        $this->query->select = 'select * from' . $tablename;
        return $this;
    }

    public function limit(int $limit, int $offset)
    {
        $this->query->limit = 'offset' . $offset . 'limit' . $limit . ';';

        return $this;
    }

    public function getSql(): string
    {
        $query =$this->query->select . $this->query->limit;
        $this->reset();
        return $query;
    }
}

class PgBuilder extends MysqlBuilder
{
    public function limit(int $limit, int $offset)
    {
        $this->query = 'limit' . $limit . 'offset' . $offset . ';';
    }
}

$mysql = new MysqlBuilder();
$query = $mysql->select('test')->limit(1, 10)->getSql();
var_dump($query);