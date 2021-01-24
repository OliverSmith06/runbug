<!DOCTYPE html>
<html>
<?php
    include "setup.php";
    if(isset($_GET["page_id"])) {
        $page_id = $_GET["page_id"];
    } else {
        $page_id = 1;
    }
    ; 
    include "get_page_data.php"               
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<title>Runbug - Home</title>
<body>
    <div id="page_container">
<?php include "header.php" ?>
<?PHP
               if(!empty($sessData['status']['msg'])){
                $status = "Green";
                if($sessData["status"]["type"] == "error") {
                    $status = "Red";
                }
                echo '<div class="alert'.$status.'">
  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
  '.$sessData["status"]["msg"].'
</div>'; }?>
               
               

        <main class="wrapper">
            <div id="home" class="col span_3_of_3">
                <h1  class="pageHeading" >
                    Home
                </h1>
               <div class="headingUnderline"></div>
            </div> 

        <div class="section group">
 
           <div class="col span_1_of_3">
               
 <?php echo $para1; ?>   
            </div>
           <div class="col span_2_of_3 img">
               <img id="group-run" class="center" src="img/big_run.jpg" href="img/big_run.jpg" alt="group-run">
           </div>
        </div>
        </main>

        <footer>

            <?php include "footer.html" ?>
        </footer>
    </div>
</body>
</html>