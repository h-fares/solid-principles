<?php

// ? In this example we make an DB interface

interface DB
{
    /**
     * @return mixed
     */
    public function connect();
}

class MySQL implements DB
{
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $type;

    /**
     * @param $mySql
     */
    public function __construct($mySql) {
        $this->host = $mySql['host'];
        $this->port = $mySql['port'];
        $this->username = $mySql['username'];
        $this->password = $mySql['password'];
        $this->type = $mySql['type'];
    }

    /**
     * @return mixed|void
     */
    public function connect() {
        // * Do stuff to connect just SQL DB.
    }
}

class MongoDB implements DB
{
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $type;

    /**
     * @param $mongo
     */
    public function __construct($mongo) {
        $this->host = $mongo['host'];
        $this->port = $mongo['port'];
        $this->username = $mongo['username'];
        $this->password = $mongo['password'];
        $this->type = $mongo['type'];
    }

    /**
     * @return mixed|void
     */
    public function connect() {
        // * Do stuff to connect just mongoDB.
    }
}

class DBConnection
{
    /**
     * @param  DB  $DB
     */
    public function connect(DB $DB) {
        // ? If $DB is MySQL: connect() in MySQL will be called
        // ? If $DB is MongoDB: connect() in MongoDB will be called
        // ? If we add another type of DB, we have to make implements from DB and implement a new connect() method in the new class
        $DB->connect();
    }
}