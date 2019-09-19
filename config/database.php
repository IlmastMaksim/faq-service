<?php
class Database
{
    public function connect($host, $dbname, $user, $pass) 
    {
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
        }   
        catch(PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }
        return $db;
    }

    public static function test_connection($host, $dbname, $user, $pass) {        
        $link = mysqli_connect($host, $user, $pass) or die('User: ' . $user . ' password: ' . $pass);
        mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
        
        $test_query = "SHOW TABLES FROM $dbname";
        $result = mysqli_query($link, $test_query);
        
        $tblCnt = 0;
        while($tbl = mysqli_fetch_array($result)) {
          $tblCnt++;
        }
        
        if (!$tblCnt) {
          echo "There are no tables<br />\n";
        } else {
          echo "There are $tblCnt tables<br />\n";
        } 
    }
}
?>