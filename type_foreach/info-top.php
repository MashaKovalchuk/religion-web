<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$p->format('edit', '<i class="i-edit t-gray600 hover-t-black" title="Edit page"></i>', '<div class="b-right mar10-t">', '</div>');

$p->format('title', '<h1 class="mar10-t t-gray700 bor-double-b bor3 bor-gray300 pad5-b">', '</h1>', !is_type('page'));

$p->format('cat', ' / ', '<span class="b-right b-inline i-folder-o" title="' . tf('Рубрика записи') . '">', '</span>');

/*
$_pd = strtotime($p->page['page_date_publish']); // дта публикации
$_pi = (time() - $_pd) / (60*60*24); // интервал в днях с сейчас
$_d = round(($p->page['page_view_count'] / $_pi) * 30); // просмотров в месяц

$p->format('view_count', '<span class="i-eye mar25-l">' . tf('Просмотров') . ': ', ' (<i title="Просмотров в месяц">' . $_d  . '</i>)</span>');
*/

$p->format('date', 'j F Y г.', '<time datetime="[page_date_publish_iso]" class="i-calendar">', '</time>');

/*
$p->format('tag', '<i class="i-tag mar10-l"></i>', '<br><span class="i-tags links-no-color" title="' . tf('Метка записи') . '">', '</span>');
*/

$p->format('comments_count', '<span class="i-commenting-o mar15-l">' . tf('Комментарии') . ': ', '</span>');

if (
	$thumb = thumb_generate(
		$p->meta_val('image_for_page'), // адрес
		675, //ширина
		300 //высота
	))
{
	$p->thumb = '<img src="' . $thumb . '" class="center clearfix" style="" alt="' . htmlspecialchars($p->val('page_title')). '">';
}

$p->line('[thumb]');

$p->html('<header class="mar20-rl mar10-b">');

	$p->line('[edit][title]');
	
	$p->div_start('info info-top t-gray600 t90');
		$p->line('[date][comments_count][cat]');
	$p->div_end('info info-top');

$p->html('</header>');

# end of file