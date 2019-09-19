<?php



class Suggestions
{

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getSuggestion($id)
    {
        $query = "SELECT id, username, question, suggestion, email, date, category_id FROM suggestions WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSuggestions()
    {
        $query = "SELECT suggestions.id, suggestions.question, suggestions.username,
        suggestions.email, suggestions.suggestion, suggestions.category_id,
        suggestions.date, categories.category 
        FROM suggestions INNER JOIN categories ON suggestions.category_id = categories.id";
        $sth = $this->db->prepare($query);
        $sth->execute(); 
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function giveSuggestion($question_id, $username, $question, $suggestion, $email, $category_id)
    {
        $query = "INSERT INTO suggestions (question_id, username, question, suggestion, date, email, category_id) VALUES (?, ?, ?, ?, now(), ?, ?)";
		$sth = $this->db->prepare($query); 
		$sth->bindValue(1, $question_id, PDO::PARAM_INT);
		$sth->bindValue(2, $username, PDO::PARAM_STR);
		$sth->bindValue(3, $question, PDO::PARAM_STR);
        $sth->bindValue(4, $suggestion, PDO::PARAM_STR);
        $sth->bindValue(5, $email, PDO::PARAM_STR);
        $sth->bindValue(6, $category_id, PDO::PARAM_STR);
		return $sth->execute(); 
    }

    public function updateSuggestion($id, $question, $username, $email, $suggestion) 
    {
        $query = "UPDATE suggestions SET question = ?, username = ?, email = ?, suggestion = ? WHERE id = ?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $question, PDO::PARAM_STR);
        $sth->bindValue(2, $username, PDO::PARAM_STR);
        $sth->bindValue(3, $email, PDO::PARAM_STR);
        $sth->bindValue(4, $suggestion, PDO::PARAM_STR);
        $sth->bindValue(5, $id, PDO::PARAM_INT);
        return $sth->execute(); 
    }

    public function deleteSuggestion($id)
    {
        $query = "DELETE FROM suggestions WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        return $sth->execute();
    }

    private function getQuestionIdBySuggestion($id)
    {
        $query = "SELECT question_id FROM suggestions WHERE id=?";
        $sth = $this->db->prepare($query);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function publishSuggestion($id)
    {   
        $suggestion_info = $this->getSuggestion($id);
        
        $question = $suggestion_info[0]['question'];
        $answer = $suggestion_info[0]['suggestion'];

        $question_id = $this->getQuestionIdBySuggestion($id)[0]['question_id'];

        $query = "UPDATE questions SET question = ?, answer = ?, visibility = 1 WHERE id = ?; DELETE FROM suggestions WHERE id=?";
		$sth = $this->db->prepare($query);
		$sth->bindValue(1, $question, PDO::PARAM_STR);
        $sth->bindValue(2, $answer, PDO::PARAM_STR);
        $sth->bindValue(3, $question_id, PDO::PARAM_INT);
        $sth->bindValue(4, $id, PDO::PARAM_INT);
		return $sth->execute();
    } 
}