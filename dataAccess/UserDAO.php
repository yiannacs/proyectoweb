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

        public function fetchTable($table)
        {
            try{
                $query = "SELECT * FROM " . $table;
                $statement = $this->Db->prepare($query);
                $statement->execute();
                $dataRows = $statement->fetchAll(PDO::FETCH_ASSOC);

                return $dataRows;

            } catch (PDOException $ex){
                return 0;
                // echo $ex->getMessage();
            }
        }

        public function newOrder($student, $orderSummary) {
            try {
                $statement = $this->Db->prepare (
                    "INSERT INTO orders (student)
                    VALUES (:student)");
                $statement->bindparam(":student", $student);
                $statement->execute();

                $createdOrder = $this->Db->lastInsertId();

                // echo $orderSummary;


                foreach ($orderSummary as $key => $value) {
                    $itemId = $value->item->id;
                    $quantity = $value->quantity;
                    $loanDurn = $value->item->loanLength;

                    $this->newLoan($createdOrder, $itemId, $quantity, $loanDurn);
                    // echo $value->quantity;
                }
                // echo $createdOrder;
                return true;
            }
            catch (PDOException $ex) {
                // echo $ex->getMessage();
                return false;
            }
        }

        public function newLoan($orderId, $itemId, $quantity, $loanDurn){
            try {
                $today = date('d-m-Y');
                // echo $today . "<br>";
                $loanDays = "+" . $loanDurn . " days";
                // echo $loanDays . "<br>";
                $endOfLoan = strtotime($loanDays, strtotime($today));
                $dueDate = date('Y-m-d', $endOfLoan);
                // echo date('d-m-Y', $endOfLoan);
                // $loanDurnStmnt = $this->Db->prepare("SELECT loanLength FROM stock WHERE id=:itemId");
                // $loanDurnStmnt->execute(array(":itemId"=>$itemId));
                // $loanDurn = $loanDurnStmnt->fetch(PDO::FETCH_ASSOC);
                //
                // echo $loanDurn;
                // $curDate = CURDATE();

                $statement = $this->Db->prepare (
                    "INSERT INTO loans (orderId, item, quantity, dueDate)
                    VALUES (:orderId, :item, :quantity, :dueDate)");
                $statement->bindparam(":orderId", $orderId);
                $statement->bindparam(":item", $itemId);
                $statement->bindparam(":quantity", $quantity);
                $statement->bindparam(":dueDate", $dueDate);
                $statement->execute();

                // echo $createdOrder;
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
