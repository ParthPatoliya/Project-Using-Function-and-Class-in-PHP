<?php
// include 'headerView.php';
include 'users.php';
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
        $newUser->doRegister();
        header("Location: index.php");
        exit();
    } else {

        foreach ($newUser->getErr() as $err) {
            echo '<label class="form-label text-danger"><b> ' . $err . ' </b></label><br>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> User data</title>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script>
        //    delete user using jquery ajax
        $(document).ready(function() {
            $('.delete').click(function() {
                var email = $(this).attr('email');
                $.ajax({
                    url: "delete.php?email=" + email,
                    type: 'GET',
                    success: function() {
                        window.location.href = "index.php";
                    }
                });
            });
        });

        // update user using jquery ajax
        $(document).ready(function() {
            $('.update').click(function() {
                var email = $(this).attr('email');
                $.ajax({
                    url: "edit.php?email=" + email,
                    type: 'GET',
                    success: function() {
                        window.location.href = "edit.php?email=" + email;
                    }
                });
            });
        });
        // logout using jquery ajax
        $(document).ready(function() {
            $('.logout').click(function() {
                $.ajax({
                    url: "logout.php",
                    type: 'GET',
                    success: function() {
                        window.location.href = "loginView.php";
                    }
                });
            });
        });
    </script>
</head>

<body>
    <button class="btn btn-primary logout">Logout</button>

    <?php
    session_start();
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') { ?>
            <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">
                Add User
            </button>
            <div class="container">

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form class="mx-1 mx-md-4" method="POST">
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example1c" name="name" placeholder="Name" value="" class="form-control" />

                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <i class="fa fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="form3Example3c" name="email" placeholder="Email" value="" class="form-control" />
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
                                            <input type="number" id="form3Example4cd" placeholder="Phone No." name="phone" value="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-3">
                                        <i class="fa fa-level-up fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4cd" placeholder="Designation" name="desi" value="" class="form-control" />
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
                                        <button type="submit" class="btn btn-primary btn-lg">Add User</button>
                                    </div>


                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
    <?php


            $newUser = new users();
            $newUser->getUser();
            $result = $newUser->getUser();

            if ($result->num_rows > 0) {
                // output data of each row
                echo '<table class="table table-striped">';
                echo '<tr>';
                echo '<th>No</th>';
                echo '<th>Name</th>';
                echo '<th>Email</th>';
                echo '<th>Phone</th>';
                echo '<th>Designation</th>';
                echo '<th>Role</th>';
                echo '<th>Registration Date</th>';
                // echo '<td><a href="addUser.php" class="btn btn-secondary">Add User</a></td>';
                echo '<th colspan="2"></th>';

                echo '</tr>';
                $cnt = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $cnt . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['designation'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td>' . $row['joiningDate'] . '</td>';

                    if ($row['role'] == 'visitor') {
                        // echo '<td><button class="btn btn-success" onclick="editUser(\'' . $row['email'] . '\',)">Edit</button></td>';
                        // echo '<td><a href="delete.php?email=' . $row['email'] . '" class="btn btn-danger">Delete</a></td>';

                        echo '<td><button class="btn btn-success update" email="' . $row['email'] . '">Edit</button></td>';
                        echo '<td><button class="btn btn-danger delete" email="' . $row['email'] . '">Delete</button></td>';
                        echo '</tr>';
                    }
                    $cnt++;
                }
                echo '</table>';
            }
        } else {
            $newUser = new users();
            $newUser->getUser();
            $result = $newUser->getUser();
            if ($result->num_rows > 0) {
                // output data of each row
                echo '<table class="table table-striped">';
                echo '<tr>';
                echo '<th>No</th>';
                echo '<th>Name</th>';
                echo '<th>Email</th>';
                echo '<th>Phone</th>';
                echo '<th>Designation</th>';
                echo '<th>Role</th>';
                echo '<th>Registration Date</th>';

                echo '</tr>';
                $cnt = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $cnt . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['designation'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td>' . $row['joiningDate'] . '</td>';

                    $cnt++;
                }
                echo '</table>';
            }
        }
    }


    ?>


    <!-- // function deleteUser(email) {
    // // console.log(email);
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    // if (this.readyState == 4 && this.status == 200) {
    // window.location.href = "index.php";
    // }
    // };
    // xmlhttp.open("GET", "delete.php?email=" + email, true);
    // xmlhttp.send();

    // }

    // function addUser() {
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    // if (this.readyState == 4 && this.status == 200) {
    // window.location.href = "addUser.php";
    // }
    // };
    // xmlhttp.open("GET", "addUser.php", true);
    // xmlhttp.send();
    // }

    // function logout() {
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    // if (this.readyState == 4 && this.status == 200) {
    // window.location.href = "loginView.php";
    // }
    // };
    // xmlhttp.open("GET", "logout.php", true);
    // xmlhttp.send();
    // }

    // function editUser(email) {
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function() {
    // if (this.readyState == 4 && this.status == 200) {
    // window.location.href = "edit.php?email=" + email;
    // }
    // };
    // xmlhttp.open("GET", "edit.php?email=" + email, true);
    // xmlhttp.send();
    // } -->


</body>

</html>