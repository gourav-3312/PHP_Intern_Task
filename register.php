<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP-Full Stack Developer Internship Task</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'conn.php';
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);

        $pass = password_hash($password, PASSWORD_BCRYPT);

        $emailquery = "SELECT * FROM registration WHERE email='$email'";
        $query = mysqli_query($con, $emailquery);
        $emailcnt = mysqli_num_rows($query);

        if ($emailcnt > 0) {
            echo "Email already exists";
        } else {
            $insertquery = "INSERT INTO registration(name, email, password, address, phone) VALUES('$name', '$email', '$pass', '$address', '$phone')";

            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
    ?>
                <script>
                    alert("Registration Successful");
                </script>
                <?php
                header('location: login.php');
                ?>
            <?php
            } else {
            ?>
                <script>
                    alert("Registration Failed");
                </script>
    <?php
            }
        }
    }
    ?>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">WELCOME</span>

                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="input-field">
                        <input type="email" name="email" class="form-control" id="email" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') echo $_POST['email']; ?>" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>

                    <div class="input-field">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>

                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="SIGN IN">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Don't have an account?
                        <a href="#" class="text signup-link">Sign Up</a>
                    </span>
                </div>
            </div>



            <div class="form signup">
                <span class="title">Registration</span>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="input-field">
                        <input type="text" name="name" placeholder="Enter your name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="password" placeholder="Create a password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="address" placeholder="Enter your address" required>
                        <i class="uil uil-location-point"></i>
                    </div>
                    <div class="input-field">
                        <input type="tel" name="phone" placeholder="Enter your phone number" required>
                        <i class="uil uil-phone"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="SIGN UP">
                    </div>
                </form>
                <div class="login-signup">
                    <span class="text">Already a member? <a href="login.php">Login Now</a></span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>