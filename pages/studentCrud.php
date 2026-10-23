<?php

namespace pages\studentCrud;

session_start();

$_SESSION['text'] = null;
$_SESSION['email'] = null;
$_SESSION['phone'] = null;
$_SESSION['dataAdded'] = null;


require_once __DIR__ . '/dbc.php';

use  pages\dbc\dbc;

$u_id = isset($_REQUEST['u_id']) ? $_REQUEST['u_id'] : null;


class Crud extends dbc
{

    public $dbcon;

    function __construct()
    {
        $this->dbcon = $this->connect();
        if ($this->dbcon) {
            // echo "data base connected";
        }
    }


    function validationText($text)
    {

        // Name validation
        if (empty($text)) {
            $_SESSION['text'] = "Name is required.";
        } elseif (!preg_match("/^[a-zA-Z\s.'-]+$/", $text)) {
            $_SESSION['text'] = "Please enter a valid name.";
        } else {
            return $text;
        }
    }


    function validationPhone($phone)
    {
        if (preg_match('/^(?:01[3-9]\d{8}|\+8801[3-9]\d{8})$/', $phone)) {
            // $_SESSION['phone'] = 'all ok';
            return $phone;
        } else {

            $_SESSION['phone'] = "please add valid number";
        }
    }


    // function validationUpPhone($phone,$id)
    // {
    //     if (preg_match('/^(?:01[3-9]\d{8}|\+8801[3-9]\d{8})$/', $phone)) {
    //         // $_SESSION['phone'] = 'all ok';
    //         return $phone;
    //     } else {
    //         //return 2222;
    //         $_SESSION['phone'] = "please add valid number";
    //         header("Location:http://localhost/student/pages/udt.php?u_id=".$id);

    //         // header("Location: update.php?id=" . $id);
    //         // exit;
    //         // exit;
    //     }
    // }


    function validationEmail($email)
    {

        if (empty($email)) {
            $_SESSION['email'] = "Please fill the email input";
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email'] = "Invalid email format";
            return false;
        }


        $sql = "SELECT email FROM student_info WHERE email = ?";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() <= 0) {
            return $email;
        } else {
            $_SESSION['email'] = "Already registered with this email";
            return false;
        }
    }



    // Add student information
    function info_add(
        $name,
        $email,
        $number,
        $course,
        $roll,
        $password,
        $photos,
        $about

    ) {


        //genaret student id
        $sql = "SELECT * FROM student_info ORDER BY id DESC LIMIT 1";
        $rollGenarate  = $this->dbcon->prepare($sql);
        $rollGenarate->execute();
        $Genarate = $rollGenarate->fetch();

        $genarateRoll = str_pad($Genarate['id'] + 1, 6, '0', STR_PAD_LEFT);

        // $genarateRoll = $genarateRoll +1;
        // echo"<br/>".   $genarateRoll ;
        // echo "all ok";
        // exit();

        if ($genarateRoll) {
            // echo  $genarateRoll ;
            // echo "ok ".$other;
            // return ;

            // Your INSERT 
            $sql_inser = "INSERT INTO student_info (studentRoll,name,email,number,course,roll,password,photos,about) 
            VALUES('$genarateRoll','$name','$email','$number','$course','$genarateRoll','$password','$photos','$about')";

            $this->dbcon->exec($sql_inser);

            $_SESSION['dataAdded'] = "successfully student data added";
        }
    }


    function show()
    {
        $sql = "SELECT * FROM student_info ORDER BY id DESC";
        $result = $this->dbcon->query($sql);
        return $result;
    }


    function delete($s_id)
    {
        $sql = "DELETE FROM student_info WHERE id=$s_id";
        $this->dbcon->exec($sql);
        if ($this->dbcon) {
            //echo " deleted successfully";
            header("location:http://localhost/student");
        } else {
            echo "Error deleting data: ";
        }
    }


    function find($s_id)
    {
        $sql = "SELECT * FROM student_info WHERE id = $s_id";
        $result = $this->dbcon->query($sql);
        return $result;
    }


    function updatedata($name, $email, $course, $number, $roll, $photos, $about, $hiddenid)
    {
        // if (is_array($other)) {
        //     $other = implode(',', $other);
        // }
        echo "all updated";
      

        $sql = "UPDATE student_info
                    SET name='$name',
                        email='$email',
                        course='$course',
                        number='$number',
                        roll='$roll',
                        photos='$photos',
                        about='$about'
                    WHERE id=$hiddenid";

                    

        // $errors['update'] = "data update success";
        $_SESSION['errors']['update']='data update success';
       
        header(
            "Location:/student/pages/updateForm.php?u_id="
                . urlencode($hiddenid)
        );

        if ($this->dbcon->query($sql)) {
            // echo "data update success";
            // header("location:http://localhost/student");
        }
    }
}
