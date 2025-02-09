<style>
    .change_password {
    width: 400px;
    background: #111;
    margin: auto;
    text-align: center;
    padding: 30px 25px;
    color: #fff;
    margin-top: 80px;
    margin-bottom: 80px;
    border-radius: 10px;
}

.change_password h2 {
    margin-bottom: 18px;
}

.change_password input {
    width: 100%;
    padding: 10px 8px;
    margin-bottom: 18px;
}

input[type="submit"] {
    width: 140px;
    background: red;
    outline: none;
    border: none;
    cursor: pointer;
    border-radius: 10px;
    color: #fff;
    margin-top: 15px;
}
</style>

<?php require_once("header.php") ?>


<div class="change_password">
    <form action="changepwd_core.php" method="POST">
        <h2>Change Password</h2>
            <?php 
        
        if(isset($_REQUEST["success"])){
            echo "<b><p style='color: green; margin-bottom: 20px;'>";
            echo $_REQUEST["success"];
            echo "</p></b>";
        }elseif(isset($_REQUEST["error"])){
            echo "<b><p style='color: red; margin-bottom: 20px;'>";
            echo $_REQUEST["error"];
            echo "</p></b>";
        }elseif(isset($_REQUEST["dontmatch"])){
            echo "<b><p style='color: red; margin-bottom: 20px;'>";
            echo $_REQUEST["dontmatch"];
            echo "</p></b>";
        }elseif(isset($_REQUEST["failed"])){
            echo "<b><p style='color: green; margin-bottom: 20px;'>";
            echo $_REQUEST["failed"];
            echo "</p></b>";
        }

        ?>
        <input type="password" placeholder="Old Password" name="oldpwd"> <br>
        <input type="password" placeholder="New Password" name="newpwd"> <br>
        <input type="password" placeholder="Comfirm Password" name="cnfpwd"> <br>
        <input type="submit" name="submit" value="Change"> <br>

    </form>
</div>

<?php require_once("footer.php") ?>