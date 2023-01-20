<?php

class createDb
{
    public mixed $servername;
    public mixed $username;
    public mixed $password;
    public mixed $dbname;
    public mixed $tablename;
    public mysqli|false $con;

    public function __construct(
        $dbname = "Newdb",
        $tablename = "Productdb",
        $servername = "10.18.1.4",
        $username = "webshop",
        $password = "ChEHiYO@ti0ymBej"
    )
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        $this->con = mysqli_connect($servername, $username, $password);

        if (!$this->con) {
            die("Connection failed : " . mysqli_connect_error());
        }

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        if (mysqli_query($this->con, $sql)) {

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            $sql = "CREATE TABLE IF NOT EXISTS $tablename
            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR (50) NOT NULL,
            product_price FLOAT,
            product_image VARCHAR (100)
            );";

            if (!mysqli_query($this->con, $sql)){
                echo "Error creating table:" . mysqli_error($this->con);
            }
        }
    }

    public function getData(){
        $sql = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}