<?php


class Question 
{

    public function __construct($db) 
    {
        $this->db = $db;
    }

    public function getEmailByUsername($username)
    {
        $query = "SELECT id, email FROM users WHERE login=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $username, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getCategoryIdById($id)
    {
        $query = "SELECT category_id FROM questions WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getQuestionCategories() 
	{
		$query = "SELECT id, category FROM categories";
		$sth = $this->db->prepare($query); 
		$sth->execute(); 
		return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertQuestion($question, $author, $email, $category_id)
    {
        $query = "INSERT INTO questions (question, date_added, author, email, category_id) VALUES (?, now(), ?, ?, ?)";
		$sth = $this->db->prepare($query); 
		$sth->bindValue(1, $question, PDO::PARAM_STR);
		$sth->bindValue(2, $author, PDO::PARAM_STR);
		$sth->bindValue(3, $email, PDO::PARAM_STR);
		$sth->bindValue(4, $category_id, PDO::PARAM_INT);
		return $sth->execute();
	}
	
	public function getQuestion($id)
    {
        $query = "SELECT id, question, author, email, answer FROM questions WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $question, $author, $email, $answer) 
    {
        $query = "UPDATE questions SET question = ?, author = ?, email = ?, answer = ?, visibility = NULL WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $question, PDO::PARAM_STR);
        $sth->bindValue(2, $author, PDO::PARAM_STR);
        $sth->bindValue(3, $email, PDO::PARAM_STR);
        $sth->bindValue(4, $answer, PDO::PARAM_STR);
        $sth->bindValue(5, $id, PDO::PARAM_INT);
        return $sth->execute(); 
    }

    public function updatePublic($id, $question, $author, $email, $answer) 
    {
        $query = "UPDATE questions SET question = ?, author = ?, email = ?, visibility = 1, answer = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $question, PDO::PARAM_STR);
        $sth->bindValue(2, $author, PDO::PARAM_STR);
        $sth->bindValue(3, $email, PDO::PARAM_STR);
        $sth->bindValue(4, $answer, PDO::PARAM_STR);
        $sth->bindValue(5, $id, PDO::PARAM_INT);
        return $sth->execute(); 
    }

    public function changeCategory($id, $category_id) 
    {
        $query = "UPDATE questions SET category_id = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $category_id, PDO::PARAM_STR);
        $sth->bindValue(2, $id, PDO::PARAM_STR);
        return $sth->execute(); 
    }


}