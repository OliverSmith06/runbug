<!DOCTYPE html>
<html>
<?php
    include "setup.php";
    if(isset($_GET["page_id"])) {
        $page_id = $_GET["page_id"];
    } else {
        $page_id = 3;
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
<title>Runbug - View Events</title>
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
//                                    unset($_SESSION[$key]);
                                }
        }
?>
        <main class="wrapper">
            <div class="wrapper">
<!--                <div id="openFilter" onclick="openFilter()">Open filter <i class="arrow right"></i></div>-->
                <div id="filterButton" onclick="closeFilter()"><i class="arrow left"></i><i class="arrow left"></i></div>
                <div id="filter">
                    <div id="filterContent">
<!--                    <div id="closeFilter" onclick="closeFilter()"><i class="arrow left"></i><i class="arrow left"></i>Close filter</div>-->
                        
                    <form>
                        <ul>
                            <div>
                                
                                <input id="txtField" type="text" name="search" placeholder="Search . . ." onkeyup="textSearch()">
                            </div>
                            <div id="dateField">
                                <span class="dateButton selected" id="eventsAll" onclick="dateSearch('all')">All</span>
                                <span class="dateButton" id="eventsRecent" onclick="dateSearch('recent')">Recent</span>
                                <span class="dateButton" id="eventsUpcoming" onclick="dateSearch('upcoming')">Upcoming</span>
                                
                            </div>
                            <div>
                                <div id="location">
                                    Location
                                </div>
                                <label class="locationContainer"> Auckland
                                    <input checked type="checkbox" onchange="locationSearch('Auckland')" value="1">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="locationContainer"> Northland
                                    <input checked type="checkbox" onchange="locationSearch('Northland')" value="2">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="locationContainer"> Waikato
                                    <input checked type="checkbox" onchange="locationSearch('Waikato')" value="Waikato">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </ul>
                        <script>
                        
                        
                        
                        </script>
                    </form>
                    </div>
                </div>
                
        <div id="testing" class="section group">
<!--
            <div class="col span_2_of_3 title">

            </div>
-->
           <div class="col span_3_of_3">
                <h1  class="pageHeading" >
                    Events
                </h1>
               <div class="headingUnderline"></div>
            </div>  
            <br>
            
            <?php   
                    //searches database for members that meet the prerequisites of the search
                    $isRecentWhere = ">";
                    $isRecentOrder = "ASC";
                    if(isset($_GET["recent"])) {
                        $isRecentWhere = "<";
                        $isRecentOrder = "DESC";
                    } else {
                        $isRecentWhere = ">";
                        $isRecentOrder = "ASC";
                    }
                    $sql = "SELECT *
                    FROM `events`
                    INNER JOIN users
                    ON events.entered_user = users.id
                    INNER JOIN primarylocation ON events.firstLocation = primarylocation.id
                    INNER JOIN secondarylocation ON events.secondLocation = secondarylocation.id
                    INNER JOIN tertiarylocation ON events.thirdLocation = tertiarylocation.id
                    ORDER BY date ".$isRecentOrder."";
                    $result = $conn->query($sql);
                    
                    //outputs all students that meets the prerequisites of the search
                    if ($result->num_rows < 1) {
                        echo "There are no events that match your search";
                    } else {
                        if(isset($_POST["delete"])) {
                            $deleteEvent = $_POST["eventID"];
                            $sqlDelete = "DELETE FROM events
                            WHERE event_id = ".$deleteEvent."";      
                            if ($conn->query($sqlDelete) === TRUE) {
                            header("Location:view_events.php");
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }
                        }
                        
                        if(isset($_POST["join"])) {
                            $currentUsers = $_POST['currentUsers'];
                            $eventID = $_POST['eventID'];
                            $userID = $_POST['user'];
                            if (strpos($currentUsers, $userID) !== false) {
                                $currentUsers = explode(",", $currentUsers);
                                if (($key = array_search($userID, $currentUsers)) !== false) {
                                    unset($currentUsers[$key]);
                                }
                                    $newUsers = implode(",", $currentUsers);
                                    $sqlLeave = "UPDATE events
                                    SET entered_user='".$newUsers."'
                                    WHERE event_id=".$eventID."";
                                    if ($conn->query($sqlLeave) === TRUE) {
                                        echo "Record updated successfully";
                                        $_SESSION["eventStatus"] = "Green";
                                        $_SESSION["eventMSG"] = "You have left the event!";
                                    } else {
                                        echo "Error updating record: " . $conn->error;
                                    }
                                    
                                
                            } else {
                            $newEntered = $currentUsers.','.$userID.'';
                            $sqlJoin = "UPDATE events
                            SET entered_user='".$newEntered."'
                            WHERE event_id=".$eventID."";
                            if ($conn->query($sqlJoin) === TRUE) {
                                echo "Record updated successfully";
                                $_SESSION["eventStatus"] = "Green";
                                $_SESSION["eventMSG"] = "You have joined the event!";
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                          
                            }
                            header("Location:view_events.php");
                        }
                        
                        if(isset($_POST["favourite"])) {
                            $newFav = $_POST['eventID'];
                            $favEvents = $_POST['favEvents'];
                            $userID = $userData["id"];
                            if(strpos($favEvents, $newFav) !== false) {
                                $favEvents = explode(",", $favEvents);
                                if (($key = array_search($newFav, $favEvents)) !== false) {
                                    unset($favEvents[$key]);
                                }
                                    $newFavs = implode(",", $favEvents);
                                    $sqlUnFav = "UPDATE users
                                    SET fav='".$newFavs."'
                                    WHERE id=".$userID."";
                                    if ($conn->query($sqlUnFav) === TRUE) {
                                        echo "Record updated successfully";
                                        $_SESSION["eventStatus"] = "Green";
                                        $_SESSION["eventMSG"] = "Event removed from your favourites";
                                    } else {
                                        echo "Error updating record: " . $conn->error;
                                    }
                                    
                                
                            } else {
                            $favEvents .= ''.$newFav.',';
                            $sqlFav = "UPDATE users
                            SET fav='".$favEvents."'
                            WHERE id=".$userData["id"]."";
                            if ($conn->query($sqlFav) === TRUE) {
                                echo "Record updated successfully";
                                $_SESSION["eventStatus"] = "Green";
                                $_SESSION["eventMSG"] = "Event Favourited";
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                            
                            }
                            header("Location:favourites.php");                           
                        }
                    
                            echo '<ul id="allEvents">';
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
                                        <img src="uploads/'.$row["img"].'" class="gal_img" width="100%" height="140">
                                        <div class="desc"><p class="eventName">'.$row["title"].'</p><p class="eventDate"> '.$date.'</p></div>
                                    </div>
                                </li>
                                <!-- The Modal -->
                                <div id="id0'.$row["event_id"].'" class="modal event-modal ">
                                <div class="modal_info">
                                    <!-- Tab links -->
                                    <div class="tab">
                                        <div class=\'close\' onclick="openModal(\'id0'.$row["event_id"].'\')" >X</div>
                                      <button class="tablinks" onclick="openEvent(event, \'a'.$row["event_id"].'\')">Info</button>
                                      '; if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID']) && ($userData['admin'] || $userData['org']))  {echo '<button class="tablinks" onclick="openEvent(event, \'b'.$row["event_id"].'\')">Current Entries</button>'; }echo '
                                    </div>

                                    <!-- Tab content -->
                                    <div id="a'.$row["event_id"].'" class="tabcontent">
                                      <h3>Title: '.$row["title"].'</h3>
                                      <p>Location: '.$row["location1"].', '.$row["location2"].', '.$row["location3"].'</p>
                                      <p>Extra Info: '.$row["info"].'</p>
                                      <p>Date (dd-mm-yyyy): ';
                                        if($row["date"] < date("Y-m-d")) {
                                            echo "ITS ALREADY HAPPENED";
                                        } else {
                                            echo $date;} echo '</p>';
                                
                                                
  
                                            if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
                                                echo '
                                                <div>
                                                            <form action="view_events.php" method="post">
                                                                <input type="hidden" value="'.$row["event_id"].'" name="eventID">
                                                                <input type="hidden" value="'.$row["entered_user"].'" name="currentUsers">
                                                                <input type="hidden" value="'.$userData["id"].'" name="user">
                                                                <input type="submit" name="join" value="';if(strpos($row["entered_user"], $userData["id"]) !== false) {echo 'Leave';}else{echo 'Join';} echo '">
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <form action="view_events.php" method="post">
                                                                <input type="hidden" value="'.$userData["fav"].'" name="favEvents">
                                                                <input type="hidden" value="'.$row["event_id"].'" name="eventID">
                                                                <input type="submit" name="favourite" value="';if(strpos($userData["fav"], $row["event_id"]) !== false) {echo 'Unfavourite';}else{echo 'Favourite';} echo '">
                                                            </form>
                                                        </div>
                                                ';
                                                if($userData['admin']) {
                                                    echo '
                                                        <div>
                                                            <form id="delete" action="view_events.php" method="post">
                                                                <input type="hidden" value="'.$row["event_id"].'" name="eventID">
                                                                <input type="submit" name="delete" value="Delete">
                                                            </form>
                                                        </div>
                                                    '; 
                                                }
                                            } 
                                            
                                            
                                            
                                     if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID']) && ($userData['admin'] || $userData['org']))  {     
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
                                ';} echo '
                                    </div>
                                </div>
                                </div>
                        '; 
                        $counter = 0;
                        } echo '</ul>';
                    }
               
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