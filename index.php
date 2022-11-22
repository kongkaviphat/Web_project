<?php
session_start();
require_once('connection.php');
require_once('connect.php');


if(!isset($_SESSION['user_login'])){
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบก่อน";
    header('location:login_form.php');
}
if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $select_stmt = $db->prepare('SELECT * FROM detail_review_food WHERE id = :id');
    $select_stmt->bindParam(':id', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    unlink("upload/".$row['foodimage']); // unlin functoin permanently remove your file

    // delete an original record from db
    $delete_stmt = $db->prepare('DELETE FROM detail_review_food WHERE id = :id');
    $delete_stmt->bindParam(':id', $id);
    $delete_stmt->execute();

    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/TEST.css"> 
    <!-- ฟ้อนต์ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
    
    
    <title>Document</title>
    <style>
        *{
            font-family: 'Noto Sans Thai', sans-serif; /* font all */
        }
    </style>
</head>

<body>
    <header class="header1">
        <img class="logo" src="img/image.png" alt="logo" width="50" height="50">
            <nav>
            <ul class="nav_link">
                <li><a href="reviewfood_north.php">ภาคเหนือ</a></li>
                <li><a href="reviewfood_middle.php">ภาคกลาง</a></li>
                <li><a href="reviewfood_south.php">ภาคใต้</a></li>
                <li><a href="reviewfood_esan.php">ภาคอีสาน</a></li>
                <li><select class="form-select" aria-label="Default select example" onchange="location = this.value;">
                    <option selected >เลือกร้านอาหาร</option>
                    <option value="restaurant_1.php">ครัวเชียงใหม่</option>
                    <option value="restaurant_2.php">ศรีชา</option>
                    <option value="restaurant_3.php">Din Din Thai Cuisine</option>
                    <option value="restaurant_4.php">Phed Phed Cafe</option>
                    </select>
                </li>
                <li><a href="add.php" class="btn btn-success">เพิ่มข้อมูล</a></li>
                <li><a href="logout.php" class="btn-logout">ออกจากระบบ</a></li>
                <li><a href="editprofile_form.php" class="ul_link">แก้ไขข้อมูลส่วนตัว</a></li>
                
            </ul>
        </nav>
    </header>
    <section id="sect">
        <form action="search.php" class="Search" method="POST" >
            <input type="text" name="foodname" placeholder="ชื่ออาหาร" pattern="[ก-๏\s]{1,}"> <!-- pattern -->
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        </form>
    </section>

    <div class="container text-center">
        <h1>Reviewfood</h1>
    <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td class="table-info">foodname</td>
                    <td class="table-info">fooddetail</td>
                    <td class="table-info">foodregion</td>
                    <td class="table-info">price</td>
                    <td class="table-info">Image</td>
                    <td class="table-info">Edit</td>
                    <td class="table-info">Delete</td>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $select_stmt = $db->prepare('SELECT * FROM detail_review_food');
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {  
                ?>
                    <tr>
                        <td><?=$row["foodname"]?></td>
                        <td><?=$row["fooddetail"]?></td>
                        <td><?=$row["foodregion"]?></td>
                        <td><?=$row["price"]?> บาท</td>                
                        <td><img src="img_food/<?php echo $row['foodimage']; ?>"width="200px" height="200px" alt=""></td>                        
                        <td><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a></td>                        
                        <td><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-c">
                <h4 class=H4>สำหรับผู้ใช้</h4>
                    <li>เกี่ยวกับ JAME</li>
                    <li>ตารางอันดับผู้ใช้งาน</li>
                    <li>แนวทางปฎิบัติของผู้ใช้งาน</li>
                </div>
                <div class="footer-c">
                <h4 class=H4>สำหรับร้านหรือธุรกิจ</h4>
                    <li>แจ้งเป็นเจ้าของร้าน</li>
                    <li>ลงโฆษณากับ JAME</li>
                    <li>บทความเทคนิคทางการตลาด</li>
                </div>
                <div class="footer-c">
                <h4 class=H4>เกี่ยวกับ</h4>
                    <li>ติดต่อเรา</li>
                    <li>ศูนย์ช่วยเหลือ</li>
                </div>
                <div class="footer-c">
                    <h4 class=H4>Follow us</h4>
                    <img class="facebook" src="img/fb.png" alt="facebook" width="30" height="30">
                    <img class="line" src="img/line.png" alt="line" width="30" height="30">
                    <img class="twitter" src="img/twitter.png" alt="twitter" width="30" height="30">
                    <img class="instagram" src="img/instagram.png" alt="instagram" width="30" height="30">
                </div>
            </div>
        </div>
    </footer>
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>