<?php
// include_once("info_student.php'");
// require_once __DIR__.'/read_data.php';


require_once __DIR__ . '/studentCrud.php';

use  pages\studentCrud\Crud;


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <title>student management</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">student management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active bolder" aria-current="page" href="pages/studentAdd.php">add student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active bolder" aria-current="page" href="pages/course.php ">add course</a>
                    </li>

                </ul>
                <!-- <form class="d-flex">
                    <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>


    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12 col-lg-12 text-center">
                    <h2 class="text-center text-uppercase"> All student list showing </h2>
                    <p class="text-center"></p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12" id="show_data">
                    <?php
                    $crud = new Crud();
                    $result = $crud->show();
                    if ($result->rowCount() > 0) {
                    ?>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">phone</th>
                                    <th scope="col">course</th>
                                    <th scope="col">roll</th>
                                    <!-- <th scope="col">password</th> -->
                                    <th scope="col">photos</th>
                                    <th scope="col">about student</th>
                                    <th scope="col">action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch()) {
                                ?>
                                    <tr>
                                        <td class="text-lowercase"><?php echo $row['id'] ?></td>

                                        <td class="text-lowercase"><?php echo $row['name'] ?></td>
                                        <td class="text-lowercase"><?php echo $row['email'] ?></td>
                                        <td class="text-lowercase"><?php echo $row['number'] ?></td>
                                        <td class="text-lowercase"><?php echo $row['course'] ?></td>

                                        <td class="text-lowercase"><?php echo $roll = $row['studentRoll']; ?></td>
                                        <td class="text-lowercase">
                                            <img title="<?php echo $row['name'] ?>" style="width: 40px; " src="photos/<?php echo $row['photos'] ?>" alt="">
                                        </td>
                                        <td class="text-lowercase"><?php echo $row['about'] ?></td>

                                        <td>
                                            <a href="pages/updateForm.php?u_id=<?php echo $row['id'] ?>"> update </a> ||
                                            <a href="pages/delete.php?d_id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete?')"> delete </a>

                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>

                        </table>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="com-md-12 col-lg-12">

                </div>
            </div>
        </div>
    </section>


    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>