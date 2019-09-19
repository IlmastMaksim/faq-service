<?php 

class Login
{
    public function __construct($db) 
    {
        $this->db = $db;    
    }

    public function isUser($login)
    {
        $sth = $this->db->prepare("SELECT id FROM users WHERE login=?");
        $sth->bindValue(1, $login, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findUser($login, $pass)
    {
        $sth = $this->db->prepare("SELECT id FROM users WHERE login=? and password=?");
        $sth->bindValue(1, $login, PDO::PARAM_STR);
        $sth->bindValue(2, $pass, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function registerUser($email, $login, $pass)
    {
        $query = "INSERT INTO users (email, login, password) VALUES (?, ?, ?)";
		$sth = $this->db->prepare($query); 
		$sth->bindValue(1, $email, PDO::PARAM_STR);
		$sth->bindValue(2, $login, PDO::PARAM_STR);
		$sth->bindValue(3, $pass, PDO::PARAM_STR);
		return $sth->execute();
    }

    public function isAdmin($login)
    {
        $sth = $this->db->prepare("SELECT id FROM admins WHERE login=?");
        $sth->bindValue(1, $login, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findAdmin($login, $pass)
    {
        $sth = $this->db->prepare("SELECT id FROM admins WHERE login=? and password=?");
        $sth->bindValue(1, $login, PDO::PARAM_STR);
        $sth->bindValue(2, $pass, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}