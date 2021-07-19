<?php
    // ket noi database
    include("config.php");
    $username = $_POST["username"];
    $password = $_POST["password"];

    // doc du lieu tu database
    $sql = "select email, pass from acc where email='$username' and pass ='$password'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    // gui du lieu len website
    if($count == 1){
        header("location: http://google.com");
        exit();
    }else{
        header("location: ../login/login.php");
        exit();
    }
    mysqli_close($conn);

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="bg-body"></div>
    <div id="tag">
        <div class="form-content">
            <h3>Login</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3 form-floating ">
                    <input type="email" class="form-control" id="floatingInput" placeholder="Account?" name="username">
                    <label for="floatingInput"><i class="fas fa-user-alt"></i>Account</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword"><i class="fas fa-lock"></i>Password</label>
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Remember me</label>
                  <a href="#">Forgot password</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="mb-3">
                    <label for="">Don't have account?</label>
                    <a href="register.php">Register here</a>
                </div>
                <hr>
                <div id="choice-login">
                    <p>Or you can join with</p>
                    <div class="logo">
                        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#"><i class="fab fa-google-plus-g fa-2x"></i></a>
                        <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
                    </div>
                </div>
              </form>
        </div>
        <div class="card-img">
            <img src="img/Manual - Cover Page.jpg" alt="cover image for login">
        </div>
       
    </div>
</body>
</html>
