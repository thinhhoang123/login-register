<?php

    include("config.php");

    $username = $password = $confirm_password = $phone = $dob = $firstname = $lastname = "";
    $username_err = $password_err = $confirm_password_err = "";
    $phone_err = $dob_err = $firstname_err = $lastname_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Validate first name and last name------------------------------------------------------->
        if(empty($_POST["fname"])){
            $firstname_err = "Please enter your first name";
        } else {
            $firstname = $_POST["fname"];
        }

        if(empty($_POST["lname"])){
            $lastname_err = "Please enter your last name";
        } else {
            $lastname = $_POST["lname"];
        }

        //Validate dob------------------------------------------------------->
        if(empty($_POST["dob"])){
            $dob_err = "Please enter D.O.B";
        } else {
            $dob = $_POST["dob"];
        }

        // Validate email------------------------------------------------------->
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            $temp_username = trim($_POST["username"]);
            $sql = "SELECT id FROM acc WHERE email = '$temp_username'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);
            if($count == 1) {
                $username_err = "This username is already taken.";
            }else{
                $username = trim($_POST["username"]);
            }
        }

        // Validate password------------------------------------------------------->
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password."; 

        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";

        } else{
            $password = trim($_POST["password"]);
        }

        // Validate confirm password------------------------------------------------------->
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password."; 
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        //Validate phone------------------------------------------------------->
        if(empty($_POST["phone"])){
            $phone_err = "Please enter your phone number";
        } else {
            $temp_phone = ($_POST["phone"]);
            $sql = "SELECT id FROM acc WHERE phone = '$temp_phone'";
            $result = mysqli_query($conn,$sql);
            $count1 = mysqli_num_rows($result);
            if($count1 == 1) {
                $phone_err = "This phone is already taken.";
            }else{
                $phone = $_POST["phone"];
            }
        }

        // $firstname 
        // $lastname   
        // $dob        
        // $username 
        // $password   
        // $phone     

        if(empty($firstname_err) && empty($lastname_err) && empty($dob_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err)){
            $sql = "insert into acc (firstName,lastName,dob,email,pass,phone) values ('$firstname','$lastname ','$dob','$username','$password',$phone)";
            mysqli_query($conn, $sql);
            mysqli_close($conn);    
        }
    }
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

    <link rel="stylesheet" href="css/register.css">

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
            <h3>Register</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3 row g-2">
                    <div class="col-md">
                      <div class="form-floating">
                        <input type="text" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" 
                            id="floatingInputGrid" placeholder="First name" name="fname">
                        <label for="floatingInputGrid">First name</label>
                        <span class="invalid-feedback">
                            <?php echo $firstname_err; ?>
                        </span>
                      </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                          <input type="text" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" 
                            id="floatingInputGrid" placeholder="Last name" name="lname">
                          <label for="floatingInputGrid">Last name</label>
                          <span class="invalid-feedback">
                            <?php echo $lastname_err; ?>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-floating ">
                    <input type="date" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"
                        id="floatingInput" name="dob">
                    <label for="floatingInput">D.O.B</label>
                    <span class="invalid-feedback">
                        <?php echo $dob_err; ?>
                    </span>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>"
                        id="floatingPassword" placeholder="Phone number" name="phone">
                    <label for="floatingPassword">Phone number</label>
                    <span class="invalid-feedback">
                        <?php echo $phone_err; ?>
                    </span>
                </div>
                <div class="mb-3 form-floating ">
                    <input type="email" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" 
                        id="floatingInput" placeholder="Account?" name="username" >
                    <label for="floatingInput">Email address</label>
                    <span class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </span>
              
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" 
                        id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                    <span class="invalid-feedback">
                        <?php echo $password_err; ?>
                    </span>
                    
                </div>
                <div class="mb-3 form-floating">
                    <input type="password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" 
                        id="floatingPassword" placeholder="Confirm Password" name="confirm_password" >
                    <label for="floatingPassword">Confirm password</label>
                    <span class="invalid-feedback">
                        <?php echo $confirm_password_err; ?>
                    </span>
                
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">I agree to the</label>
                    <a href="#">Terms of user </a>
                  </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <div class="mb-3 text-bottom">
                    <label>Already have an account?</label>
                    <a href="login.php">login here</a>
                </div>  
            </form>
        </div>
    </div>
</body>
</html>