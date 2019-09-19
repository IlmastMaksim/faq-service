<?php


class Panel
{

    public $db = null;

    public function __construct($db) 
    {
        $this->db = $db;
    }
    
    public function deleteQuestion($id)
    {
        $query = "DELETE FROM questions WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        return $sth->execute();
    }

    public function dispublishQuestion($id)
    {
        $query = "UPDATE questions SET visibility = NULL WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        return $sth->execute();    
    }

    public function updateCategory($id, $category_id)
    {
        $query = "UPDATE questions SET category_id = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $category_id, PDO::PARAM_STR);
        $sth->bindValue(2, $id, PDO::PARAM_INT);
        return $sth->execute();  
    }

    public function publishQuestion($id)
    {
        $query = "UPDATE questions SET visibility = 1 WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        return $sth->execute();
    }

}