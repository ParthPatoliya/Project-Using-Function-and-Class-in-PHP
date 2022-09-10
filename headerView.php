<html>

<head>
    <!-- <title>Index</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php
    include 'login.php';
    $newDB = new db();
    $conn = $newDB->dbCon();
    if (isset($_SESSION['isLoggedIn'])) {

        if ($_SESSION['isLoggedIn'] == 1) {

            if (isset($_SESSION['role'])) {
                $currLoginEmail = $_SESSION['currLoginEmail'];
                $isLoggedIn = $_SESSION['isLoggedIn'];
                $role = $_SESSION['role'];

                $fetchUser = "SELECT * FROM `users` WHERE `email` = '$currLoginEmail'";
                $result = mysqli_query($conn, $fetchUser);
                $numRow = mysqli_num_rows($result);
                if ($numRow == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($_SESSION['role'] == 'Admin') { ?>
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <div class="container-fluid">
                                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                        <div class="navbar-nav">
                                            <a class="nav-link active " aria-current="page" href="index.php">Home</a>
                                            <a class="nav-link active " aria-current="page" href="usersDataView.php">Users</a>
                                            <a class="nav-link active " aria-current="page" href="addUser.php">Add user</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid ">
                                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                                        <div class="navbar-nav ">
                                            <label class="nav-link text-uppercase active " aria-current="page"><?php echo $row['name']; ?></label>
                                            <a class="nav-link active " aria-current="page" href="logout.php">Logout</a>

                                        </div>
                                    </div>
                                </div>
                            </nav>

                        <?php  } else { ?>

                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <div class="container-fluid">
                                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                        <div class="navbar-nav">
                                            <a class="nav-link active " aria-current="page" href="index.php">Home</a>
                                            <a class="nav-link active " aria-current="page" href="usersDataView.php">Users</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid ">
                                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                                        <div class="navbar-nav ">
                                            <label class="nav-link text-uppercase active " aria-current="page"><?php echo $row['name']; ?></label>
                                            <a class="nav-link active " aria-current="page" href="logout.php">Logout</a>

                                        </div>
                                    </div>
                                </div>
                            </nav>

    <?php  }
                    }
                }
            }
        }
    } else {
        header('Location:loginView.php');
    }
    ?>

</body>

</html>