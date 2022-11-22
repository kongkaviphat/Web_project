<?php
    require_once('connection.php');
    if(isset($_REQUEST['insert'])){
        try{
            $foodname = $_REQUEST['foodname'];
            $fooddetail = $_REQUEST['fooddetail'];
            $foodregion = $_REQUEST['foodregion'];
            $price = $_REQUEST['price'];
            $foodimg = $_FILES['image']['name'];
            $type = $_FILES['image']['type'];
            $size = $_FILES['image']['size'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $path ="upload/".$foodimg;
            if(empty($foodname)){
                $errorMsg="Please Enter foodname";
            }else if(empty($fooddetail)){
                $errorMsg="Please Enter fooddetail";
            }else if(empty($price)){
                $errorMsg="Please Enter price";
            }else if(empty($foodregion)){
                $errorMsg="Please Enter foodregion";
            }else if(empty($foodimg)){
                $errorMsg="Please Select Image";
            }else if($type== "image/jpg" || $type== 'image/jpeg' || $type== 'image/png' || $type== 'image/gif'){
                if(!file_exists($path)){
                    if($size < 5000000){
                        move_uploaded_file($img_tmp,$path);
                    }else{
                        $errorMsg="Image size should be less then 5MB";
                    }
                }else{
                    $errorMsg="Image Already exists... Check Upload folder";
                }}
            else{
                $errorMsg="Please Upload JPG, JPEG, PNG & GIF File Formate..... CHECK FILE EXTENSION";
            }
            if(!isset($errorMsg)){
                $insert_stmt=$db->prepare('INSERT INTO detail_review_food(foodname,fooddetail,foodregion,price,foodimage) VALUES(:fname,:fdetail,:fregion,:fprice,:fimage)');
                $insert_stmt->bindParam(':fname',$foodname);
                $insert_stmt->bindParam(':fdetail',$fooddetail);
                $insert_stmt->bindParam(':fregion',$foodregion);
                $insert_stmt->bindParam(':fprice',$price);
                $insert_stmt->bindParam(':fimage',$foodimg);
                if($insert_stmt->execute()){
                    $insertMsg="File Upload Successfully...";
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
            if(isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $insertMsg; ?></strong>
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
            </div>
            </div>
        </div>
    <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="insert" class="btn-success" value="insert">
                <a herf=from.php class="btn-danger">cancel</a>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>