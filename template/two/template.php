<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	# поскольку в хуках могут быть простой вывод данных через echo, следует 
	# включить буферизацию вывода на каждый хук
	
	// в теле контента можно определить хуки на остальные части 
	ob_start();
		$admin_content_hook = mso_hook('mso_admin_content', mso_admin_content());
		$admin_content = ob_get_contents() . $admin_content_hook;
	ob_end_clean();
	
	ob_start();
		$admin_header_hook = mso_hook('mso_admin_header', mso_admin_header());
		$admin_header = ob_get_contents() . $admin_header_hook;
	ob_end_clean();
	
	ob_start();
		$admin_menu_hook = mso_hook('mso_admin_menu', mso_admin_menu());
		$admin_menu = ob_get_contents() . $admin_menu_hook;
	ob_end_clean();
	
	ob_start();
		$admin_footer_hook = mso_hook('mso_admin_footer', mso_admin_footer());
		$admin_footer = ob_get_contents() . $admin_footer_hook;
	ob_end_clean();
	
	if (!$admin_header) $admin_header = t('Админ-панель');
	
	$admin_css = getinfo('admin_url') . 'template/' . mso_get_option('admin_template', 'general', 'default') . '/style.css';
	$admin_css = mso_hook('admin_css', $admin_css);
	
	$admin_css_profile = ''; // дополнительные css-файлы
	
	if ($admin_css_profile_s = mso_get_option('admin_template_profile', 'general', '')) 
	{
			$admin_css_profile_s = mso_explode($admin_css_profile_s, false);
			
			foreach ($admin_css_profile_s as $css)
			{
				$admin_css_profile .= '<link rel="stylesheet" href="' . getinfo('admin_url') . 'template/' . mso_get_option('admin_template', 'general', 'default') . '/profiles/' . $css . '">';
			}
	}
	
	$admin_title = t('Админ-панель') . ' - ' . mso_hook('admin_title', mso_head_meta('title'));
	
	$admin_adds_url = getinfo('admin_url') . 'template/' . mso_get_option('admin_template', 'general', 'default') . '/';
	
	$add_body_class = '';
	if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') ) $add_body_class = ' firefox';
	elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') ) $add_body_class = ' chrome';
	elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') ) $add_body_class = ' safari';
	//elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') ) $add_body_class = ' opera';
	elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0') ) $add_body_class = ' ie9';
	
?><!DOCTYPE HTML>
<html><head>
<meta charset="UTF-8">
<title><?= $admin_title ?></title>
<link rel="shortcut icon" href="<?= getinfo('template_url') . 'images/favicons/' . mso_get_option('default_favicon', 'templates', 'favicon1.png') ?>" type="image/x-icon">
<link rel="stylesheet" href="<?= $admin_css ?>">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300&subset=latin-ext,cyrillic-ext' rel='stylesheet' type='text/css'>
<?= $admin_css_profile ?>
<?= mso_load_jquery() ?>
<script type="text/javascript" src="<?= $admin_adds_url ?>jquery.cookie.js"></script>
<script type="text/javascript" src="<?= $admin_adds_url ?>jquery.autocomplete.js"></script>
<script>
$(document).ready(function() {
	
	// сворачивание правых блоков в таблице редактирования
	if($('table.new_or_edit').length)
	{
		$('td.page_info div.block_page').each(function( index )
		{
			// обернем контент этих блоков в div для сворачивания
			$(this).children('*:not(h3)').wrapAll('<div class="collapsable"></div>');
			// добавим h3 пару свойств
			$('>h3',this).addClass('collapse-trigger').attr('title','свернуть / развернуть блок');
			// свернем нужные
			var coo = $.cookie( 'block_page' + $(this).index() );
			if(coo == '1')
			{
				$('.collapsable',this).hide();
			}
			// добавим блоку «метку» — имя его куки
			$(this).attr('data-cookie-name','block_page' + $(this).index());
		});
		
		// определим событие клика по заголовку
		$('td.page_info div.block_page>h3').on('click', function(event){
			if( $(this).next('div.collapsable').is(':visible') )
			{
				$(this).next('div.collapsable').slideUp(100);
				$.cookie( $(this).parent().attr('data-cookie-name') , '1' );
			}
			else
			{
				$(this).next('div.collapsable').slideDown(100);
				$.cookie( $(this).parent().attr('data-cookie-name') , '0' );
			}
		});
	}
	
	// автодополнение
	var tags = $('#f_all_tags_all span');
	var tags_n = $('#f_all_tags_all span').children('a').length;
	if (tags_n) {
		var $tag_arr = new Array();
		for (var i = 0; i < tags_n; i++) { // тупо, циклом :)
			$tag_arr.push( $(tags).children('a:eq(' + i + ')').text() );
		}
		$("#f_tags").autocomplete($tag_arr, {
			max: 10,
			matchContains: true,
			multiple: true,
			scrollHeight: 300
		});
	}
	
});
</script>
<?php mso_hook('admin_head') ?>
</head>
<body class="<?php if (mso_segment(2)) echo 'sect_'.mso_segment(2);if (mso_segment(3)) echo ' subsect_'.mso_segment(3); echo $add_body_class; ?>">
<div id="container">
	<div class="admin-header"><div class="r">
		<h1><a href="<?= getinfo('siteurl') ?>"><?= mso_get_option('name_site', 'general') ?></a></h1>
		<?= $admin_header ?>
	</div></div><!-- div class=admin-header -->
	
	<div id="mc">
		<div class="admin-menu"><div class="r">
		<?= $admin_menu ?>
		</div></div><!-- div class=admin-menu -->
		
		<div class="admin-content"><div class="r">
		<?= $admin_content ?>
		</div></div><!-- div class=admin-content -->
	</div><!-- div id="#mc" -->

	<div class="admin-footer"><div class="r">
		<?= $admin_footer ?>
		<p>Автор темы оформления — М.А.Ковальчук.</p>
	</div></div><!-- div class=admin-footer -->

</div><!-- div id="#container" -->

</body>
</html>