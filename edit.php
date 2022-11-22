<?php
    require_once('connect.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare('SELECT * FROM detail_review_food WHERE id = :id');
            $select_stmt->bindParam(":id", $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }   

    if(isset($_REQUEST['update'])){
        try{
            $foodname = $_REQUEST['foodname'];
            $fooddetail = $_REQUEST['fooddetail'];
            $foodregion = $_REQUEST['foodregion'];
            $price = $_REQUEST['price'];
            $foodimg = $_FILES['image']['name'];
            $type = $_FILES['image']['type'];
            $size = $_FILES['image']['size'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $path ="img_food/".$foodimg;
            $directory = "img_food/"; 

            if ($foodimg) {
                if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                    if (!file_exists($path)) { // check file not exist in your upload folder path
                        if ($size < 5000000) { // check file size 5MB
                            unlink($directory.$row['foodimage']); // unlink functoin remove previos file
                            move_uploaded_file($temp,$foodimg); // move upload file temperory directory to your upload folder
                        } else {
                            $errorMsg = "Your file to large please upload 5MB size";
                        }
                    } else {
                        $errorMsg = "File already exists... Check upload folder";
                    }
                } else {
                    $errorMsg = "Upload JPG, JPEG, PNG & GIF formats...";
                }
            } else {
                $foodimage = $row['foodimage']; // if you not select new image than previos image same it is it.
            }
            if(!isset($errorMsg)){
                $update_stmt = $db->prepare("UPDATE detail_review_food SET foodname = :fname_up, fooddetail = :fdetail_up, foodregion = :fregion_up, price = :fprice_up, foodimg = :fimage_up WHERE id = :id");
                $update_stmt->bindParam(':fname_up',$foodname);
                $update_stmt->bindParam(':fdetail_up',$fooddetail);
                $update_stmt->bindParam(':fregion_up',$foodregion);
                $update_stmt->bindParam(':fprice_up',$price);
                $update_stmt->bindParam(':fimage_up',$foodimg);
                if($update_stmt->execute()){
                    $updateMsg="File Upload Successfully...";
                    header("refresh:5;from.php");
                }
            }
        
        }catch(PDOException $e){
            $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container text-center">
        <h1>Insert file page</h1>
        <?php 
            if(isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <strong><?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php 
            if(isset($updateMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $updateMsg; ?></strong>
            </div>
        <?php } ?>
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="row">
            <label for="foodname" class="col-sm-3 control-label">Food Name</label>
            <div class="col-sm-6">
                <input type="text" name="foodname" class="form-control" placeholder="ชื่ออาหาร">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="fooddetail" class="col-sm-3 control-label">Food detail</label>
            <div class="col-sm-6">
                <input type="text" name="fooddetail" class="form-control" placeholder="รายละเอียดอาหาร">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="foodregion" class="col-sm-3 control-label">Food region</label>
            <div class="col-sm-6">
            <select name="foodregion" require>
				<option value="#">เลือกภาค</option>
				<option value="North">เหนือ</option>
				<option value="South">ใต้</option>
				<option value="Middle">กลาง</option>
				<option value="Esan">อีสาน</option>
            </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label for="price" class="col-sm-3 control-label">price</label>
            <div class="col-sm-6">
                <input type="text" name="price" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
            <div class="row">
            <label for="image" class="col-sm-3 control-label">image</label>
            <div class="col-sm-9">
                <input type="file" name="image" class="form-control">
                <p>
                    <img src="img_food/<?php echo $foodimage; ?>" height="100" width="100" alt="">
                </p>
            </div>
            </div>
        </div>
    <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="update" class="btn-success" value="update">
                <a herf=from.php class="btn-danger">cancel</a>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>