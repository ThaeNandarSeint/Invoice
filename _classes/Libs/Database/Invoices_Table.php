<?php

namespace Libs\Database;

use PDOException;

class Invoices_Table {
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data){
        try{
            $query = "INSERT INTO invoices (quantity, name, phone, address, payment, item_id, item_title, item_price)
                        VALUES(:quantity, :name, :phone, :address, :payment, :item_id, :item_title, :item_price)";
            
            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();

        } catch(PDOException $th){
            var_dump($th->getMessage());
            return false;
        }
    }

    public function getAll(){
        try{
            $query = "SELECT * FROM invoices";
            $statement = $this->db->query($query);
            return $statement->fetchAll();

        }catch(PDOException $th) {
            var_dump($th->getMessage());
            return false;
        }
    }

    public function getById($id){
        try{
            $query = "SELECT * FROM invoices WHERE invoices.id=$id";
            $statement = $this->db->query($query);
            return $statement->fetch();
        }catch(PDOException $th){
            var_dump($th->getMessage());
            return false;
        }
    }

    public function getByItem($id) {
        try{
            $query = "SELECT * FROM invoices WHERE item_id = $id";
            $statement = $this->db->query($query);
            return $statement->fetchAll();
        } catch(PDOException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    public function edit($id,$data){
        try{
            $query = "UPDATE invoices SET
                        quantity = :quantity,
                        name = :name,
                        phone = :phone,
                        address = :address,
                        payment = :payment,
                        item_id = :item_id,
                        item_title = :item_title,
                        item_price = :item_price
                            WHERE id=$id";
            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $statement->rowcount();

        }catch(PDOException $th){
            var_dump($th->getMessage());
            return false;
        }
    }

    public function delete($id){
        try{
            $query = "DELETE FROM invoices WHERE id=$id";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->rowCount();
            
        }catch(PDOException $th){
            var_dump($th->getMessage());
            return false;
        }
    }

    public function test(){
        try{
            $query = "SELECT *
            FROM invoices
            LEFT JOIN items
            ON invoices.item_id = items.id";
            $statement = $this->db->query($query);
            return $statement->fetchAll();
        }catch(PDOException $th){
            var_dump($th->getMessage());
            return false;
        }
    }
}