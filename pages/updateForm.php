<?php
//  session_start();
require_once __DIR__ . '/studentCrud.php';

use  pages\studentCrud\Crud;

if (isset($u_id)) {
    $crud = new Crud();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">update Student Information</h2>

        <span class="text-success">
            <?php echo $_SESSION['errors']['update'] ?? ''; ?>
            
        </span>

        <?php
        $result =  $crud->find($u_id);
        if ($result->rowCount() <= 0) {

            echo "data not found";
            return;
        };

        $row = $result->fetch();
        ?>

        <form action="update.php" method="POST" enctype="multipart/form-data">


            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input value="<?php echo $row['name'] ?>" type="text" name="name" class="form-control">
                <span class="text-danger">
                    <?php echo  $_SESSION['errors']['name'] ?? ''; ?>
                </span>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input readonly value="<?php echo $row['email'] ?>" type="email" name="email" class="form-control">
            </div>

            <!-- Number -->
            <div class="mb-3">
                <label class="form-label">Number</label>
                <input value="<?php echo $row['number'] ?>" type="text" name="number" class="form-control">
                <span class="text-danger">
                    <?php echo $_SESSION['errors']['number'] ?? ''; ?>
                    <?php echo $_SESSION['phone'] ?? ''; ?>
                </span>

            </div>

            <!-- Course -->
            <div class="mb-3">
                <label class="form-label">Course</label>
                <input readonly value="<?php echo $row['course'] ?>" type="text" name="course" class="form-control">
            </div>

            <!-- Roll -->
            <div class="mb-3">
                <label class="form-label">Roll</label>
                <input readonly value="<?php echo $row['studentRoll'] ?>" type="text" name="roll" class="form-control">
            </div>

            <!-- Password -->
            <!-- <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div> -->


            <!-- Photo -->

            <input value="<?php echo $row['photos']; ?>" name="oldImg" class="hiddenImg" type="hidden">

            <img style="width:40px;" src="../photos/<?php echo $row['photos']; ?>" alt="">
            

            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name="photos" class="form-control" accept="image/*">
            
                <span class="text-danger">
                    <?php echo $_session['fileType']  ?? ''; ?>
                   
                </span>
            </div>



            <!-- Other -->
            <div class="mb-3">
                <label class="form-label">about student</label>
                <input value="<?php echo $row['about'] ?>" type="text" name="about" class="form-control">
            </div>

            <!-- Other 1 -->
            <!-- <div class="mb-3">
                <label class="form-label">Other 1</label>
                <input value="<?php echo $row['other1'] ?>" type="text" name="other1" class="form-control">
            </div> -->

            <input value="<?php echo $row['id'] ?>" type="hidden" name="hiddenId">


            <button type="submit" name="submit" class="btn btn-primary">
                update data
            </button>
        </form>

    </div>

</body>

</html>

<?php

unset($_SESSION['errors']);

?>