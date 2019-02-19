<?php // Filename: content.inc.php

// include file to connect to database
require __DIR__ . "/../db/mysqli_connect.inc.php";

// include file with functions used in the last lines of this file
require __DIR__ . "/../functions/functions.inc.php";

$orderby = 'last_name';
$filter = '';

// add filter if a filter parameter is set
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

// change/set $orderby if a sortby parameter is set
if (isset($_GET['sortby'])) {
    $orderby = $_GET['sortby'];
}

// remove filter if a clearfilter parameter is set
if (isset($_GET['clearfilter'])){
    $filter = '';
}

// set up database table based on filter and category (first name, last name, id, etc.)
$sql = "SELECT * FROM $db_table WHERE last_name LIKE '$filter%' ORDER BY $orderby ASC";

$result = $db->query($sql);

if ($result->num_rows == 0) {  # if filtered table has no records
    echo "<h2 class=\"mt-4 alert alert-warning\">No Records for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
} else {
    if(empty($filter)){
        $text = '';
    } else {  # display text below if there is a filter
        $text = " - last names starting with $filter";
    }
    echo "<h2 class=\"mt-4 alert alert-primary\">$result->num_rows Records" . $text . '</h2>';
}

// display alphabet filters
display_letter_filters($filter);

// display message if any
display_message();

// display the data
display_record_table($result);

# close the database
$db->close();