<!DOCTYPE html>
<html>
<?php
    include "setup.php";
    if(isset($_GET["page_id"])) {
        $page_id = $_GET["page_id"];
    } else {
        $page_id = 4;
    }
    ; 
    include "get_page_data.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

</head>
<title>Runbug - Favourites</title>
<body>
    <div id="page_container">
<?php include "header.php";
                if(isset($_SESSION['eventMSG'])){
                $eventMSG = $_SESSION['eventMSG'];
                $eventStatus = $_SESSION['eventStatus'];
            echo '<div class="alert'.$eventStatus.'">
              <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
              '.$eventMSG.'
            </div>';
            if (($key = array_search($_SESSION['eventMSG'], $_SESSION)) !== false) {
                                    unset($_SESSION[$key]);
                                }
        }
?>
        <?PHP 
    $redirect = FALSE;
    $checkMissingSQL = "SELECT fav
    FROM `users`
    WHERE id = ".$userData['id']."";
    $checkMissingResult = $conn->query($checkMissingSQL);
    if($checkMissingResult->num_rows == 1){
    while($row = $checkMissingResult->fetch_assoc()) {
        $missingFav = $row['fav'];
                            //print_r($missingFav);
                            $missingFav = explode(",", $missingFav);

                                //print_r($missingFav);
                                foreach ($missingFav as $value) {
                                    if($value != ""){//print($value);
                                    $missingSQL = "SELECT *
                                    FROM `events`
                                    WHERE event_id = ".$value."";
                                    $missingResult = $conn->query($missingSQL);
                                    if($missingResult->num_rows < 1){
                                        if (($key = array_search($value, $missingFav)) !== false) {
                                            $redirect = TRUE;
                                            unset($missingFav[$key]);
                                        }
                                    }
                                }
                                }
                            
                            $newFavourite = implode(",", $missingFav);
                            $missingFavSQL = "UPDATE users
                            SET fav = '".$newFavourite."'
                            WHERE id = ".$userData['id']."";
                            if ($conn->query($missingFavSQL) === TRUE) {
                                if($redirect === TRUE){
                                    header("Location: favourites.php");
                                }
                                //echo "Record updated successfully";
                                //header("Location: favourites.php");
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
    }
    } else {echo "There is more than one user logged in!";}        
        
        ?>
        <main class="wrapper">
        
            <div id="favHeading" class="col span_3_of_3">
                <h1 class="pageHeading" >
                    Favourites
                </h1>
               <div class="headingUnderline"></div>
            </div>
        <div id="favourites" class="section group">
            
            <br>
            <div class="wrapper">
            <?php   
//                    $favArr = [];
                    $sqlFav = "SELECT fav
                    FROM `users`
                    WHERE id = ".$userData["id"]."";
                    $userJoinedResult = $conn->query($sqlFav);
                    if ($userJoinedResult->num_rows > 0) {
                        while($row = $userJoinedResult->fetch_assoc()) {
                            $fav = $row["fav"];
                            $favArr = explode (",", $fav);
                            $favLen = sizeof($favArr);
                            $favCounter = 0;
                     echo '<ul>';           
                    while($favCounter < $favLen - 1) {
                    //searches database for members that meet the prerequisites of the search
                    $sql = "SELECT *
                    FROM `events`
                    INNER JOIN users
                    ON events.entered_user = users.id
                    INNER JOIN primarylocation ON events.firstLocation = primarylocation.id
                    INNER JOIN secondarylocation ON events.secondLocation = secondarylocation.id
                    INNER JOIN tertiarylocation ON events.thirdLocation = tertiarylocation.id
                    WHERE event_id = ".$favArr[$favCounter]."";
                    $result = $conn->query($sql);
                    //outputs all students that meets the prerequisites of the search
                    if ($result->num_rows < 1) {
                        
                        //trigger_error('Invalid query: ' . $conn->error);
                        //echo "There are no events that match your search";
                    } else {
                            
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                date_default_timezone_set("Australia/Sydney");
                                $date = date("d-m-Y", strtotime($row["date"]));
                                $date = str_replace('-', '/', $date );
                                $part = $row["entered_user"];
                                $part_arr = explode (",", $part);
                                $newEntered = "FAILED";
                                $part_len = sizeof($part_arr);
                                $counter = 1;
                                echo '
                                <!-- Button to open the modal login form -->
                                <li class="gallery col span_1_of_3 '.$row["location1"].'">
                                    <div onclick="openWholeEvent(\'id0'.$row["event_id"].'\', event, \'a'.$row["event_id"].'\')">
                                        <img src="uploads/'.$row["img"].'" class="gal_img">
                                        <div class="desc"><p class="eventName">'.$row["title"].'</p><p class="eventDate"> '.$date.'</p></div>
                                    </div>    
                                </li>
                                <!-- The Modal -->
                                <div id="id0'.$row["event_id"].'" class="modal event-modal">
                                <div class="modal_info">
                                    <!-- Tab links -->
                                    <div class="tab">
                                        <div class=\'close\' onclick="openModal(\'id0'.$row["event_id"].'\')" >X</div>
                                      <button class="tablinks" onclick="openEvent(event, \'a'.$row["event_id"].'\')">Info</button>';
                                      if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID']) && ($userData['admin'] || $userData['org']))  {echo '<button class="tablinks" onclick="openEvent(event, \'b'.$row["event_id"].'\')">Current Entries</button>'; }
                                        echo '
                                    </div>

                                    <!-- Tab content -->
                                    <div id="a'.$row["event_id"].'" class="tabcontent">
                                      <h3>Title: '.$row["title"].'</h3>
                                      <p>Location: '.$row["location1"].', '.$row["location2"].', '.$row["location3"].'</p>
                                      <p>Extra Info: '.$row["info"].'</p>';
                                    echo '
                                    </div>
                                    <div id="b'.$row["event_id"].'" class="tabcontent">
                                      <h3>List of All Entered Participants for '.$row["title"].'</h3>
                                      <table id="racers">
                                        <tr>
                                            <th>'.$row["first_name"].'</th>
                                            <th>'.$row["last_name"].'</th>
                                            <th>'.$row["phone"].'</th>
                                            <th>'.$row["email"].'</th>
                                            <th>'.$row["age"].'</th>
                                          </tr>';
                                while($counter < $part_len) {
                                    $user_sql = "SELECT *
                                    FROM `users`
                                    WHERE id
                                    = '".$part_arr[$counter]."'";
                                    $user_result = $conn->query($user_sql);
                                    while($row = $user_result->fetch_assoc()) {    
                                        echo '  
                                        
                                        <tr>
                                            <td>'.$row["first_name"].'</td>
                                            <td>'.$row["last_name"].'</td>
                                            <td>'.$row["phone"].'</td>
                                            <td>'.$row["email"].'</td>
                                            <td>'.$row["age"].'</td>
                                          </tr>';

                                                            }
                                        $counter++;
                                } echo '
                                </table>

                                    </div>
                                </div>
                                </div>
                        ';
                        $counter = 0;
                        } 
                    }
                $favCounter++;
                
               }
            }
        }   echo '</ul>';
               ?>
            </div>
        </div>
        </main>

        <footer>
<script>

</script>
            <?php include "footer.html" ?>
        </footer>
    </div>
</body>
</html>