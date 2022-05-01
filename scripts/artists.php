<?php

include './credentials.php';
$cred = new credentials();


//declare array
$array = array();

//search term
$search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';

//sql query
$sql = "SELECT * FROM member where (member_name like '%$search_term%' OR member_email like '%$search_term%' OR member_surname  like '%$search_term%')";

$dbhost = $cred->dbhost;
$dbuser = $cred->dbuser;
$dbpass = $cred->dbpass;
$db = $cred->db;

$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        //assign row
        $array[] = $row;
    }
} else {
    
}
mysqli_close($conn);

$array = utf8_converter($array);
echo json_encode($array);

function utf8_converter($array) {
    array_walk_recursive($array, function(&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });

    return $array;
}

?>