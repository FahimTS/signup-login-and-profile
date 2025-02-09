<style>
    .profile_overlay {
    text-align: center;
    margin-top: 80px;
    margin-bottom: 80px;
}

.prfile_title h2 {
    font-size: 32px;
    margin-top: 15px;
    margin-bottom: 20px;
}

.profile_flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 30px 10px;
    border-bottom: 1px solid #ddd;
    font-size: 17px;
}

.profile_table {
    width: 900px;
    margin: auto;
    background: black;
    padding: 30px 20px;
    color: #fff;
    border-radius: 5px;
    /* margin-bottom: 100px; */
}

.profile_flex:last-child {
    border-bottom: 0px;
}
.profile_update a {
    text-align: center;
    background: #1E37C4;
    width: 800px;
    margin: auto;
    padding: 11px 0px;
    border-radius: 10px;
    display: block;
    margin-top: 35px;
    margin-bottom: 20px;
}

.profile_update a {
    color: white;
}
.prfile_img img {
    width: 230px;
    border-radius: 100%;
    height: 230px;
    object-fit: cover;
}
.change_password a {
    background: red;
    padding: 10px;
    text-align: center;
    margin: auto;
    display: block;
    width: 200px;
    border-radius: 10px;
    margin-bottom: 80px;
}
</style>

<?php require_once("header.php"); ?>

<?php 

if(isset($_COOKIE["currentUser"])){
    $currentUserTarget = $_COOKIE["currentUser"];

    $nameQuery = "SELECT * FROM my_users WHERE email='$currentUserTarget' LIMIT 1";
    $runNameQuery = mysqli_query($connect, $nameQuery);
    
    if($runNameQuery){
        while($getRow = mysqli_fetch_array($runNameQuery))
        { ?>
           
           <div class="profile_page">
        <div class="profile_overlay">
            <div class="prfile_img">
                <img src="img/<?php echo $getRow["avatar"] ?>" alt="fahim picture">
            </div>
            <div class="prfile_title">
                <h2><?php echo $getRow["username"] ?></h2>
                <p>Web Developer~</p>
            </div>
        </div>
        <div class="profile_table">
                <div class="profile_flex">
                    <div class="left">
                        <p>First Name</p>
                    </div>
                    <div class="right">
                        <p><?php echo $getRow["fName"]?></p>
                    </div>
                </div>

                <div class="profile_flex">
                    <div class="left">
                        <p>Last Name</p>
                    </div>
                    <div class="right">
                        <p><?php echo $getRow["lName"]?></p>
                    </div>
                </div>

                <div class="profile_flex">
                    <div class="left">
                        <p>Email</p>
                    </div>
                    <div class="right">
                        <p><?php echo $getRow["email"]?></p>
                    </div>
                </div>

                <div class="profile_flex">
                    <div class="left">
                        <p>Phone Number</p>
                    </div>
                    <div class="right">
                        <p><?php echo $getRow["phone_num"]?></p>
                    </div>
                </div>

                <div class="profile_flex">
                    <div class="left">
                        <p>Country</p>
                    </div>
                    <div class="right">
                        <p><?php echo $getRow["country"] ?></p>
                    </div>
                </div>
            </div>
            <div class="profile_update">
                <a href="edit.php?edit_id=<?php echo $getRow['id'] ?>">Edit Profile</a>
            </div>
            <div class="change_password">
                <a href="change_pwd.php">Change Password</a>
            </div>
</div>



        <?php }}} ?>




<?php require_once("footer.php"); ?>