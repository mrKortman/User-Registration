<?php
    
    class User
    {   
        private $database;

        private $firstname;
        private $preposition;
        private $lastname;

        public $dob;
        public $function;
        public $address;
        public $postalcode;
        public $city;
        public $username;
        public $password;
        public $salt;
        public $email;
        public $date;
        public $ipaddress;

        public function getFullname()
        {
            echo $this->firstname . " ";

            if(empty($this->preposition))
            {
                echo null;
            }else
            {
                echo $this->preposition . " "; 
            }

            echo $this->lastname;
            
            return($this->firstname . " " . (empty($this->preposition) ? null : $this->preposition . " ")  .  $this->lastname);
        }

        function __construct()
        {
            $this->database = new Database();
        }

        public function login()
        {
            
        }

        public function logout()
        {

        }

        public function register($database, $args)
        {
            // add new row to database
            $this->firstname    = $args["firstname"];
            $this->preposition  = $args["preposition"];
            $this->lastname     = $args["lastname"];
            $this->dob          = $args["dob"];
            $this->function     = $args["function"];
            $this->address      = $args["address"] . " " . $args["housenumber"];
            $this->postalcode   = $args["postalcode"];
            $this->city         = $args["city"];
            $this->username     = $args["username"];
            $this->salt         = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $this->password     = hash('sha256', $args['password'] . $this->salt);
            $this->email        = $args["email"];
            $this->regdate      = date("Y-m-d H:i:s");
            $this->ipaddress    = $_SERVER["REMOTE_ADDR"];
            //print_r($user);

            //Another Password hashing
            for($round = 0; $round < 65536; $round++) 
            { 
                $this->password = hash('sha256', $this->password . $this->salt); 
            }

            $query = sprintf("  INSERT INTO users (firstname, preposition, lastname, dob, function, address, postalcode, city, username, password, salt, email, date, ipaddress) 
                                VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s', '%s', '%s', '%s')", 
                                $this->firstname, 
                                $this->preposition,
                                $this->lastname,
                                date_format(date_create($this->dob), 'Y-m-d'),
                                $this->function,
                                $this->address,
                                $this->postalcode,
                                $this->city,
                                $this->username,
                                $this->password,
                                $this->salt,
                                $this->email,
                                $this->regdate,
                                $this->ipaddress);
                                
            return($database->execute($query));
        }

        public function subscribe(){}

        public function unsubscribe(){}
    }
?>