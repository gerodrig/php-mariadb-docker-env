<?php

 $connect = mysqli_connect(
    'db',
    'gerardo',
    'password',
    'php_docker'
 );

 if(!$connect){
    die("Connection failed: " . mysqli_connect_error());
 }

 $table_name = "test_table";

 $query = "SELECT * FROM $table_name";

 if($response = mysqli_query($connect, $query)){
    echo "<strong>$table_name: </strong>";
    while ($row = mysqli_fetch_assoc($response)){
        echo "<p>" . htmlspecialchars($row['title']) . "</p>";
        echo "<p>" . htmlspecialchars($row['body']) . "</p>";
        echo "<p>" . htmlspecialchars($row['date_created']) . "</p>";
        echo "<hr>";
    }
    mysqli_free_result($response);
 } else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);
 }

    mysqli_close($connect);
?>