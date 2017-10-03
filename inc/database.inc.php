<?php

    class Database
    {
        private $servername;
        private $username; //root
        private $password; //
        private $database;

        public $connection = null;

        function __construct()
        {
            $this->servername = "localhost";
            $this->username = "root"; //root
            $this->password = "root"; //
            $this->database = "localhost";

            $this->connect();
        }

        function execute($query)
        {
            return($this->connection->query($query));
        }

        function connect()
        {
            try
            {
                $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
            }

            catch(Exception $e)
            {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }

        function verify()
        {
            if ($this->connection->connect_error) {
               return false;
            }

            return true;
        }

        function disconnect()
        {
            $this->connection->close();
        }

        function __destruct()
        {
            $this->connection->close();
        }
    }    
?>