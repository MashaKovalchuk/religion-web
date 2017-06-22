<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	(c) MaxSite CMS, http://max-3000.com/
	
	Слайдер owl-carousel в виде шорткода

[html][owl-carousel 1]
[js]
loop: true,
margin: 10,
autoplay: true,
[/js]

[slide]
<h3 class="bg-blue pad20 t-center">1</h3>
[/slide]

[slide]
<h3 class="bg-yellow pad20 t-center">2</h3>
[/slide]

[slide]
<h3 class="bg-red t-white pad20 t-center">3</h3>
[/slide]

[slide]
<h3 class="bg-gray800 t-white pad20 t-center">4</h3>
[/slide]
[/owl-carousel][/html]


Подключать в custom/my-template.php

if ($fn = mso_fe('components/owl-carousel/owl-carousel-shortcode.php'))
{
	require_once($fn);
	mso_shortcode_add('owl-carousel', 'owl_carousel_shortcode');
	mso_hook_add('head_css', 'owl_carousel_shortcode_css');
}

*/

function owl_carousel_shortcode($attr)
{
	$slides0 = $attr[2];
	
	if (!$slides0) return ''; // опции не определены - выходим

	// замена в тексте
	$slides0 = str_replace('TEMPLATE_URL/', getinfo('template_url'), $slides0);
	$slides0 = str_replace('SITE_URL/', getinfo('siteurl'), $slides0);
	
	// ищем вхождение [slide] ... [slide]
	$slides = mso_section_to_array($slides0, '!\[slide\](.*?)\[\/slide\]!is', array(), false, true);
	
	if (!$slides) return ''; // нет секций - выходим

	// опции слайдера свои
	$options = mso_section_to_array($slides0, '!\[options\](.*?)\[\/options\]!is', array());

	if (isset($options[0])) $options = $options[0];

	$num = trim($attr[1]);
	
	$options_def = array(
		'block_start' => '<div class="mar30-tb owl-carousel owl-theme" id="owl-carousel' . $num . '">',
		'block_end' => '</div>',
		'element' => 'owl-carousel' . $num, // id-элемент для jQuery (без точки)
	);
	
	$options = mso_merge_array($options, $options_def);

	// в секции [js] все параметры слайдера в родном js-формате 
	$js = mso_section_to_array($slides0, '!\[js\](.*?)\[\/js\]!is', array(), false, true);

	// данные в первом элементе
	$js = (isset($js[0])) ? $js[0] : '';

	$out = '';
	
	$out .= $options['block_start'];

	foreach ($slides as $slide) 
	{
		if (!$slide) continue; // не указан текст
		$out .=  trim($slide);
	}

	$out .=  $options['block_end'];

	$out .=  mso_load_script(getinfo('template_url') . 'components/owl-carousel/owl-carousel.js');

	$out .= '<script>$(document).ready(function() { $("#' . $options["element"] . '").owlCarousel({' . $js . '}); });</script>';

	return $out;

}

function owl_carousel_shortcode_css($attr)
{
	mso_add_file('components/owl-carousel/style.css');
}


mso_shortcode_add('owl-carousel', 'owl_carousel_shortcode');
mso_hook_add('head_css', 'owl_carousel_shortcode_css');
	
# end of file