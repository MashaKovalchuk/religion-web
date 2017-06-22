<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 *
 * HTML-структура шаблона
 *
 */

if ($fn = mso_fe('main/blocks/_start.php')) require($fn);
 
if ($fn = mso_fe('main/blocks/body-start.php')) require($fn) ?>

<div class="my-all-container layout-center-wrap mar20-tb"><div class="wrap my-shadow1 rounded5 bg-gray100">

	<div class="header clearfix">
		<?php if ($fn = mso_fe('main/blocks/header.php')) require($fn) ?>
	</div>

	<?php if ($fn = mso_fe('main/blocks/header-out.php')) require($fn) ?>

	<div class="main">

		<?php if ($fn = mso_fe('main/blocks/main-start.php')) require($fn) ?>

		<div class="content pad20">
			<?php if ($fn = mso_fe('main/blocks/content.php')) require($fn) ?>
		</div>

		<?php if ($fn = mso_fe('main/blocks/main-end.php')) require($fn) ?>

	</div>

	<?php if ($fn = mso_fe('main/blocks/footer-pre.php')) require($fn) ?>

	<div class="footer">
		<?php if ($fn = mso_fe('main/blocks/footer.php')) require($fn) ?>
	</div>

</div></div>

<?php if ($fn = mso_fe('main/blocks/body-end.php')) require($fn) ?>

</body></html><?php if ($fn = mso_fe('main/blocks/_end.php')) require($fn) ?>