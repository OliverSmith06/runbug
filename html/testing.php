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
</head>
<title>HTML Tutorial</title>
<body>
    <div id="page_container">
<?php include "header.php" ?>
<?PHP
               if(!empty($sessData['status']['msg'])){
                echo '<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
  '.$sessData["status"]["msg"].'
</div>'; }?>
               
               
        <div class="slideshow">
            <style>
                .slideshow{
                    background-image: url(img/<?PHP print($img) ?>);
                }
            </style>
        </div>
        <main class="wrapper">
            
            
            
            

<?PHP 
$date30 = GETDATE();
print_r ($date30);           
?>
            
            
            
            
<?PHP
            
$dateSelect = "SELECT date FROM events";
$dateResult = $conn->query($dateSelect);
                    
                    //outputs all students that meets the prerequisites of the search
                    if ($dateResult->num_rows < 1) {
                        echo "There are no events that match your search";
                    } else {
                        while($row = $dateResult->fetch_assoc()) {
                        echo "".$row['date']."";
                        $epochTime = strtotime($row['date']);
                        echo "<br>";
                        echo $epochTime;
                        echo "<br>";
                        }
                    }

?>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </main>

        <footer>

            <?php include "footer.html" ?>
        </footer>
    </div>
</body>
</html>