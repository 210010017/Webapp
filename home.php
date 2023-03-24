<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <h2>Welcome to Homepage</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        
        <label for="userid">Enter the patient userID:</label>
        <input id="userid" type="text" name="usr" value="" required><br><br>
        <input id="pdfid" type="file" name="pdfile" value="" accept=".pdf"
                 title="Upload PDF" required><br><br>
        <input id="smitid" type="submit" name="smit" value="upload">

    </from>

    <?php
    if(isset($_POST['smit']) and isset($_POST['usr'])){

        include 'db.php';
        $usrid=$_POST['usr'];
        $y = $_FILES['pdfile'];

        $pdf_nam=$_FILES['pdfile']['name'];
        $pdf_type=$_FILES['pdfile']['type'];
        $pdf_size=$_FILES['pdfile']['size'];
        $pdf_tem_loc=$_FILES['pdfile']['tmp_name'];
        $pdf_store="store/".$pdf_nam;

        move_uploaded_file($pdf_tem_loc,$pdf_store);

        $sql="insert into Docdoings(Username,Datapdf) values('$usrid',$y)";
        $query=mysqli_query($conn,$sql);

    
    ?>

    <!-- <form id="form" action="display_pdf.php" method="post">

        <input id="userid2" type="text" name="usr2" value="'$usrid'" style="visibility:hidden"><br><br>

    </from>
    <script>
        let form = document.getElementById("form");
        form.submit();
    </script> -->

    <?php
    }
    ?>
    <br><br>
    <button>logout</button>

</body>
</html>