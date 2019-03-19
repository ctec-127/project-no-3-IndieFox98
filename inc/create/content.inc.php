<?php // Filename: content.inc.php

// include file to connect to database
require_once __DIR__ . "/../db/mysqli_connect.inc.php";

// require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

// http://php.net/manual/en/mysqli.real-escape-string.php

if($_SERVER['REQUEST_METHOD']=="POST"){
    // First insure that all required fields are filled in
    if (empty($_POST['first'])) {
        array_push($error_bucket,"<p>A first name is required.</p>");
    } else {
        # Older way
        #$first = $_POST['first'];
        # Old way
        # $first = $db->real_escape_string($_POST['first']);
        # New way
        $first = $db->real_escape_string(strip_tags($_POST['first']));
    }
    if (empty($_POST['last'])) {
        array_push($error_bucket,"<p>A last name is required.</p>");
    } else {
        #$last = $_POST['last'];
        #$last = $db->real_escape_string($_POST['last']);
        $last = $db->real_escape_string(strip_tags($_POST['last']));
    }
    if (empty($_POST['sid'])) {
        array_push($error_bucket,"<p>A student ID is required.</p>");
    } else {
        #$id = $_POST['id'];
        #$id = $db->real_escape_string($_POST['id']);
        $sid = $db->real_escape_string(strip_tags($_POST['sid']));
    }
    if (empty($_POST['email'])) {
        array_push($error_bucket,"<p>An email address is required.</p>");
    } else {
        #$email = $_POST['email'];
        #$email = $db->real_escape_string($_POST['email']);
        $email = $db->real_escape_string(strip_tags($_POST['email']));
    }
    if (empty($_POST['phone'])) {
        array_push($error_bucket,"<p>A phone number is required.</p>");
    } else {
        #$phone = $_POST['phone'];
        #$phone = $db->real_escape_string($_POST['phone']);
        $phone = $db->real_escape_string(strip_tags($_POST['phone']));
    }
    if (empty($_POST['gpa']) && $_POST['gpa'] != "0") {  # work around interpreting 0 as empty
        array_push($error_bucket,"<p>A GPA is required.</p>");
    } else {
        #$gpa = $_POST['gpa'];
        #$gpa = $db->real_escape_string($_POST['gpa']);
        $gpa = $db->real_escape_string(strip_tags($_POST['gpa']));
    }
    if (empty($_POST['program'])) {
        array_push($error_bucket,"<p>Please select your degree program.</p>");
    } else {
        #$program = $_POST['program'];
        #$program = $db->real_escape_string($_POST['program']);
        $program = $db->real_escape_string(strip_tags($_POST['program']));
    }
    if (empty($_POST['gday'])) {
        array_push($error_bucket,"<p>Please enter your graduation date.</p>");
    } else {
        #$gday = $_POST['gday'];
        #$gday = $db->real_escape_string($_POST['gday']);
        $gday = $db->real_escape_string(strip_tags($_POST['gday']));
    }
    if (!isset($_POST['aid']) || empty($_POST['aid']) && $_POST['aid'] != "0") {  # work around interpreting 0 as empty
        array_push($error_bucket,"<p>Please answer the Financial Aid section.</p>");
    } else {
        #$aid = $_POST['aid'];
        #$aid = $db->real_escape_string($_POST['aid']);
        $aid = $db->real_escape_string(strip_tags($_POST['aid']));
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "INSERT INTO $db_table (first_name,last_name,student_id,email,phone,gpa,financial_aid,degree_program,graduation_date) ";
        $sql .= "VALUES ('$first','$last',$sid,'$email','$phone',$gpa,$aid,'$program','$gday')";

        // comment in for debug of SQL
        // echo $sql;

        $result = $db->query($sql);
        if (!$result) {  # if there was an sql error (e.g. duplicate entry)
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you. ' .  
            $db->error . '.</div>';
        } else {
            echo '<div class="alert alert-success" role="alert">
            I saved that new record for you!
          </div>';
            // make GD sure the values stored are emptied for next time
            unset($first);
            unset($last);
            unset($sid);
            unset($email);
            unset($phone);
            unset($gpa);
            unset($aid);
            unset($program);
            unset($gday);
        }
    } else {
        display_error_bucket($error_bucket);
    }
}

?>
