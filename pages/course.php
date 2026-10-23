<?php
session_start();

require_once __DIR__ . '/courseCrud.php';

use pages\courseCrud\courseCrud;

$course = new courseCrud();

$findCourse = new courseCrud;
$showdCourse = $course->findCourse();


// add course 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {


        $courseName = trim($_POST['courseName']) ?? '';

        if (!empty($courseName)) {

            $courseName = strtolower($courseName);
            $course->courseAdd($courseName);
        } else {
            $_SESSION['error']   = "add valid course name";
        }
    }
}


// update 

if (isset($_REQUEST['cId'])) {
    $cId = $_REQUEST['cId'];
    $courseName =   $course->findCheck($cId);
}




if (isset($_POST['courseUpdate']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseName = trim($_POST['courseUname']);
    $id = $_POST['courseId'];

    $course->courseUpdate($courseName, $id);
};


//delete 

if (isset($_REQUEST['cId'])) {
    $cId = $_REQUEST['cId'];
    $courseName =   $course->delete($cId);
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Course CRUD</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <h2 class="mb-4">Course Management</h2>
        <span class="text-danger p-1">
            <?php echo  $_SESSION["exitCourse"] ?? null; ?>
        </span>

        <!-- Course Form -->
        <div class="card p-4 mb-4">

            <form id="courseForm" action="course.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-4">
                        <span class="text-danger p-1">
                            <?php echo $_SESSION['error'] ?? null; ?>
                        </span>
                        <input
                            type="text"
                            name="courseName"
                            class="form-control"
                            placeholder="Course Name">
                    </div>
                    <div class="col-12">
                        <button
                            class="btn btn-primary"
                            type="submit"
                            name="submit">
                            add course
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <!-- Search -->



        <!-- Course Table -->
        <div class="card">

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>id</th>
                            <th>Course</th>
                            <!-- <th>Instructor</th>
                        <th>Price</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="courseList">




                        <?php
                        if ($showdCourse->rowCount() > 0) {

                            while ($row = $showdCourse->fetch()) {
                        ?>

                                <tr>


                                    <div class="modal fade" id="exampleModal<?php echo  $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">update course</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <form action="course.php" method="POST">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">course name:</label>

                                                            <input name="courseUname" value="<?php echo  $row['course']  ?>" id="cId" type="text" class="form-control" id="recipient-name">
                                                            <input name="courseId" value="<?php echo  $row['id']  ?>" type="hidden">
                                                        </div>

                                                        <button type="submit" name="courseUpdate" class="mt-2 btn btn-primary">
                                                            update course
                                                        </button>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <!-- <button type="button" class="btn btn-primary">Send message</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <th><?php echo  $row['id'] ?></th>
                                    <th><?php echo  $row['course'] ?></th>

                                    <th>


                                        <a href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo  $row['id'] ?>" data-whatever="@mdo"> update </a> ||
                                        <!-- <a href="course.php?cId=<?php echo  $row['id'] ?>"> update </a> || -->
                                        <a href="course.php?cId=<?php echo  $row['id'] ?><?php  ?>" onclick="return confirm('Are you sure you want to delete?')"> delete </a>


                                    </th>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                        </select>


                    </tbody>

                </table>

            </div>
        </div>






    </div>
    </div>



    </div>



    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <!-- <script>
        $('.update-btn').click(function() {
            var id = $(this).data('id');

            $('#exampleModal input[name="cId"]').val(id);
        });
    </script> -->

</body>

</html>


<?php

unset($_SESSION['error']);
unset($_SESSION['course']);
unset($_SESSION["exitCourse"]);

?>