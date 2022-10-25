<?php
$path = str_replace('\classes', '', __dir__);
include_once($path . '\interfaces\database.php');

class  db implements database
{

    var $database;
    var $host;
    var $username;
    var $password;
    var $connection;

    function __construct(
        $database,
        $host,
        $username,
        $password
    )
    {
        $this->database = $database;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    function createConnection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=UTF8";

        try {
            $this->connection = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Create function
     * @return void
     */


    function create($tableName, $params)
    {
//        $counter= 0
//        $str = 'insert into '. $tableName.' main_table  set ';
//        foreach($params as $key=>$param){
//            $str .= $key." = ".$param;
//
//            if($counter < count($params)){
//                $str .= ',';
//            }
//            $counter++;
//        }
//        print_r($str);

        //  return $str;

        $tableColumns = implode(",", array_keys($params));
        $tableValues = implode("','", $params);
        $sql = "insert into  $tableName ($tableColumns) Values('$tableValues')";
        $stmt = $this->connection->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);


    }


    /**
     *
     */
    function view($tableName,$id)
    {
    $sql="select *from $tableName where entity_id=$id ";
    $stmt=$this->connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *Update function
     * @return void
     */
    function update($tableName, $params, $id)
    {

        $args = array();
        foreach ($params as $key => $value) {
            $args[] = "$key = '$value'";
        }

        $sql = "UPDATE $tableName SET " . implode(', ', $args) . "WHERE entity_id=$id";
        $stmt= $this->connection->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    /**
     *Delete function
     * @return void
     */
    function delete($tableName, $id)
    {
     $sql="delete from $tableName where entity_id = $id";
     $stmt=$this->connection->query($sql);
     return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Get function
     * @return void
     */
    function getDataById($tableName, $id)
    {

    }

    /**
     * function set
     *
     * @return void
     */

    function setDataById($tableName, $id)
    {

    }


    function showAll($tablename)
    {
        //query methode
        $sql = 'select * from ' . $tablename;
        // $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
        $stmt = $this->connection->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            foreach ($row as $key => $rows) {
                echo $key . '' . $rows;
            }
        }
    }


    function Show2($id)
    {

        //propostional variables
        $sql = 'select * from customers where entity_id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($post as $post) {
            echo print_r($post);
        }


    }

    function namePrams($id, $customers_group)
    {

//        //name pramerters
//        $sql='select * from customers where entity_id=:id';
//        $stmt=$this->connection->prepare($sql);
//        $stmt->execute(['id'=>$id]);
//        $post= $stmt->fetchAll(PDO::FETCH_ASSOC);
//        foreach ($post as $post){
//            var_dump($post);
        //}

        //multiple parameters
        $sql = 'select * from customers where entity_id=:id and customer_group = :customer_group';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'customer_group' => $customers_group
        ]);
        $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($post as $posts) {
            echo '<h1 style="text-align: center">' . $posts['name'] . '</h1>';
        }


    }

    public function show($tableName)
    {
        try {
            $sql = "select * from $tableName";
            $stmt = $this->connection->query($sql);
            $post= $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $post;


        }catch (PDOException $e){
            echo 'hello';
            $e->getMessage();
        }

    }

}



