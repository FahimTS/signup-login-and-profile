<style>
    .login_form {
    width: 400px;
    background: #221919;
    margin: auto;
    text-align: center;
    padding: 40px 20px;
    border-radius: 10px;
}

.login_form h2 {
    color: #fff;
    font-size: 25px;
    margin-bottom: 30px;
}

.input_feild input {
    padding: 10px 5px;
    width: 95%;
    margin-bottom: 15px;
}

.form_btn input {
    padding: 10px 35px;
    background: #341f97;
    color: #fff;
    border: none;
    outline: none;
    cursor: pointer;
}
.forget_pwd a{
    color: #547beb;
    display: block;
    margin-top: 20px;
}
</style>

<?php 
require_once("header.php"); 

if(isset($_COOKIE["currentUser"])){
    header("Location: profile.php");
}

?>

<div class="form">
    <div class="container">
        <div class="login_form">
            <form action="login_core.php" method="POST">
                <h2>Login</h2>
                <div class="input_feild">
                    <input type="text" placeholder="Email or Username" name="email">
                </div>
                <div class="input_feild">
                    <input type="password" placeholder="Password" name="usr_pwd">
                </div>
                <div class="form_btn">
                    <input type="submit" name="signUp" value="Login">
                </div>
                
                <div class="forget_pwd">
                <a href="forgot_password.php">Forgot Password?</a>
                </div>

                <?php 
                if(isset($_REQUEST["error"])){
                    echo "<p style='color: red; margin-top: 20px;'>";
                    echo $_REQUEST["error"];
                    echo "</p>";
                }

                ?>
            </form>
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>