<?php // Filename: advanced-search.php

// Provides page title for head section in inc/layout/header.inc.php file
$pageTitle = "Advanced Search";
require_once 'inc/layout/header.inc.php';
?>

<div class="container">
	<div class="row mt-5">
		<div class="col-lg-12">
			<h1>Advanced Search</h1>
			<?php require_once __DIR__ .'/inc/search/content.inc.php' ?>
			<?php require_once __DIR__ .'/inc/shared/form.inc.php' ?>
		</div>
    </div>
</div>

<?php require_once 'inc/layout/footer.inc.php'; ?>