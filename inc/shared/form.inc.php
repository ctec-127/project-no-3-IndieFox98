<?php // Filename: form.inc.php ?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <!-- first name -->
    <label class="col-form-label" for="first">First Name <?=echoIfRequired('first')?></label>
    <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($first) ? $first: '');?>">
    <br>
    <!-- last name -->
    <label class="col-form-label" for="last">Last Name <?=echoIfRequired('last')?></label>
    <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($last) ? $last: '');?>">
    <br>
    <!-- student id -->
    <label class="col-form-label" for="sid">Student ID <?=echoIfRequired('sid')?></label>
    <input class="form-control" type="text" id="sid" name="sid" value="<?php echo (isset($sid) ? $sid: '');?>">
    <br>
    <!-- email -->
    <label class="col-form-label" for="email">Email <?=echoIfRequired('email')?></label>
    <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($email) ? $email: '');?>">
    <br>
    <!-- phone -->
    <label class="col-form-label" for="phone">Phone <?=echoIfRequired('phone')?></label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($phone) ? $phone: '');?>">
    <br>
    <!-- gpa -->
    <label class="col-form-label" for="gpa">GPA <?=echoIfRequired('gpa')?></label>
    <input class="form-control" type="number" id="gpa" name="gpa" step=".01" value="<?php echo (isset($gpa) ? $gpa: '');?>">
    <br>
    <!-- degree program -->
    <label class="col-form-label" for="program">Degree Program <?=echoIfRequired('program')?></label>
    <select class="form-control" id="program" name="program">
        <option value=""<?php if (isset($program) && $program == "") echo ' selected="selected"'; ?>>--Please select--</option>
        <option value="engineer"<?php if (isset($program) && $program == "engineer") echo ' selected="selected"'; ?>>Engineering</option>
        <option value="liberal"<?php if (isset($program) && $program == "liberal") echo ' selected="selected"'; ?>>Liberal Arts</option>
        <option value="music"<?php if (isset($program) && $program == "music") echo ' selected="selected"'; ?>>Music Theory</option>
        <option value="psych"<?php if (isset($program) && $program == "psych") echo ' selected="selected"'; ?>>Psychology</option>
        <option value="webdev"<?php if (isset($program) && $program == "webdev") echo ' selected="selected"'; ?>>Web Development</option>
    </select><br>
    <!-- graduation date -->
    <label class="col-form-label" for="gday">Graduation Date <?=echoIfRequired('gday')?></label>
    <input class="form-control" type="date" id="gday" name="gday" value="<?php echo (isset($gday) ? $gday: '');?>">
    <br>
    <!-- financial aid -->
    Financial Aid? <?=echoIfRequired('aid')?><br>
    <label class="col-form-label" for="aidy">Yes</label><input class="radio-inline ml-2 mr-4" type="radio" id="aidy" name="aid" value="1" <?php echo (isset($aid) && $aid == "1" ? 'checked': '');?>>
    <label class="col-form-label" for="aidn">No</label><input class="radio-inline ml-2 mr-4" type="radio" id="aidn" name="aid" value="0" <?php echo (isset($aid) && $aid == "0" ? 'checked': '');?>><br><br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?=display_button_text();?></button>
    <!-- hidden id field for update functionality -->
    <input type="hidden" name="id" value="<?php echo (isset($id) ? $id : '');?>">
</form>