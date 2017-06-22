<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

if ($fn = mso_fe('components/lightslider/lightslider-shortcode.php')) require_once($fn);
if ($fn = mso_fe('components/owl-carousel/owl-carousel-shortcode.php')) require_once($fn);


// Инициализация опций шаблона. 
// Для принудительной инициализации нужно раскоментировать строчку
// достаточно один раз обновить любую страницу сайта, после вновь закоментировать 
# mso_delete_option('template_set_component_options', getinfo('template'));


if (mso_get_option('template_set_component_options', getinfo('template'), false) === false)
{
	// определим выбранные компоненты
	my_set_opt('header_component1', 'top1');
	my_set_opt('header_component2', 'menu');
	my_set_opt('header_component3', '');
	my_set_opt('header_component4', '');
	my_set_opt('header_component5', '');
	
	my_set_opt('footer_component1', 'footer');
	my_set_opt('footer_component2', '');
	my_set_opt('footer_component3', '');
	my_set_opt('footer_component4', '');
	my_set_opt('footer_component5', '');

	// опция-флаг, указывающая, что компоненты были установлены 
	// и больше не требуют обновлений
	my_set_opt('template_set_component_options', true);
}

// присваивает опции (для текущего шаблона) значение
// если опция не содержит заданного значение
function my_set_opt($key, $val = '')
{
	if (mso_get_option($key, getinfo('template'), false) != $val)
		mso_add_option($key, $val, getinfo('template'));
}

# end of file