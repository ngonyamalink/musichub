<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ngonyama Link</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <img alt="Brand" src="http://localhost/ngonyamalink/resource/img/logo.png" width="100%" height="50px" >
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <?php
                                error_reporting(1);
                                if (isset($_GET['code']) && isset($_GET['email'])) {
                                    $email = strtolower($_GET['email']);
                                    $code = $_GET['code'];
                                    $link = mysqli_connect("localhost", "root", "", "ngonyama");
                                    $query = "select * from member where (member_email='$email' and activation_code=$code)";
                                    $result = $link->query($query);
                                    if ($result->num_rows > 0) {
                                        echo '<div class="form-group">';
                                        echo '<form action="updatepassword.php" method="post" class="navbar-form navbar-left" role="search">
                                                <input type="hidden" name="email" value=' . $email . '>
                                                <input type="hidden" name="code" value=' . $code . '>
                                                <span class="text-primary"><b>Enter New Password:</b></span><br><br><input type="password" name="password" class="form-username form-control">
                                                <input type="submit" name="submit" value="Send" class="btn btn-primary">
                                               </form>';
                                        echo "</div>";
                                    }
                                } else {
                                    $email = strtolower($_POST['email']);
                                    if ($_POST['submit'] == 'Send') {
                                        $link = mysqli_connect("localhost", "root", "", "ngonyama");
                                        $query = "select * from user where username='$email'";
                                        $result = $link->query($query);
                                        if ($result->num_rows > 0) {
                                            $code = rand(100, 999);
                                            $message = "You requested a password reset. if it was not you who requested the password reset, ignore this email. If you requested a password reset, your activation link is: http://ngonyamalink.co.za/rpassword/forgot.php?email=$email&code=$code";
                                            $headers = 'From: noreply@ngonyamalink.co.za';
                                            mail($email, "ngonyamalink - Password Reset", $message, $headers);
                                            echo "Email reset link has been sent to your emails, please check your emails at <b>$email</b>. Else, enter your email to resend. <br><br>";
                                            $query = "update member set activation_code='$code' where member_email='$email'";
                                            $link->query($query);
                                        } else {
                                            echo "User account not valid, please provide a registered email address!";
                                        }
                                    }
                                    echo '<div class="form-group">';
                                    echo '<form action="forgot.php" method="post" class="navbar-form navbar-left" role="search">
                                              <span class="text-primary"><b>Reset password:</b></span> <br><br><input type="text" name="email" class="form-username form-control" placeholder="Enter Email" >
                                              <input type="submit" name="submit" value="Send" class="btn btn-primary">
                                              </form>';
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <div class="col-lg-4"></div>
        </div>
    </body>
</html>
