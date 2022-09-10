<?php
include 'users.php';
$newDB = new db();
$conn = $newDB->dbCon();
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $fecth = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $fecth);
    $row = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUser = new users();

    $newUser->name = $_POST['name'];
    $newUser->email =  $_POST['email'];
    $newUser->password =  $_POST['password'];
    $newUser->conf_pass =  $_POST['conf_pass'];
    $newUser->phone =  $_POST['phone'];
    $newUser->designation = $_POST['desi'];
    $newUser->role =  $_POST['role'];
    $newUser->doValidate();

    if (empty($newUser->getErr())) {
        $newUser->updateUser($row['email']);
        header("Location: index.php");
        exit();
    } else {

        foreach ($newUser->getErr() as $err) {
            echo '<label class="form-label text-danger"><b> ' . $err . ' </b></label><br>';
        }
    }
}

?>
<html>

<head>
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-4">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-5 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-4 mx-1 mx-md-4 mt-2">Update</p>

                                    <form class="mx-1 mx-md-4" method="POST">
                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" name="name" placeholder="" value="<?php echo $row['name']; ?>" class="form-control" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <i class="fa fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="form3Example3c" name="email" placeholder="" value="<?php echo $row['email']; ?>" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4c" name="password" placeholder="Password" value="" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <i class="fa fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4cd" name="conf_pass" placeholder="Confirm Password" value="" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <i class="fa fa-phone fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="number" id="form3Example4cd" placeholder="Phone No." name="phone" value="<?php echo $row['phone']; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-3">
                                            <i class="fa fa-level-up fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example4cd" placeholder="Designation" name="desi" value="<?php echo $row['designation']; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-3">

                                            <h6 class="mb-2">Select Role: </h6>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="admin" value="Admin" required />
                                                <label class="form-check-label" for="admin">Admin</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="visitor" value="Visitor" />
                                                <label class="form-check-label" for="visitor">Visitor</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-3">
                                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                        </div>


                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</body>

</html>