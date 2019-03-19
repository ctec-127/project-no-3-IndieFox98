<?php // Filename: search-records.php

// Provides page title for head section in inc/layout/header.inc.php file
$pageTitle = "Search Records";
require_once 'inc/layout/header.inc.php';

// include file to connect to database
require_once 'inc/db/mysqli_connect.inc.php';

// require_once 'inc/functions/functions.inc.php';
require_once 'inc/app/config.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-4">
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if(!empty($_POST['search'])){
                    $sql = "SELECT * FROM $db_table WHERE " . '"' . $_POST["search"] . '"' . " IN (student_id, first_name, last_name, email, phone, degree_program) ORDER BY last_name ASC";
                    // $sql = "SELECT * FROM student WHERE student_id LIKE '%val%' or field2 LIKE '%val%'
                    $result = $db->query($sql);

                    if ($result->num_rows == 0) {  # displays if there ARE NO search results
                        echo "<p class=\"display-4 mt-4 text-center\">No results found for \"<strong>{$_POST['search']}</strong>\"</p>";
                        echo '<img class="mx-auto d-block mt-4" src="img/frown.png" alt="A sad face">';
                        echo "<p class=\"display-4 mt-4 text-center\">Please try again.</p>";
                        // echo "<h2 class=\"mt-4\">There are currently no records to display for <strong>last names</strong> starting with <strong>$filter</strong></h2>";
                    } else {  # displays if there ARE search results
                        echo "<h2 class=\"mt-4 text-center\">$result->num_rows record(s) found for \"" . $_POST['search'] . '"</h2>';
                        echo "<div class=\"small\">";
                        display_record_table($result);
                        echo "</div>";
                    }
                } else {  # displays if user didn't input anything in search box
                    echo "<p class=\"display-4 mt-4 text-center\">I can't search if you don't give<br>me something to search for.</p>";
                    echo '<img class="mx-auto d-block mt-4" src="img/nosmile.png" alt="A face with no smile">';
                }
            }
        ?>
        </div>
    </div>
</div>

<?php require_once 'inc/layout/footer.inc.php';?>