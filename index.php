<?php

    //please check your hosting name(offline), username ,password, and database name
    $conn = mysqli_connect('localhost','root','','stdpro');

    if(isset($_POST['btn'])){
        $stdname = $_POST['stdname'];
        $stdreg = $_POST['stdreg'];

        if(!empty($stdname) && !empty($stdreg)){
            $query = "INSERT INTO student(stdname,stdreg) VALUE('$stdname', $stdreg)";
            $createquery = mysqli_query($conn,$query);
            if($createquery){
                echo 'Data Insert Sucessfully';
            }
        }else{
            echo 'Please Insert Data';
        }
    }
?>
<?php
    if(isset($_GET['delete'])){
        $stdID = $_GET['delete'];
        $query = "DELETE FROM student WHERE id={$stdID}";
        $deletequrey= mysqli_query($conn, $query);

        if($deletequrey){
            echo 'delete Completed';
        }
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Crud Operation</title>
  </head>
  <body>
    
    
    
    <div class="container-fluid">
        <div class="row shadow  m-5 p-5">
        <div class="col-xl-12">
            <h2 class='text-center'>Simple Update Delect Read Application</h2>
            <hr>
            <form action="" method="post" class="d-flex justify-content-arround">
                <input class="form-control" type="text" name="stdname" placeholder="Enter Your Name">
                <input class="form-control" type="number" name="stdreg" placeholder="Enter Your Roll">
                <input type="submit"  value="Send" name='btn' class="btn btn-success">
            </form>
        </div>
    </div>
    </div>
    <div class="container m-5 p-5">
    <div class="row">
        <div class="col-xl-12">
            <form action="" method="post" class="d-flex justify-content-arround">
                <?php 
                   if(isset($_GET['update'])){
                    $stdID = $_GET['update'];
                    $query = "SELECT* FROM student WHERE id={$stdID}";
                    $getdata= mysqli_query($conn, $query);

                    while($rx=mysqli_fetch_assoc($getdata)){
                        $stdID = $rx['ID'];
                        $stdname = $rx['stdname'];
                        $stdreg = $rx['stdreg'];
                        ?>
                <input class="form-control" type="text" name="stdname" value="<?php echo $stdname; ?>">
                <input class="form-control" type="number" name="stdreg" value="<?php echo $stdreg; ?>">
                <input type="submit"  value="Update" name='update_btn' class="btn btn-primary">
                <?php         
                    }
                } 
                ?>
                <?php 
                    if(isset($_POST['update_btn'])){
                        $stdname = $_POST['stdname'];
                        $stdreg =$_POST['stdreg'];

                        if(!empty($stdname) && !empty($stdreg)){
                            $query = "UPDATE student SET stdname='$stdname' , stdreg=$stdreg WHERE ID=$stdID";
                            $updatequery= mysqli_query($conn,$query);
                            if($updatequery){
                                echo "Data Updated Sucessfull";
                            }
                        }else{
                            echo "Please Insert Data ";
                        }
                    }
                ?>
            </form>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="row">
            <table class= "table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Student Registration</th>
                </tr>
                <?php 
                    $query = "SELECT* FROM student";
                    $readquery = mysqli_query($conn, $query);
                    if($readquery->num_rows > 0){
                        while($rd=mysqli_fetch_assoc($readquery)){
                            $stdID = $rd['ID'];
                            $stdname = $rd['stdname'];
                            $stdreg = $rd['stdreg'];
                        ?>
                <tr>
                    <td><?php echo $stdID; ?></td>
                    <td><?php echo $stdname; ?></td>
                    <td><?php echo $stdreg; ?></td>
                    <td><a href="index.php?update=<?php echo $stdID; ?>" class="btn btn-info" >Update</a></td>
                    <td><a href="index.php?delete=<?php echo $stdID; ?>" class="btn btn-danger" >Delete</a></td>
                </tr>
                    <?php

                        }}else{
                            echo 'No Data Found';
                        }
                ?>
            </table>
        </div>
    </div>

    
    
    
    
    
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
