
<?php
 session_start();
 require_once('connection.php');

 if(!isset($_SESSION['user_login'])){
     $_SESSION['error'] = "กรุณาเข้าสู่ระบบก่อน";
     header('location:login_form.php');
 }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>แก้ไขข้อมูลส่วนตัว</h2>
        <form action="editprofile_db.php" method="post">
        <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user_login']; ?>" randomly disabled>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" require_once>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['firstname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['lastname']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">อายุ</label>
                 <input type="text" class="form-control" id="age" name="age" value="<?php echo $_SESSION['age']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">เพศ</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $_SESSION['gender']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_SESSION['phone']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">ที่อยู่</label>
                    <textarea name="address"class="form-control" id="address" cols="30" required ><?php echo $_SESSION['address']; ?></textarea>
            </div>
            <button type="submit" name="editprofile" class="btn btn-primary">บันทึก</button>
            <a href="index.php" class="btn btn-success">กลับหน้าหลัก</a>

        </form>
    </div>
</body>
</html>







