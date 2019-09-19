<?php

class Categories
{

	public function __construct($db) 
    {
        $this->db = $db;    
	}

	public function getCategories() 
    {
        $query = "SELECT id, category FROM categories";
        $sth = $this->db->prepare($query);
        $sth->execute();
        return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public function getQuestionsAndCategories() 
    {
        $query = "SELECT questions.id, questions.question, questions.author,
        questions.email, questions.answer, questions.category_id,
        questions.visibility, questions.date_added, categories.category 
        FROM questions INNER JOIN categories ON questions.category_id = categories.id";
        $sth = $this->db->prepare($query);
        $sth->execute(); 
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public function getQuestionsByCat($category) 
	{
		$query = "SELECT questions.question, questions.answer, categories.category 
		FROM questions INNER JOIN categories 
		ON questions.category_id = categories.id 
		WHERE visibility = 1 and categories.category = ?";
		$sth = $this->db->prepare($query); 
		$sth->bindValue(1, $category, PDO::PARAM_STR);
		$sth->execute(); 
		return $result = $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public function deleteCategory($id) 
	{
		$query = "DELETE FROM categories WHERE id = ?; DELETE FROM questions WHERE category_id = ?";
		$sth = $this->db->prepare($query);
		$sth->bindValue(1, $id, PDO::PARAM_INT);
		$sth->bindValue(2, $id, PDO::PARAM_INT);
		return $sth->execute();
	}

	public function addCategory($category) 
	{
		$query = "INSERT INTO categories (category) VALUES (?)";
		$sth = $this->db->prepare($query);
		$sth->bindValue(1, $category, PDO::PARAM_STR);
		return $sth->execute();
    }
    
	public function updateCategory($id, $category) 
	{
		$query = "UPDATE categories SET category = ? WHERE id = ?";
		$sth = $this->db->prepare($query);
		$sth->bindValue(1, $category, PDO::PARAM_STR);
		$sth->bindValue(2, $id, PDO::PARAM_INT);
		return $sth->execute();
    }

}

?>