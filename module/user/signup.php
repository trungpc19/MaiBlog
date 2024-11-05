<?php 
    if($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['signup_btn'])){
        $uname = remove_bad_character($_POST['uname']);
        $email = remove_bad_character($_POST['email']);
        $psw = addslashes($_POST['psw']);
        $psw_repeate = addslashes($_POST['repeat_password']);

        if(strlen($psw) > 8 && strlen($psw) < 12 ){
            if(($psw === $psw_repeate)){
                $sql = "SELECT * FROM users WHERE username = '$uname' OR email = '$email'";
                $result = $conn->query($sql);    
                if($result->num_rows > 0){    
                    echo "<script>alert('Username or Email exits')</script>"; 
                }
                else{
                    $sql = "INSERT INTO users (`username`, `password`, `email`) VALUES ('$uname', '$psw', '$email')";
                    $result = $conn->query($sql);                   
                    if($result == true){
                        echo "<script>Insert oke</script>"; 
                        header('location:./?page=module/user&action=login');
                    }
                }
            }
            else{
                echo "<script>Please reenter your password</script>";
            }
        }else{
            echo "<script>alert('Invalid Password')</script>";
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto ">
            <p>Sign up to your account.</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="email"><b>Email</b></label>
                    <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username"><b>Username</b></label>
                    <input type="username" name="uname" placeholder="Enter Username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="psw"><b>Password</b></label>
                    <input type="password" name="psw" placeholder="Enter Password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" name="repeat_password" placeholder="Repeat Password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="submit" name="signup_btn" class="btn btn-primary" value="SignUp">
                </div>
                <div>
                    <p>Have an account, Login <a href="?page=./module/user&action=login" > here </a></p>

                </div>
            </form>
        </div>
    </div>
</div>