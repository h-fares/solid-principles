<?php

// ? In this example we have SQL class and DBConnection class to connect DB.
class MySQL {
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $type;

    public function __construct($mySql) {
        $this->host = $mySql['host'];
        $this->port = $mySql['port'];
        $this->username = $mySql['username'];
        $this->password = $mySql['password'];
        $this->type = $mySql['type'];
    }
}

// ? The problem is: if we have another DB type like mongoDB we have to write another mongoDB class and expand connect() methode in DBConnection class.
// ? This problem can be bigger: every time we have a new type of DB we have to expand connect() method
// ? Like that:

class MongoDB {
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $type;

    public function __construct($mongo) {
        $this->host = $mongo['host'];
        $this->port = $mongo['port'];
        $this->username = $mongo['username'];
        $this->password = $mongo['password'];
        $this->type = $mongo['type'];
    }
}


class DBConnection {
    public function connect($DB) {
        // * Do stuff to connect just SQL DB.

        // * Expanding this method after adding a new DB type:
        if(is_a($DB, 'MySQL')){
            // * Do stuff to connect just SQL DB.
        } else if(is_a($DB, 'MongoDB')) {
            // * Do stuff to connect just mongoDB.
        }
    }
}