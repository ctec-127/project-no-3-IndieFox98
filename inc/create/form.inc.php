<?php // Filename: form.inc.php ?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <!-- first name -->
    <label class="col-form-label" for="first">First Name </label>
    <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($first) ? $first: '');?>">
    <br>
    <!-- last name -->
    <label class="col-form-label" for="last">Last Name </label>
    <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($last) ? $last: '');?>">
    <br>
    <!-- student id -->
    <label class="col-form-label" for="id">Student ID </label>
    <input class="form-control" type="text" id="id" name="id" value="<?php echo (isset($id) ? $id: '');?>">
    <br>
    <!-- email -->
    <label class="col-form-label" for="email">Email </label>
    <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($email) ? $email: '');?>">
    <br>
    <!-- phone -->
    <label class="col-form-label" for="phone">Phone </label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($phone) ? $phone: '');?>">
    <br>
    <!-- gpa -->
    <label class="col-form-label" for="gpa">GPA </label>
    <input class="form-control" type="number" id="gpa" name="gpa" step=".01" value="<?php echo (isset($gpa) ? $gpa: '');?>">
    <br>
    <!-- financial aid -->
    Financial Aid?<br>
    <label class="col-form-label" for="aidy">Yes</label><input class="radio-inline ml-2 mr-4" type="radio" id="aidy" name="aid" value="1" <?php echo (isset($aid) && $aid == "1" ? 'checked': '');?>>
    <label class="col-form-label" for="aidn">No</label><input class="radio-inline ml-2 mr-4" type="radio" id="aidn" name="aid" value="0" <?php echo (isset($aid) && $aid == "0" ? 'checked': '');?>><br><br>
    <!-- degree program -->
    <label class="col-form-label" for="program">Degree Program </label>
    <select class="form-control" id="program" name="program">
        <option value=""<?php if (isset($program) && $program == "") echo ' selected="selected"'; ?>>--Please select--</option>
        <option value="engineer"<?php if (isset($program) && $program == "engineer") echo ' selected="selected"'; ?>>Engineering</option>
        <option value="liberal"<?php if (isset($program) && $program == "liberal") echo ' selected="selected"'; ?>>Liberal Arts</option>
        <option value="music"<?php if (isset($program) && $program == "music") echo ' selected="selected"'; ?>>Music Theory</option>
        <option value="psych"<?php if (isset($program) && $program == "psych") echo ' selected="selected"'; ?>>Psychology</option>
        <option value="webdev"<?php if (isset($program) && $program == "webdev") echo ' selected="selected"'; ?>>Web Development</option>
    </select><br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit">Save Record</button>
</form>