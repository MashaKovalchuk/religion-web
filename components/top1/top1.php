<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	(c) MaxSite CMS, http://max-3000.com/
*/

// название
// описание
// соцсети
$name_site = mso_get_option('name_site', 'general', '');
$description_site = mso_get_option('description_site', 'general', '');

if (!is_type('home')) $name_site = '<a href="' . getinfo('siteurl') . '">' . $name_site . '</a>';

?>

<div class="flex flex-vcenter pad20-rl pad30-tb">
	<div>
		<h1 class="mar0 t-green600 t210 hover-no-underline"><?= $name_site ?></h1>
		<h5 class="mar0 t-gray500 t90"><?= $description_site ?></h5>
	</div>
	
	<div class="t24px t-gray400 links-no-color links-hover-t-green600">
	<?php
		if ($fn = mso_fe('components/_social/_social.php')) require($fn);
	?>
	</div>
</div>
