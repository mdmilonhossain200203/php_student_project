<?php


namespace pages\courseCrud;


require_once __DIR__ . '/dbc.php';

use  pages\dbc\dbc;

class  courseCrud extends dbc
{

    public $dbcon;

    public function __construct()
    {
        $this->dbcon = $this->connect();
    }

    public function courseAdd($courseName)
    {

        if ($courseName) {
            $sql = "SELECT course FROM course WHERE course= ?";
            $query = $this->dbcon->prepare($sql);
            $query->execute([$courseName]);
            $results =  $query->fetch();
            // echo  $results->rowCount();

            if ($results) {
                $_SESSION["exitCourse"] = "this course already exist";
            } else {
                $sql = "INSERT INTO course(course) VALUES('$courseName')";
                $this->dbcon->exec($sql);
                $_SESSION['course'] = "course added";
            }
        }
    }



    public function findCourse()
    {
        $sql = "SELECT * FROM course";
        $query = $this->dbcon->prepare($sql);
        $query->execute();

        return $query;
    }


    public function courseUpdate($courseName, $id)
    {

        $sql = "SELECT course FROM course WHERE course= ?";

        $query = $this->dbcon->prepare($sql);
        $query->execute([$courseName]);

        if ($query->rowCount() <= 0) {
            // echo "this couse not ableable";

            $sql = "UPDATE course SET course ='$courseName' WHERE id= ?";
            $query = $this->dbcon->prepare($sql);
            $query->execute([$id]);
        } else {

            // $res = $query->fetch();
            // return $res['course'];

            $_SESSION["exitCourse"]= "this course already exist";
        }
    }


    public function delete($id)
    {

        $sql = "DELETE FROM course WHERE id= ?";
        $query = $this->dbcon->prepare($sql);
        $query->execute([$id]);
    }


    ///if need chek 


    public function findCheck($id)
    {
        $sql = "SELECT course FROM course WHERE id= ?";

        $query = $this->dbcon->prepare($sql);
        $query->execute([$id]);

        if ($query->rowCount() <= 0) {
            echo "this couse not ableable";
        } else {

            $res = $query->fetch();

            return $res['course'];
        }
    }
}

