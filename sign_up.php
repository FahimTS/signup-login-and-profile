<style>
    .signup_form {
    width: 400px;
    background: #221919;
    margin: auto;
    text-align: center;
    padding: 40px 20px;
    border-radius: 10px;
}

.signup_form h2 {
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
</style>

<?php require_once("header.php"); ?>


<div class="form">
    <div class="container">
        <div class="signup_form">
            <form action="sign_up_core.php" method="POST">
                <h2>Sign Up</h2>
                   <?php 
                   if(isset($_REQUEST["error"])){
                        echo "<p style='color: red; margin-bottom: 25px'>";
                        echo $_REQUEST["error"];
                        echo "</p>";
                   }

                   if(isset($_REQUEST["success"])){
                    echo "<p style='color: green; margin-bottom: 25px'>";
                    echo $_REQUEST["success"];
                    echo "</p>";
               }
               
                   
                   ?>
                <div class="input_feild">
                    <input type="text" placeholder="First Name" name="fName">
                </div>
                <div class="input_feild">
                    <input type="text" placeholder="Last Name" name="lName">
                </div>
                <div class="input_feild">
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="input_feild">
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="input_feild">
                    <input type="text" placeholder="Phone Number" name="phone_num">
                </div>
                <?php 
                if(isset($_REQUEST["password"])){
                    echo "<p style='color: red; text-align: left; margin-bottom: 10px; margin-left: 11px;'>";
                    echo $_REQUEST["password"];
                    echo "</p>";
                }
                
                ?>
                <div class="input_feild">
                    <input type="password" placeholder="Password" name="usr_pwd">
                </div>
                <div class="form_btn">
                    <input type="submit"  value="Sign Up">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>