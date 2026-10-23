<?php
// session_start();
require_once __DIR__ . '/studentCrud.php';

use  pages\studentCrud\Crud;

$crud = new Crud();

$errors = [];


if (isset($_POST['submit'])) {

    $hiddenId = $_POST['hiddenId'];
    $name = trim($_POST['name']);
    $email = $_POST['email'];
    $number = $_POST['number'];
    $course = $_POST['course'];
    $roll = $_POST['roll'];
    $about = $_POST['about'];

    $oldImg = $_POST['oldImg'];
    global $fnm;

    $FileTypeChek = false;
    $validation = true;
    $errors = [];
    //    $_SESSION[errors];
    //   echo $_SESSION[errors]['name'];



    if (empty($name)) {
        $errors['name'] = "Name is required";
        $validation = false;
    } else {
        if (!preg_match("/^[a-zA-Z ]{3,50}$/", $name)) {
            $errors['name'] = "Name must contain 3-50 letters";
            $validation = false;
        }
    }


    if (empty($number)) {
        $errors['number'] = "Phone number is required";
        $validation = false;
    } else {

       
        if (!preg_match('/^(?:01[3-9]\d{8}|\+8801[3-9]\d{8})$/', $number)) {
            $errors['number'] = "Invalid phone number";
            $validation = false;
        }
    }

    $_SESSION['errors'] = $errors;

    if ($name && $number && $validation) {


        if (isset($_FILES['photos'])) {

            $photos = $_FILES['photos'];
            $tmp = $photos['tmp_name'];
            $namee = $photos['name'];
            // $nm = explode('.', $namee);

            $pname = pathinfo($photos['name'], PATHINFO_FILENAME);
            $extension = pathinfo($photos['name'], PATHINFO_EXTENSION);



            if (
                isset($_FILES['photos']) &&
                $_FILES['photos']['error'] !== UPLOAD_ERR_NO_FILE
            ) {

                var_dump($_FILES['photos']);
                echo "new imgae" . $pname;

                $imgType = ['jpg', 'png', 'webp', 'jpeg'];


                if (in_array($extension, $imgType)) {

                    echo "thant is  work";
                    echo  $fnm = $pname . '_' . time() . '.' . $extension;

                    move_uploaded_file($tmp, "../photos/" . $fnm);

                    $FileTypeChek = true;
                } else {
                  
                    $_SESSION['fileType'] = " allowed file type :'jpg','png','webp','jpeg'";
                    $FileTypeChek = false;
                }
            } else {

                 $fnm = $oldImg;
                 $FileTypeChek = true;
            };
        }


        if ($FileTypeChek) {

            $crud->updatedata($name, $email, $course, $number, $roll,  $fnm, $about,  $hiddenId);
        }
    } else {
        // $u_id = $_REQUEST['u_id'] ?? null;

        header(
            "Location:/student/pages/updateForm.php?u_id=" . $hiddenId
        );
        exit;
    }
};
