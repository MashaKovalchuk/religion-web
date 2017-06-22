<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	(c) MaxSite CMS, http://max-3000.com/
*/

$CI = & get_instance();	

$copy_maxsite = sprintf( tf('Работает на <a href="http://max-3000.com/">MaxSite CMS</a> | Время: {elapsed_time} | SQL: %s | Память: {memory_usage}'), $CI->db->query_count) . '<!--global_cache_footer--> | ';

if (is_login())
	$login = '<a href="' . getinfo('siteurl') . 'admin">' . tf('Управление') . '</a> | '
		. '<a href="' . getinfo('siteurl') . 'logout">' . tf('Выйти') . '</a>';
else
	$login = '<a href="' . getinfo('siteurl') . 'login">' . tf('Вход') . '</a>';

?>


<div class="hide-print bg-color5 t-gray100 mar20-t pad20 flex flex-wrap">

	<div class="w31 flex-order2 w45-tablet w100-phone links-no-color links-hover-t-gray200">
		<?php 
			if (function_exists('last_pages_unit_widget')) echo last_pages_unit_widget('footer');
		?>
	</div>

	<div class="w31 flex-order3 w45-tablet w100-phone links-no-color links-hover-t-gray200">
		<?php 
			if (function_exists('tagclouds_widget')) echo tagclouds_widget('footer');
		?>
	</div>

	<div class="w31 flex-order4 flex-order1-phone w100-tablet mar20-b">
		<div class="mar10-b mar30-b">
			<form name="f_search" class="my-footer-search" method="get" onsubmit="location.href='<?= getinfo('siteurl') ?>search/' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;">
				<input type="search" name="s" placeholder="Поиск..."><button class="i-search" type="submit"></button>
			</form>
		</div>
		
		<?php if (function_exists('ushka')) echo ushka('footer-block1', '', 'Ушка <i>footer-block1</i>'); ?>
		
		<!-- <ul class="list square mar20-l links-no-color">
			<li><a href="#" title="" rel="nofollow" target="_blank">Линк</a></li>
			<li><a href="#" title="" rel="nofollow" target="_blank">Линк</a></li>
			<li><a href="#" title="" rel="nofollow" target="_blank">Линк</a></li>
		</ul> -->
	</div>
</div>

<div class="hide-print layout-center-wrap bg-colorA5 t-white pad10-tb pad20-rl links-no-color flex flex-wrap">

	<div class="">
		&copy; <?= getinfo('name_site') . ', ' . date('Y'); ?>
	</div>
	
	<div class="t-right links-hover-t-gray200">
		<a class="" href="<?= getinfo('site_url') ?>" title="Главная страница">Главная</a>
		| <a href="<?= getinfo('site_url') ?>contact" title="Обратная связь">Контакты</a>
		| <?= $login ?>
	</div>
</div>
