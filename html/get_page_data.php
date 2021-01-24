<?php
$sql = "SELECT * FROM pages WHERE page_id='$page_id' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $page_id = $row["page_id"];
        $title = $row["title"];
        $para1 = $row["para1"];
        $img = $row["img"];
        $title2 = $row["title2"];
        $para2 = $row["para2"];
    }
} else {
    echo "0 results";
}

$sql = "SELECT img FROM pages WHERE page_id=1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $img = $row["img"];
    }
} else {
    echo "0 results";
}

?>
<!---->