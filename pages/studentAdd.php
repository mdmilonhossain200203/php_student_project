<?php


require_once __DIR__ . '/studentAddCode.php';
require_once __DIR__ . '/courseCrud.php';

use pages\courseCrud\courseCrud;

isset($_SESSION['registerEmail']);



$findCourse = new courseCrud;
$findCourse = $findCourse->findCourse();
// $findCourse=$findCourse->fetch();


// print_r($findCourse);
// return;

// echo $_SESSION['registerEmail'];
// unset($_SESSION['registerEmail']);
// $message= <span class="text-danger">$_SESSION['registerEmail'] </span>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Student Information</h2>
        <span class="text-danger">
            <?php echo  $_SESSION["registerEmailDone"] ?? ''; ?>
        </span>

        <span class="text-success">
            <?php echo  $_SESSION['dataAdded']; ?>
        </span>




        <form action="studentAdd.php" method="POST" enctype="multipart/form-data">

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control">
                <span class="text-danger">
                    <?php echo $_SESSION['text'] ?? ''; ?>
                </span>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control">

                <span class="text-danger">
                    <?php echo $_SESSION["registerEmail"] ?? ''; ?>
                </span>

                <span class="text-danger">
                    <?php echo $_SESSION['email'] ?? ''; ?>
                </span>

            </div>

            <!-- Number -->
            <div class="mb-3">
                <label class="form-label">Phone <span class="text-danger">*</span> </label>
                <input type="text" name="number" class="form-control">
                <span class="text-danger">
                    <?php echo $_SESSION['phone'] ?? ''; ?>
                </span>
            </div>

            <!-- Course -->
            <div class="mb-3">
                <label class="form-label">selecet your course <span class="text-danger">*</span></label>

                <select name="course" id="">


                    <?php
                    if ($findCourse->rowCount() > 0) {

                        while ($row = $findCourse->fetch()) {
                    ?>

                            <option value="<?php echo  $row['id'] ?>"><?php echo  $row['course'] ?></option>

                    <?php
                        }
                    }
                    ?>
                </select>


            </div>

            <!-- Roll -->
            <div class="mb-3">
                <label class="form-label">Roll</label>
                <input value="After registration, you will receive your Student ID." type="text" name="" class="form-control" readonly>
            </div>

            <!-- Password -->
            <!-- <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
            </div> -->

            <!-- Photo -->
            <div class="mb-3">
                <label class="form-label">Photo</label>
                <input type="file" name="photos" class="form-control" accept="image/*">
                <span class="text-danger">
                    <?php echo $_SESSION['fileType'] ?? ''; ?>
                </span>
            </div>

            <!-- Other -->
            <div class="mb-3">
                <label class="form-label">about student</label>
                <input type="text" name="other" class="form-control">
            </div>

            <!-- Other 1 -->
            <!-- <div class="mb-3">
                <label class="form-label">Other 1</label>
                <input type="text" name="other1" class="form-control">
            </div> -->

            <button type="submit" name="submit" class="btn btn-primary">
                Add Student
            </button>

            <a href="../index.php" class="btn btn-secondary">
                View Students
            </a>

        </form>
    </div>

</body>

</html>

<?php


unset($_SESSION['dataAdded']);
unset($_SESSION['phone']);
unset($_SESSION['email']);
unset($_SESSION['text']);
unset($_SESSION['registerEmail']);
unset($_SESSION["registerEmailDone"]);
unset($_SESSION['fileType']);
