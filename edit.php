<style>
    .profile_table {
    width: 450px;
    margin: auto;
    background: black;
    color: #fff;
    padding: 35px 25px;
    border-radius: 10px;
    margin-top: 100px;
    margin-bottom: 100px;
}

.profile_table input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 20px;
}
.edit_btn{
    text-align: center;
    background: #1E37C4;
    width: 200px;
    margin: auto;
    padding: 11px 0px;
    border-radius: 10px;
    display: block;
    margin-top: 35px;
    cursor: pointer;
    color: white;
    border: none;
    outline: none;
}
.image_upload img {
    width: 150px;
    height: 150px;
    border-radius: 100px;
    object-fit: cover;
}


.image_upload {
    text-align: center;
}
.img_file {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
}

.img_file input {
    width: 206px;
    cursor: pointer;
}

.img_file label {
    margin-top: -10px;
}

</style>

<?php require_once("header.php"); ?>

<?php 
if(isset($_REQUEST["edit_id"])){
    $editId = $_REQUEST["edit_id"];

    $selectInfo = "SELECT * FROM my_users WHERE id='$editId'";
    $runInfo = mysqli_query($connect, $selectInfo);

    while($getData = mysqli_fetch_array($runInfo)){ ?>

<div class="profile_edit">
    <div class="profile_overlay">
        <div class="profile_table">
            <h2 style="text-align: center; margin-bottom: 30px">Edit Profile</h2>
            <form action="edit_core.php" method="POST" enctype="multipart/form-data">
                <div class="image_upload">
                    <img src="img/<?php echo $getData["avatar"] ?>" alt="">
                    <div class="img_file">
                    <label for="">Upload Image</label>
                    <input type="file" name="avatar">
                    </div>
                </div>
                <p>First Name</p>
                <input type="text" placeholder="First Name" name="fName" value="<?php echo $getData['fName'] ?>">
                <p>Last Name</p>
                <input type="text" placeholder="Last Name" name="lName" value="<?php echo $getData['lName'] ?>">
                <p>Email</p>
                <input type="text" placeholder="Email" name="email" value="<?php echo $getData['email'] ?>">
                <p>Phone Number</p>
                <input type="text" placeholder="Phone Number" name="phone_num" value="<?php echo $getData['phone_num'] ?>">
                <p>Country</p>
                <input type="hidden" name="editingID" value="<?php echo $editId; ?>">
                <input type="text" placeholder="Country" name="country" value="<?php echo $getData['country'] ?>">
               <input type="submit" name="editBtn" value="Update" class="edit_btn">
            </form>
        </div>
    </div>
</div>


       <?php }
    }?>



<?php require_once("footer.php"); ?>

