<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display pdf</title>

    <style>
      * {
        box-sizing: border-box;
      }
      .openBtn {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: fixed;
      }
      .loginPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
      }
    </style>

</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        
        <label for="userid2">Enter the patient userID:</label>
        <input id="userid2" type="text" name="usr2" value=""><br><br>
        <input id="smitid2" type="submit" name="smit2" value="search">

    </form>


    <?php        
    if(isset($_POST['usr2']) and isset($_POST['smit2'])){

    ?>
        <table>
        <thead>
            <th>ID</th>
            <th>UserName</th>
            <th>FileName</th>
        </thead>
        <tbody>
        <?php
        include 'db.php';
        $date = date("Y-m-d");
        $pr = intval(substr($date,-2));
        $pd = (string)($pr-1);
        $pdate = substr_replace($date,$pd,-2);

        $sql="select * from Docdoings where whenup='$pdate'";
        $query = mysqli_query($conn,$sql);
        while($info=mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $info['priid']; ?></td>
            <td><?php echo $info['Username']; ?></td>
            <td><a href="store/<?php echo $info['Datapdf'];?>"> <?php echo $info['Datapdf'];?></a></td>
        </tr>
        <?php 
        }
        ?>
        </tbody>
        </table>

    <p>***************************************************************</p>


    <?php
        // include'db.php';

        $usrid=$_POST['usr2'];

    ?>
    <div class="div1">
    <table>
        <thead>
            <th>ID</th>
            <th>UserName</th>
            <th>FileName</th>
        </thead>
        <tbody>
        <?php
        $sql="select * from Docdoings where Username='$usrid'";
        $query = mysqli_query($conn,$sql);
        while($info=mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $info['priid']; ?></td>
            <td><?php echo $info['Username']; ?></td>
            <td><a href="store/<?php echo  $info['Datapdf'];?>"><?php echo $info['Datapdf'];?></a> </td>
            <!-- <td> -->
            <!-- <button onclick="openForm()">Delete</button> -->
            <!-- </td> -->
            <!-- <div class="formPopup" id="popupForm">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="usr3" value=""><br><br>
                    <input id="smitid3" type="submit" name="smit3" value="Yes">
                    <button type="button" onclick="closeForm()">No</button>
                </form>
            </div> -->
            <td>
                <div class="openBtn">
                    <button class="openButton" onclick="openForm()">Delete</button>
                </div>
            </td>
                <div class="loginPopup">
                <div class="formPopup" id="popupForm">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formContainer">
                    <h2>Are you sure, continue to delete?</h2>
                    <input class="btn" id="smitid3" type="submit" name="smit3" value="Yes">  
                    <!-- <button type="submit" class="btn">Log in</button> -->
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                </div>
                </div>
        

        </tr>
        <?php 
        }
        ?> 
        </tbody>
    </table>
    </div>
    <?php
    }
    ?>
    
    <?php

        if(isset($_POST['smit3'])){

            include'db.php';
            $x= $_POST['usr3'];

            $sql="DELETE FROM docdoings WHERE priid='$x'";
            $s = mysqli_query($conn,$sql); 
            // if ($s){
            //     echo 2;
            // }
            // else{
            //     echo 3;
            // }

        }   
        
    ?>
<script>
function openForm(){
    document.getElementById("popupForm").style.display = "block";
}
function closeForm() {
    document.getElementById("popupForm").style.display = "none";
}
</script>

</body>
</html>