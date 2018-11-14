<?php
    class UserDAO {
        private $Db;

        function __construct($DB_CON)
        {
            $this->Db = $DB_CON;
        }

        // Returns
        //      0 if authentication failed
        //      1 if user is a normal user
        //      2 if user is an admin
        public function authenticateUser($username, $password){
            try{
                $statement = $this->Db->prepare("SELECT * FROM users WHERE id=:uname");
                $statement->execute(array(":uname"=>$username));
                $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

                if ($dataRows['password'] == $password) {
                    if ($dataRows['admin'] == 0) {
                        return 1;
                    } else {
                        return 2;
                    }
                } else { //wrong password
                    return 0;
                }
            } catch (PDOException $ex){
                // echo $ex->getMessage();
            }
        }

        public function addUser($id, $password, $name, $email, $phone) {
            try {
                $statement = $this->Db->prepare (
                    "INSERT INTO users (id, password, name, email, phone)
                    VALUES (:id, :password, :name, :email, :phone)");
                $statement->bindparam(":id", $id);
                $statement->bindparam(":password", $password);
                $statement->bindparam(":name", $name);
                $statement->bindparam(":email", $email);
                $statement->bindparam(":phone", $phone);
                $statement->execute();

                return true;
            }
            catch (PDOException $ex) {
                // echo $ex->getMessage();
                return false;
            }
        }

        // public function createOrder($orderno, $client, $summary, $price){
        //     try{
        //         $statement = $this->Db->prepare(
        //             "INSERT INTO orders (orderno, client, summary, price)
        //             VALUES (:ono, :cl, :sm, :pr)");
        //         $statement->bindparam(":ono",$orderno);
        //         $statement->bindparam(":cl",$client);
        //         $statement->bindparam(":sm",$summary);
        //         $statement->bindparam(":pr",$price);
        //         $statement->execute();
        //
        //         return true;
        //     } catch (PDOException $ex){
        //         echo $ex->getMessage();
        //         return false;
        //     }
        // }
    }
?>
