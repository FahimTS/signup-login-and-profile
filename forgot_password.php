<style>
.forget_pwd {
    width: 340px;
    display: block;
    background: #111;
    padding: 50px 10px;
    text-align: center;
    color: #fff;
    margin: 102px auto;
    border-radius: 10px;
}

.forget_pwd input {
    display: block;
    margin: auto;
    width: 88%;
    padding: 8px;
    margin-top: 25px;
    margin-bottom: 25px;
}

.forget_pwd button {
    padding: 9px 13px;
    background: #341F97;
    color: #fff;
    border: none;
    outline: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.forget_pwd button:hover {
    background: #1B1464;
}

.error-msg {
    color: red;
    font-weight: bold;
    margin: 15px 0;
}

.success-msg {
    color: green;
    font-weight: bold;
    margin: 15px 0;
}
</style>

<?php require_once("header.php"); ?>

<div class="forget_pwd">
    <form action="forgot_password_process.php" method="POST">
        <p style="font-size: 18px">Email Address:</p>
        <?php 
        if(isset($_REQUEST["account"])){
            echo "<p class='error-msg'>". $_REQUEST["account"] ."</p>";
        }
        if(isset($_REQUEST["invalid"])){
            echo "<p class='error-msg'>". $_REQUEST["invalid"] ."</p>";
        }
        if(isset($_REQUEST["check"])){
            echo "<p class='success-msg'>". $_REQUEST["check"] ."</p>";
        }
        ?>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="submit" id="submit-btn" disabled>Send Reset Link</button>
    </form>
</div>

<script>
document.querySelector("input[name='email']").addEventListener("input", function() {
    document.getElementById("submit-btn").disabled = !this.value.trim();
});
</script>

<?php require_once("footer.php"); ?>
