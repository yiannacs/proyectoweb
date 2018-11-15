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
                // Add entry to loans table
                $today = date('d-m-Y');
                $loanDays = "+" . $loanDurn . " days";
                $endOfLoan = strtotime($loanDays, strtotime($today));
                $dueDate = date('Y-m-d', $endOfLoan);

                $statement = $this->Db->prepare (
                    "INSERT INTO loans (orderId, item, quantity, dueDate)
                    VALUES (:orderId, :item, :quantity, :dueDate)");
                $statement->bindparam(":orderId", $orderId);
                $statement->bindparam(":item", $itemId);
                $statement->bindparam(":quantity", $quantity);
                $statement->bindparam(":dueDate", $dueDate);
                $statement->execute();

                // Update available in stock
                //Update available in stock table
                $statement = $this->Db->prepare("SELECT available FROM stock WHERE id=:itemId");
                $statement->bindparam(":itemId", $itemId);
                $statement->execute();
                $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

                $q = $dataRows['available'];
                $q = $q - $quantity;

                $statement = $this->Db->prepare("UPDATE stock SET available=:q WHERE id=:itemId");
                $statement->bindparam(":q", $q);
                $statement->bindparam(":itemId", $itemId);
                $statement->execute();
                // echo $createdOrder;
                return true;
            }
            catch (PDOException $ex) {
                // echo $ex->getMessage();
                return false;
            }
        }

        public function getUserOrders($username, $filter){
            try{
                $returned = '';
                if ($filter == 'none') {
                    $returned = '';
                }
                $stm = "SELECT id, timestamp, returned FROM orders WHERE student=:student " . $returned;
                $statement = $this->Db->prepare($stm);
                $statement->bindparam(":student", $username);
                $statement->execute();

                $dataRows = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $dataRows;
            } catch (PDOException $ex){
                // echo $ex->getMessage();
                return false;
            }
        }

        public function getAllOrders($filter){
            try{
                $returned = '';
                if ($filter == 'none') {
                    $returned = '';
                }
                $stm = "SELECT id, student, timestamp, returned FROM orders " . $returned;
                $statement = $this->Db->prepare($stm);
                $statement->execute();

                $dataRows = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $dataRows;
            } catch (PDOException $ex){
                // echo $ex->getMessage();
                return false;
            }
        }

        public function getOrderLoans($order){
            try{
                $statement = $this->Db->prepare("SELECT loans.id, loans.item, stock.description, loans.quantity, loans.dueDate, loans.returned FROM loans INNER JOIN stock ON loans.item=stock.id WHERE loans.orderId=:orderId");
                $statement->bindparam(":orderId", $order);
                $statement->execute();

                $dataRows = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $dataRows;
            } catch (PDOException $ex){
                // echo $ex->getMessage();
                return false;
            }
        }

        public function returnItem($loan){
            try{
                // Get current $quantity
                $statement = $this->Db->prepare("SELECT item, quantity, orderId FROM loans WHERE id=:loan");
                $statement->bindparam(":loan", $loan);
                $statement->execute();
                $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

                $orderId = $dataRows['orderId'];
                $item = $dataRows['item'];
                // Update with decremented $quantity
                // $q = $dataRows[0]->quantity;
                $q = $dataRows['quantity'];
                if ($q > 0){
                    $q = $q - 1;
                }
                // if value is now zero, set as $returned
                $returned = 0;
                if ($q == 0) {
                    $returned = 1;
                }

                // Send change to loans table
                $statement = $this->Db->prepare("UPDATE loans SET quantity=:q, returned=:r WHERE id=:loan");
                $statement->bindparam(":q", $q);
                $statement->bindparam(":r", $returned);
                $statement->bindparam(":loan", $loan);
                $statement->execute();

                // if this item was the last to be returned, set order as done
                $statement = $this->Db->prepare("SELECT returned FROM loans WHERE orderId=:orderId AND returned=0");
                $statement->bindparam(":orderId", $orderId);
                $statement->execute();
                $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

                if(!(is_array($dataRows))) {
                    $statement = $this->Db->prepare("UPDATE orders SET returned=1 WHERE id=:orderId");
                    $statement->bindparam(":orderId", $orderId);
                    $statement->execute();
                }

                //Update available in stock table
                $statement = $this->Db->prepare("SELECT available, total FROM stock WHERE id=:itemId");
                $statement->bindparam(":itemId", $item);
                $statement->execute();
                $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

                $q = $dataRows['available'];
                $total = $dataRows['total'];
                if ($q < $total) {
                    $q = $q + 1;

                    $statement = $this->Db->prepare("UPDATE stock SET available=:q WHERE id=:itemId");
                    $statement->bindparam(":q", $q);
                    $statement->bindparam(":itemId", $item);
                    $statement->execute();
                }

                return true;
            } catch (PDOException $ex){
                // echo $ex->getMessage();
                return false;
            }
        }
    }
?>
