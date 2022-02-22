<?php

namespace Libs\Database;

use PDOException;

class Items_Table
{
    private $db = null;

    public function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data)
    {
        try {
            $query = "INSERT INTO items (
                title, image, price
                ) VALUES (
                    :title, :image, :price
                )";

            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $th) {
            var_dump($th->getMessage());
            return false;
        }
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM items";
            $statement = $this->db->query($query);
            return $statement->fetchAll();
        } catch (PDOException $th) {
            var_dump($th->getMessage());
            return false;
        }
    }

    public function getById($id)
    {
        try {
            $query = "SELECT items.* FROM items WHERE items.id=$id";
            $statement = $this->db->query($query);
            return $statement->fetch();
        } catch (PDOException $th) {
            var_dump($th->getMessage());
            return false;
        }
    }

    public function getByCategory($category_id) {
        try{
            $query = "SELECT * FROM items WHERE items.category_id = $category_id";
            $statement = $this->db->query($query);
            return $statement->fetchAll();
        } catch(PDOException $e){
            var_dump($e->getMessage());
            return false;
        }
    }

    public function edit($id, $data)
    {
        try {
            $query = "UPDATE items SET 
                title=:title,
                image=:image, 
                price=:price
                    WHERE id=$id";

            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $statement->rowCount();
        } catch (PDOException $th) {
            var_dump($th->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "DELETE FROM items WHERE id=$id";
            $statement = $this->db->prepare($query);
            $statement->execute();
            return $statement->rowCount();
        } catch (PDOException $th) {
            var_dump($th->getMessage());
            return false;
        }
    }
}
