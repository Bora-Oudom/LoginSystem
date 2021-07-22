<?php 
class Crud{
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function readAllProduct()
    {
        $this->db->query("SELECT * FROM product ");
        $results = $this->db->resultSet();
        return $results;
    }
    
    public function readSingleProduct($id)
    {
       
        $this->db->query("SELECT * FROM product WHERE pro_id = :id");

        $this->db->bind(':id',$id);

        $row = $this->db->single();

        return $row;
        
    }

    public function creadeProduct($data)
    {
        //prepare statement
        $this->db->query("INSERT INTO product(name, price, qty)
                VALUES(:name, :price, :qty)");

        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':qty', $data['qty']);

        //exeute the function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateProduct($data)
    {
        
                           
        //prepare statement
        $this->db->query("UPDATE product SET name = :name, price = :price, qty = :qty WHERE pro_id = :id");

        //bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':qty', $data['qty']);

        //exeute the function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function deleteProduct($data)
    {

        //prepare statement
        $this->db->query("DELETE FROM product WHERE pro_id = :id");
       
         //bind values
         $this->db->bind(':id', $data['id']);

        //exeute the function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}