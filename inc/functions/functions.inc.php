<?php // Filename: functions.inc.php

// function to display message via GET request
function display_message(){
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo '<div class="mt-4 alert alert-success" role="alert">';
        echo $message;
        echo '</div>';
    }
}

// function to create links for filtering records by last name
function display_letter_filters($filter){  
    echo '<span class="d-inline-block mr-3">Filter by <strong>Last Name</strong></span>';
 
    $letters = range('A','Z');

    for($i=0 ; $i < count($letters) ; $i++){ 
        if ($filter == $letters[$i]) {
            $class = 'class="d-inline-block text-light font-weight-bold p-1 mr-3 bg-dark"';
        } else {
            $class = 'class="d-inline-block text-secondary p-1 mr-3 bg-light border rounded"';
        }
        echo "<u><a $class href='?filter=$letters[$i]' title='$letters[$i]'>$letters[$i]</a></u>";
    }
    echo '<a class="text-secondary p-2 mr-2 bg-success text-light border rounded" href="?clearfilter" title="Reset Filter">Reset</a>&nbsp;&nbsp;';
}

// function to show the data table
function display_record_table($result){
    echo '<div class="table-responsive">';
    echo "<table class=\"table table-striped table-hover table-sm mt-3\">";
    echo '<thead class="thead-dark"><tr><th>Actions</th><th><a href="?sortby=student_id">Student ID</a></th><th><a href="?sortby=first_name">First Name</a></th><th><a href="?sortby=last_name">Last Name</a></th><th><a href="?sortby=email">Email</a></th><th><a href="?sortby=phone">Phone</a></th><th><a href="?sortby=degree_program">Program</a></th><th><a href="?sortby=gpa">GPA</a></th><th><a href="?sortby=financial_aid">Financial Aid?</a></th><th><a href="?sortby=graduation_date">Graduation Date</a></th></tr></thead>';
    # $row will be an associative array containing one row of data at a time
    while ($row = $result->fetch_assoc()){
        # display rows and columns of data
        echo '<tr>';
        echo "<td><a href=\"update-record.php?id={$row['id']}\">Update</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"delete-record.php?id={$row['id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        echo "<td>{$row['student_id']}</td>";
        echo "<td><strong>{$row['first_name']}</strong></td>";
        echo "<td><strong>{$row['last_name']}</strong></td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['degree_program']}</td>";
        echo "<td>{$row['gpa']}</td>";
        echo "<td>{$row['financial_aid']}</td>";
        echo "<td>{$row['graduation_date']}</td>";
        echo '</tr>';
    } // end while
    // closing table tag and div
    echo '</table>';
    echo '</div>';
}

// function to display errors during record creation in case of empty fields
function display_error_bucket($error_bucket){
    echo '<p>The following errors were detected:</p>';
    echo '<div class="pt-4 alert alert-warning" role="alert">';
        echo '<ul>';
        foreach ($error_bucket as $text){
            echo '<li>' . $text . '</li>';
        }
        echo '</ul>';
    echo '</div>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
}

// gives user hints about which fields are empty after POST
function echoIfRequired($field_name) {
    // don't do it on advanced search page
    $current_file_name = check_basename();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $current_file_name != 'advanced-search') {
        if ($field_name == 'gpa') {
            if (empty($_POST['gpa']) && $_POST['gpa'] != "0") {
                echo '(please fill in)';
            }
        } elseif ($field_name == 'aid') {
            if (!isset($_POST['aid']) || empty($_POST['aid']) && $_POST['aid'] != "0") {
                echo '(please fill in)';
            }
        } else {
            if (empty($_POST[$field_name])) {
                echo '(please fill in)';
            }
        }
    }
}

// function to highlight currently displayed page in navbar
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = check_basename();

    if ($current_file_name == $requestUri)
        echo 'active';
}

// function to change submit button text in form.inc.php depending on request uri
function display_button_text() {
    $current_file_name = check_basename();

    if ($current_file_name == "advanced-search") {
        echo 'Search';
    } else {
        echo 'Save Record';
    }
}

// function to check basename of the uri
function check_basename() {
    if ($_SERVER['QUERY_STRING']) {
        $filename = basename($_SERVER['REQUEST_URI'], ".php?" . $_SERVER['QUERY_STRING']);
    } else {
        $filename = basename($_SERVER['REQUEST_URI'], ".php");
    }

    return $filename;
}
?>