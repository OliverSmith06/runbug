<!DOCTYPE html>
<html>
<?php
    include "setup.php";
    if(isset($_GET["page_id"])) {
        $page_id = $_GET["page_id"];
    } else {
        $page_id = 2;
    }
    ; 
    include "get_page_data.php";               
?>
<?PHP include "frameworks.php"; ?>
<?PHP 
    $numOfEventsSQL = "SELECT event_id
    FROM events";
    $numOfResult = $conn->query($numOfEventsSQL);
    if ($numOfResult->num_rows < 1) {
        echo "THERE ARE NO EVENTS TO WORK WITH";
    } else {
        while($row = $numOfResult->fetch_assoc()) {
            $numOfEvents = $row["event_id"];
        }
    }    
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>
<title>Runbug - Add Events</title>
<body>
    <div id="page_container">
<?php include "header.php"; 
        if(isset($_SESSION['eventMSG'])){
            echo $_SESSION['eventMSG'];
            if (($key = array_search($_SESSION['eventMSG'], $_SESSION)) !== false) {
                                    unset($_SESSION[$key]);
                                }
        }
?>

 <?php
    $uploadOK = 1;
     if(empty($sessData['userLoggedIn']) && empty($sessData['userID']) && (!$userData['admin'] || !$userData['org'])){ header("Location:index.php");}
//runs this if form is submited
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_FILES['fileToUpload']["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename("".$numOfEvents."_".$_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        //    $check = getimagesize($_FILES["fileToUpload"]["name"]);
        //    if($check !== false) {
        //        echo "File is an image - " . $check["mime"] . ".";
        //        $uploadOk = 1;
        //    } else {
        //        echo "File is not an image.";
        //        $uploadOk = 0;
        //    }

        // Check if file already exists
//        if (file_exists($target_file)) {
//            $uploadOk = 0;
//        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $eventMsg = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $eventMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            if(!empty($eventMsg)) {
            $_SESSION['eventMSG'] = '<div class="alertRed">
              <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
              '.$eventMsg.'
            </div>';
            header("Location: add_events.php");
            }
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } 
//        $img = $_FILES['fileToUpload']['name'];
    } else {}
//        $img = "placeholder.jpg";
            //gives submitted data a variable
    $title = $_POST['title'];
    $date = $_POST['date'];
    $info = $_POST['info'];
    $length = $_POST['length'];
    $location1 = $_POST['location1'];
    $location2 = $_POST['location2'];
    $location3 = $_POST['location3'];
    if(!empty($_FILES['fileToUpload']['name'])) {
        if ($uploadOk == 1) {
        $img = "".$numOfEvents."_".$_FILES["fileToUpload"]["name"]; }
        else {
            $img = "placeholder.jpg";
        }
    } else {
        $img = "placeholder.jpg";}

if ((strpos($title, "'") !== false) || (strpos($info, "'") !== false)) {
    $eventMsg = "Sorry, you cannot user apostrophes in your event name or extra info";
    $eventStatus = "Red";
    echo '<div class="alert'.$eventStatus.'">
      <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
      '.$eventMsg.'
    </div>';
} else {
    

    //saves variable to be used on another web page

    $sql = "INSERT INTO events (title, date, info, length, entered_user, firstLocation, secondLocation, thirdLocation, img)
    VALUES ('$title', '$date', '$info', '$length', '0', '$location1', '$location2', '$location3', '$img')";
    $eventMsg = 'You have successfully added the event.';
    $numOfEventsSQL = "";
    $addEventSQL = "";
    echo '<div class="alertGreen">
      <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
      '.$eventMsg.'
    </div>';
        $resultInsert = $conn->query($sql);
        //Take user to success page
        //header("Location: confirm_event.php");
}

    } else {

    }
?>       
        
        <main class="wrapper">
        <div id="addHeading" class="col span_3_of_3">
            <h1 class="pageHeading" >
                Add Event
            </h1>
           <div class="headingUnderline"></div>
        </div>

        <div class="section group">

        </div>
        <div id="event_form">
            <form action="add_events.php" method="post" enctype="multipart/form-data">
                Name of Event
                <input type="text" name="title" placeholder="Auckland Marathon" required=""><br>
                Date
                <input type="date" name="date" required="">
                Additional Information
                <input type="text" name="info" placeholder="ADD EXTRA INFO" required=""><br>
                Length (km)
                <input type="text" name="length" placeholder="" required=""><br>
                Event Image <br>
                <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
                Location
                <select name="location1" required="" location="0" id="locationSelect" onchange="showLocation(this.value)">
                <option disabled selected value="">Select a location</option>
                <?PHP
                    $location1SQL = "SELECT * FROM primarylocation WHERE NOT id = '0'";
                    $location1Result = $conn->query($location1SQL);
                    $_SESSION["location1"] = $row['location1'];
                    if ($location1Result->num_rows < 1) {
                        echo "ERROR";
                    } else {
                        while($row = $location1Result->fetch_assoc()) {
                            echo "<option value='".$row['id']."'>".$row['location1']."</option>";
                        }
                    }
                ?>
                </select>
                
                <div id="txtHint"><b></b></div>
                <div id="txtHint2"><b></b></div>
                <div class="send-button">
                    <input type="submit" name="submit" value="SUBMIT">
                </div>
            </form>
        </div>
        </main>

        <footer>

            <?php include "footer.html" ?>
        </footer>
    </div>
</body>
</html>

<?PHP include("auto_complete.php");?>