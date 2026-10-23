<?php
require_once __DIR__ . '/studentCrud.php';
require_once __DIR__ . '/courseCrud.php';

use pages\courseCrud\courseCrud;
use  pages\studentCrud\Crud;

$courseCrud = new courseCrud;

$crud = new Crud();



if (isset($_POST['submit'])) {
    $name = $crud->validationText(trim($_POST['name']));
    $email = $crud->validationEmail($_POST['email']);
    $number = $crud->validationPhone($_POST['number']);
    $courseId = $_POST['course'];
    $roll = NUll;
    $password = '';
    $about = $_POST['other'] ? $_POST['other'] : null;
    // $other1 = $_POST['other1'] ? $_POST['other1']:1;
    $photos = $_FILES['photos'];
    // print_r($photos);
    $pohotPath = null;


    $course = $courseCrud->findCheck($courseId);


    if ($name && $email && $number && $course) {

        $pohotPath = null;

        if (
            isset($_FILES['photos']) &&
            $_FILES['photos']['error'] === UPLOAD_ERR_OK
        ) {

            $photos = $_FILES['photos'];

            $pname = pathinfo($photos['name'], PATHINFO_FILENAME);

            $extension = pathinfo($photos['name'], PATHINFO_EXTENSION);

            $imgType=['jpg','png','webp','jpeg'];


            if( in_array($extension, $imgType)){

                $pohotPath = $pname . '_' . time() . '.' . $extension;

                move_uploaded_file(
                    $photos['tmp_name'],
                    "../photos/" . $pohotPath
                );
               
            }else{
              
                $_SESSION['fileType']=" allowed file type :'jpg','png','webp','jpeg'";
                $pohotPath = null;
            }

           
        }

        if($pohotPath){
            $add_info = new Crud;

        $add_info->info_add(
            $name,
            $email,
            $number,
            $course,
            $roll,
            $password,
            $pohotPath,
            $about

        );
        }
        
    } else {
        // echo "msut fill the require ";
    }
}
