<?php
namespace src;

abstract class Entity
{

    protected $conn;
    protected $tableName;
    protected $fields;

    protected function __construct($db, $tableName)
    {
        $this->conn = $db;
        $this->tableName = $tableName;
        $this->initFields();
    }

    abstract protected function initFields();

    public function findBy($fieldName, $fieldValue)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE {$fieldName} = :value";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['value' => $fieldValue]);

        $data = $stmt->fetch();

        if($data){
            return $this->setValues($this, $data);
        }
    }

    public function findAll($sort = ''){
        $query = "SELECT * FROM {$this->tableName} ";

        if($sort != ''){
            $query .= " ORDER BY id {$sort}";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows =  $stmt->fetchAll(); #PDO::FETCH_OBJ return object instead

        $results = [];
        $class = static::class; // or $this; same result its create current object
        foreach ($rows as  $row) {
            $object = new $class($this->conn);
            $object = $this->setValues($object, $row);
            $results[] = $object;
        }
        // return all rows into array of objects
        return $results;
        #return $this;
    }

    public function sort($column, $sort = 'asc'){
        $query = " ORDER BY ". $column . ' ' . $sort;
        return $this;
    }

    public function setValues($object = null , $value)
    {
        foreach ($object->fields as $field) {
            $object->$field = $value[$field];
        }
        return $object;
    }

    public function update($requests){
        $fieldBindings = [];
        $keyBinding = [];

        foreach ($this->fields as $field) {
            if($field == 'id' || $field == 'created_at'){
                continue;
            }
            $fieldBindings[] = $field . '=:'. $field;
        }

        foreach ($this->fields as $field) {
            if($field == 'id'){
                $keyBinding[$field] = $field . '=:'. $field;
            }
        }

        $fieldBindings = join(',', $fieldBindings);
        $keyBinding = join(',', $keyBinding);

        $query = "UPDATE {$this->tableName} SET {$fieldBindings} WHERE {$keyBinding}";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($requests);
    }

    public function delete($id){
        $query = "DELETE FROM {$this->tableName} WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function create($requests){
        $keys = join(' ,',  array_keys($requests));
        $values = '';
        foreach (array_keys($requests) as $val) {
                $values .= ' :'. $val . ',';
        }
        $values = rtrim($values, ',');

        $query = "INSERT INTO {$this->tableName} ( $keys ) VALUES ( $values ) ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($requests);
    }
}
