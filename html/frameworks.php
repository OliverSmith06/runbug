
<?php
if(isset($_GET['q'])){
    $q = intval($_GET['q']);
    echo '<select name="location2" required="" id="locationSelect" onchange="showSecondaryLocation(this.value)">';
    echo '<option selected required disabled> Please select a district </option>';
    include("setup.php");
    $location2SQL = "SELECT * FROM secondarylocation
    WHERE upperlocation = ".$q."";
    $location2Result = $conn->query($location2SQL);
    if ($location2Result->num_rows < 1) {
        echo "ERROR";
    } else {
        while($row = $location2Result->fetch_assoc()) {
            echo "<option value='".$row['id']."'>".$row['location2']."</option>";
        }
    }
    echo '</select>';
}

if(isset($_GET['r'])){
    $r = intval($_GET['r']);
    echo '<select name="location3" required="" id="locationSelect"">';
    echo '<option selected required disabled> Please select a suburb</option>';
    include("setup.php");
    $location2SQL = "SELECT * FROM tertiarylocation
    WHERE upperlocation = ".$r."";
    $location2Result = $conn->query($location2SQL);
    if ($location2Result->num_rows < 1) {
        echo "ERROR";
    } else {
        while($row = $location2Result->fetch_assoc()) {
            echo "<option value='".$row['id']."'>".$row['location3']."</option>";
        }
    }
    echo '</select>';
    
}

?>


