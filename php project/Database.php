<?php
class DataBase {
    public $connection;

    public function __construct($config) {
        $config = $config['database'];
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";


            $this->connection = new PDO($dsn, "root", "", [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

    }

    public function query($sql, $params = []) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
}
