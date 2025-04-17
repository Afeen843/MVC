<?php

namespace App\Models;


class QueryBuilder
{
    protected \PDO $pdo;
    protected string $tableName;
    protected string|array $select = "*";
    protected string $query;
    protected array $params = [];
    protected array $where = [];
    protected ?array $orderBy = null;
    protected ?int $limit = null;
    protected ?int $offset = null;
    protected array $set = [];

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance();
    }

    public function update($data)
    {
        $setValues = [];
        foreach ($data as $key => $value) {
            $setValues[] = "$key = :update_$key";
            $this->params["update_$key"] = $value;
        }
        $setValues = implode(", ", $setValues);
        $this->query = "UPDATE $this->tableName SET $setValues ";
        $this->buildWhere();
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->rowCount();

    }
    public function table(string $tableName): QueryBuilder
    {
        $this->tableName = $tableName;
        return $this;
    }
    public function select(string|array $select = '*'): QueryBuilder
    {
        $this->select = is_array($select) ? implode(', ',$select) : $select;
        return $this;
    }

    public function get()
    {

        $this->buildSelect();
        $this->buildWhere();
        $this->buildOrderBy();
        $this->buildLimitOffset();
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    public function printQuery()
    {
        $this->buildSelect();
        $this->buildWhere();
        $this->buildOrderBy();
        $this->buildLimitOffset();
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->queryString;
    }

    public function first()
    {
        $this->limit(1);
        $result =  $this->get();
        return $result[0] ?? null;
    }

    public function where($column,$operator,$value,$boolean = 'AND'): QueryBuilder
    {
        $this->where[] = [
            'column'=> $column,
            'operator'=> $operator,
            'value' => $value,
            'boolean' => $boolean
        ];

        $this->params["$column"] = $value;

        return $this;
    }

    public function whereOR($column,$operator,$value,$boolean = 'OR'): QueryBuilder
    {
        return $this->where($column,$operator,$value,$boolean);
    }

    public function orderBy($column,$direction = 'ASC'): QueryBuilder
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    private function buildSelect()
    {
        $this->query = "SELECT {$this->select} FROM {$this->tableName}";
    }

    private function buildWhere()
    {
        if(!empty($this->where)) {
            $whereParts = [];
            foreach ($this->where as $index => $where) {
                if($index == 0) {
                    $whereParts[] = "{$where['column']} {$where['operator']} :{$where['column']}";
                }else{
                    $whereParts[] = "{$where['boolean']} {$where['column']} {$where['operator']} :{$where['column']}";
                }
            }
            $this->query .=" Where " . implode(", ", $whereParts);
        }
    }

    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $this->query = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$values})";
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    private function buildOrderBy()
    {
        if(!empty($this->orderBy)) {
            $this->query .= " ORDER BY " . implode(', ', $this->orderBy);
        }
    }

    public function limit(int $limit): QueryBuilder
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): QueryBuilder{
        $this->offset = $offset;
        return $this;
    }

    private function buildLimitOffset()
    {
        if(!empty($this->limit)) {
            $this->query .= " LIMIT {$this->limit}";
        }
        if(!empty($this->offset)) {
            $this->query .= " OFFSET {$this->offset}";
        }
    }

    public function delete()
    {
        $this->query = "DELETE FROM {$this->tableName}";
        $this->buildWhere();
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->rowCount();
    }


}