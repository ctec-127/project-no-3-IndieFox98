<?php // Filename: content.inc.php

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // grab primary key from hidden field
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        $first = $db->real_escape_string(strip_tags($_POST['first']));
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        $last = $db->real_escape_string(strip_tags($_POST['last']));
    }
    if (empty($_POST['sid'])) {
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        $sid = $db->real_escape_string(strip_tags($_POST['sid']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        $phone = $db->real_escape_string(strip_tags($_POST['phone']));
    }
    if (empty($_POST['gpa']) && $_POST['gpa'] != "0") {
        array_push($error_bucket,"<p>A GPA is required.</p>");
    } else {
        $gpa = $db->real_escape_string(strip_tags($_POST['gpa']));
    }
    if (!isset($_POST['aid']) || empty($_POST['aid']) && $_POST['aid'] != "0") {
        array_push($error_bucket,"<p>Please answer the Financial Aid section.</p>");
    } else {
        $aid = $db->real_escape_string(strip_tags($_POST['aid']));
    }
    if (empty($_POST['program'])) {
        array_push($error_bucket,"<p>Please select your degree program.</p>");
    } else {
        $program = $db->real_escape_string(strip_tags($_POST['program']));
    }
    if (empty($_POST['gday'])) {
        array_push($error_bucket,"<p>Please enter your graduation date.</p>");
    } else {
        $gday = $db->real_escape_string(strip_tags($_POST['gday']));
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "UPDATE $db_table SET first_name='$first', last_name='$last', student_id=$sid, email='$email', phone='$phone', gpa='$gpa', financial_aid='$aid', degree_program='$program', graduation_date='$gday' WHERE id=$id";

        $result = $db->query($sql);
        if (!$result) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
            unset($first);
            unset($last);
            unset($sid);
            unset($email);
            unset($phone);
            unset($gpa);
            unset($aid);
            unset($program);
            unset($gday);
            unset($id);
        }
    } else {
        display_error_bucket($error_bucket);
    } // end of error bucket
} else {
    // check for record id (primary key)
    $id = $_GET['id'];
    // now we need to query the database and get the data for the record
    // note limit 1
    $sql = "SELECT * FROM $db_table WHERE id=$id LIMIT 1";
    // query database
    $result = $db->query($sql);
    // get the one row of data
    while($row = $result->fetch_assoc()) {
        $first = $row['first_name'];
        $last = $row['last_name'];
        $sid = $row['student_id'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gpa = $row['gpa'];
        $aid = $row['financial_aid'];
        $program = $row['degree_program'];
        $gday = $row['graduation_date'];
    }
}