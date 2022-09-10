 <?php


    include 'login.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = new login();
        $login->email =  $_POST['email'];
        $login->password = $_POST['password'];
        $login->doValidate();


        if ($login->doLogin() == true) {
            header("Location: index.php");
            exit();
        } else {
            echo '<label class="form-label text-danger"><b> Invalid email or password </b></label><br>';
        }
    }
    ?>
 <html>

 <head>
     <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 </head>

 <body>
     <section class="vh-100" style="background-color: #eee;">
         <div class="container h-100">
             <div class="row d-flex justify-content-center align-items-center h-100">
                 <div class="col-lg-10 col-xl-10">
                     <div class="card text-black" style="border-radius: 25px;">
                         <div class="card-body p-md-4">
                             <div class="row justify-content-center">
                                 <div class="col-md-10 col-lg-5 col-l-5 order-2 order-lg-1">

                                     <p class="text-center h2 fw-bold mb-4 mx-1 mx-md-4 mt-2">Login</p>

                                     <form class="mx-1 mx-md-4" method="POST">
                                         <div class="d-flex flex-row align-items-center mb-3">
                                             <i class="fa fa-envelope fa-lg me-3 fa-fw"></i>
                                             <div class="form-outline flex-fill mb-0 ">
                                                 <input type="email" id="form3Example3c" name="email" placeholder="Email" value="" class="form-control" />

                                             </div>
                                         </div>

                                         <div class="d-flex flex-row align-items-center mb-3">
                                             <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                             <div class="form-outline flex-fill mb-0">
                                                 <input type="password" id="form3Example4c" name="password" placeholder="Password" value="" class="form-control" />

                                             </div>
                                         </div>




                                         <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-3">
                                             <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                         </div>
                                         <p class="text-center text-muted mt-2 mb-0">Don't have an account? <a href="signupView.php" class="fw-bold text-body"><u>Register here</u></a></p>

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