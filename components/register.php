<?php
    require_once '../db/dbConnect.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
        $email = $_POST['email'];
        $email_domain = explode('@', $email);
        $email_domain = $email_domain[1];

        if ($email_domain == 'g.bracu.ac.bd'){
            $role = 'student';
        }
        elseif ($email_domain == 'bracu.ac.bd'){
            $role = 'faculty';
        }
        else{
            echo "<script>alert('Invalid email domain!');</script>";
        }
        

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            session_start();
            $_SESSION['usernametaken']="1";
            header('location: ../pages/register.php');
            // echo '<script>alert("Username already taken")</script>';
        }
        else{
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                session_start();
                $_SESSION['emailtaken']="1";
                header('location: ../pages/register.php');
                // echo '<script>alert("Email already taken")</script>';
            }
            else{
                    if($password == $confirm_password){
                        $password = md5($password);
                        $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            session_start();
                            $_SESSION['regsuccess']="1";    
                            header('location: ../pages/login.php');
                            // echo '<script>alert("Signup Successful")</script>';
                        }else{
                            session_start();
                            $_SESSION['signupfailed']="1";
                            header('location: ../pages/register.php');
                            // echo '<script>alert("Signupa Failed")</script>';
                        }
                    }
                    else{
                        session_start();
                        $_SESSION['passwordunmatched']="1";
                        header('location: ../pages/register.php');
                        // echo '<script>alert("Passwords do not match")</script>';
                    }              
                }
            }
    }
    else{
        session_start();
        $_SESSION['signupfailed']="1";
        header('location: ../pages/register.php');
        // echo '<script>alert("Signup Failed")</script>';
    }
?>
