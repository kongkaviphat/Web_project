<?php
session_start();
require_once('connection.php');
require_once('connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/final.css">
    <title>Document</title>
    <style>
        *{
            font-family: 'Noto Sans Thai', sans-serif;
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
            </ul>
        </nav>
        <nav>
            <ul class="nav_link">
                <li><a href="register_form.php" class="btn-logout">สมัครสมาชิก</a></li>
                <li><a href="login_form.php" class="ul_link">ล็อคอิน</a></li>
        </ul>
        </nav>
    </header>
    <section id="sect">
    <form action="search.php" class="Search" method="POST" >
        <input type="text" name="foodname" placeholder="ชื่ออาหาร" pattern="[ก-๏\s]{1,}">
        <input type="submit" name="search" value="ค้นหา">
    </form>
    </section >
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
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>สำหรับผู้ใช้ JAME</h4>
                    <li>เกี่ยวกับ JAME</li>
                    <li>ตารางอันดับผู้ใช้งาน</li>
                    <li>แนวทางปฎิบัติของผู้ใช้งาน</li>
                </div>
                <div class="footer-col">
                    <h4>สำหรับร้านหรือธุรกิจ</h4>
                    <li>แจ้งเป็นเจ้าของร้าน</li>
                    <li>ลงโฆษณากับ JAME</li>
                    <li>บทความเทคนิคทางการตลาด</li>
                </div>
                <div class="footer-col">
                    <h4>เกี่ยวกับ</h4>
                    <li>ติดต่อเรา</li>
                    <li>ศูนย์ช่วยเหลือ</li>
                </div>
                <div class="footer-col">
                    <h4>Follow us</h4>
                    <img class="facebook" src="img/fb.png" alt="facebook" width="30" height="30">
                    <img class="line" src="img/line.png" alt="line" width="30" height="30">
                    <img class="twitter" src="img/twitter.png" alt="twitter" width="30" height="30">
                    <img class="instagram" src="img/instagram.png" alt="instagram" width="30" height="30">
                    <img class="youtube" src="img/youtube.png" alt="youtube" width="30" height="30">
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>