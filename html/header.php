<?php include "user_connect.php" ?>

<div class="header">
    <div class="banner wrapper">
        <div id="logo">
            Runbug
        </div>
        <?php if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
                                   echo "<a class='loginButton' id='logout' href='userAccount.php?logoutSubmit=1' class='logout'>Logout</a>";
                    }else{
                        echo "                           <!-- Button to open the modal login form -->
                    <div class='loginButton' onclick=\"closeModal('loginModal')\">
                        <a>Login</a>
                    </div>    
                <!-- The Modal -->
                <div id='loginModal' class='modal login-modal'>
                     <div class='modal-content modal_info' id='loginContent'>
                     <div class='close' onclick=\"openModal('loginModal')\" >X</div>
                    ";
                    include('loginModal.php');     
                    echo "                      
                    </div>             
               </div></div>";
                    } ?>
        <div id="nav">
            
            <ul>
                <li>
                   
                </li>
                <?php if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){ echo '<li><a href="favourites.php">Favourites</a></li>'; } ?>
<!--
                <li>
                    <div class="dropdown">
                      <span>Events</span>
                      <div class="dropdown-content">
                        <a href="view_events.php">Upcoming events</a>
                        <a href="view_events.php?recent">Recent events</a>
                      </div>
                    </div>
                </li>
-->
                <?PHP if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID']) && ($userData['admin'] || $userData['org'])){ echo '<li><a href="add_events.php">Add event</a></li>'; } ?>
                <li><a href="view_events.php">Events</a></li>
                <li><a href="index.php">Home</a></li>
                
                
            </ul>
        </div>
        <div id="sidebutton" onclick="openNav()">
        <div class="menu"></div>
        <div class="menu"></div>
        <div class="menu"></div>
        </div>
        <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php">Home</a>
            <?PHP if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID']) && ($userData['admin'] || $userData['org'])){ echo '<a href="add_events.php">Add event</a>'; } ?>
            <a href="view_events.php?recent">Recent events</a>
            <a href="view_events.php">Upcoming events</a>
            <?php if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){ echo '<a href="favourites.php">Favourites</a>'; } ?>
        </div>
    </div>
</div>