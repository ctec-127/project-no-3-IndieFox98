<?php // Filename: content.inc.php

// include file to connect to database
require_once __DIR__ . "/../db/mysqli_connect.inc.php";

// require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // New search method
    $filled = 0;

    $sql = "SELECT * FROM $db_table WHERE ";
    $searched = "<br>";
    if (!empty($_POST['first'])) {
        $sql .= " first_name LIKE '" . $_POST['first'] . "'";
        $searched .= "<br>FIRST NAME \"" . $_POST['first'] . "\"";
        $filled++;
    }
    if (!empty($_POST['last'])) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " last_name LIKE '" . $_POST['last'] . "'";
        $searched .= "<br>LAST NAME \"" . $_POST['last'] . "\"";
        $filled++;
    }
    if (!empty($_POST['sid'])) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " student_id LIKE '" . $_POST['sid'] . "'";
        $searched .= "<br>STUDENT ID \"" . $_POST['sid'] . "\"";
        $filled++;
    }
    if (!empty($_POST['email'])) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " email LIKE '" . $_POST['email'] . "'";
        $searched .= "<br>EMAIL \"" . $_POST['email'] . "\"";
        $filled++;
    }
    if (!empty($_POST['phone'])) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " phone LIKE '" . $_POST['phone'] . "'";
        $searched .= "<br>PHONE \"" . $_POST['phone'] . "\"";
        $filled++;
    }
    if (!empty($_POST['gpa']) || $_POST['gpa'] == "0") {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " gpa LIKE '" . $_POST['gpa'] . "'";
        $searched .= "<br>GPA \"" . $_POST['gpa'] . "\"";
        $filled++;
    }
    if (!empty($_POST['program'])) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " degree_program LIKE '" . $_POST['program'] . "'";
        $searched .= "<br>DEGREE PROGRAM \"" . $_POST['program'] . "\"";
        $filled++;
    }
    if (!empty($_POST['gday'])) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " graduation_date LIKE '" . $_POST['gday'] . "'";
        $searched .= "<br>GRADUATION DATE \"" . $_POST['gday'] . "\"";
        $filled++;
    }
    if (isset($_POST['aid']) && (!empty($_POST['aid']) || $_POST['aid'] == "0")) {
        if ($filled != 0) {
            $sql .= " AND ";
        }
        $sql .= " financial_aid LIKE '" . $_POST['aid'] . "'";
        $searched .= "<br>AID \"" . $_POST['aid'] . "\"";
        $filled++;
    }
    if ($filled != 0) { // check if any of the fields have been filled in
        $result = $db->query($sql);

        if ($result->num_rows == 0) {
            echo "<p class=\"alert alert-danger\" role=\"alert\">No results have been found. Please try again.</p>";
        } else {
            echo "<p class=\"alert alert-success\" role=\"alert\">$result->num_rows record(s) found for " . $searched . " </p>";
            echo "<div class=\"small\">";
            display_record_table($result);
            echo "</div>";
        }
    } else {
        echo "<p class=\"alert alert-warning\" role=\"alert\">I can't search if you don't give me something to search for.</p>";
    }

    // Old search method, used for reference

    /*if(!empty($_POST['search'])){
        $sql = "SELECT * FROM $db_table WHERE " . '"' . $_POST["search"] . '"' . " IN (student_id, first_name, last_name, email, phone, gpa, financial_aid, degree_program) ORDER BY last_name ASC";
        // $sql = "SELECT * FROM student WHERE student_id LIKE '%val%' or field2 LIKE '%val%'
        $result = $db->query($sql);

        if ($result->num_rows == 0) {  # displays if there ARE NO search results
            echo "<p class=\"display-4 mt-4 text-center\">No results found for \"<strong>{$_POST['search']}</strong>\"</p>";
            echo '<img class="mx-auto d-block mt-4" src="img/frown.png" alt="A sad face">';
            echo "<p class=\"display-4 mt-4 text-center\">Please try again.</p>";
            // echo "<h2 class=\"mt-4\">There are currently no records to display for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
        } else {  # displays if there ARE search results
            echo "<h2 class=\"mt-4 text-center\">$result->num_rows record(s) found for \"" . $_POST['search'] . '"</h2>';
            display_record_table($result);
        }
    } else {  # displays if user didn't input anything in search box
        echo "<p class=\"display-4 mt-4 text-center\">I can't search if you don't give<br>me something to search for.</p>";
        echo '<img class="mx-auto d-block mt-4" src="img/nosmile.png" alt="A face with no smile">';
    }*/
}

?>