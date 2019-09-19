<?php

class Users
{

    public $dbname = null;

    public function __construct($dbname)
    {
        $this->db = $dbname;
    }

    public function getUsers()
    {
        $query = "SELECT id, email, login, password FROM users";
		$sth = $this->db->prepare($query); 
		$sth->execute(); 
		return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($username)
    {
        $query = "SELECT id, login, email FROM users WHERE login=?";
        $sth = $this->db->prepare($query); 
        $sth->bindValue(1, $username, PDO::PARAM_STR);
		$sth->execute(); 
		return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeUsername($id, $login)
    {  
        $query = "UPDATE users SET login = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $login, PDO::PARAM_STR);
        $sth->bindValue(2, $id, PDO::PARAM_INT); 
        return $sth->execute(); 
    }

    public function changeEmail($id, $email)
    {  
        $query = "UPDATE users SET email = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $email, PDO::PARAM_STR);
        $sth->bindValue(2, $id, PDO::PARAM_INT); 
        return $sth->execute(); 
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        return $sth->execute();
    }

    public function changePassword($id, $old_pass, $new_pass)
    {
        $password = $this->getPassword($id);
        $user_pass = $password[0]['password'];
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $new_pass, PDO::PARAM_STR);
        $sth->bindValue(2, $id, PDO::PARAM_INT);
        if ($user_pass == $old_pass)
        {
            return $sth->execute(); 
        }
        else 
        {
            return false;
        }
    }

    public function findUsername($login)
    {
        $sth = $this->db->prepare("SELECT id FROM users WHERE login=?");
        $sth->bindValue(1, $login, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findEmail($email)
    {
        $sth = $this->db->prepare("SELECT id FROM users WHERE email=?");
        $sth->bindValue(1, $email, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}