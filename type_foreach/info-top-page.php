<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	info-top файл
	предыдущая - следующая запись
	вывод рубрик перед заголовком записи
*/

$np_out = '';
/*
if (is_type('page') and $p->val('page_type_name') == 'blog')
{
	$np = mso_next_prev_page(
				array(
					'page_id' => $p->val('page_id'),
					'page_categories' => $p->val('page_categories'),
					'page_date_publish' => $p->val('page_date_publish'),
					'use_category' => false, // не учитывать рубрики 
					// 'reverse' => true, // поменять местами пункты
				));
	
	if ($np['next'])
	{
		$np_out .= '<div class="b-left mar20-r mar20-t"><i class="i-long-arrow-left"></i> ' . $p->link( mso_page_url($np['next']['page_slug']), $np['next']['page_title'] ) . '</div>';
	}

	if ($np['prev'])
	{
		$np_out .= '<div class="b-right  mar20-t">' . $p->link( mso_page_url($np['prev']['page_slug']), $np['prev']['page_title'] ) . ' <i class="i-long-arrow-right"></i></div>';
	}
	
	$p->block($np_out, '<div class="next-prev-page clearfix t90 pad20-rl pad20-b">', '</div>');
}

*/

$p->format('edit', '<i class="i-edit t-gray600 hover-t-black" title="Edit page"></i>', '<div class="b-right mar10-t">', '</div>');
$p->format('title', '<h1 class="t-gray700 bor-double-b bor3 bor-gray300 pad5-b mar20-t">', '</h1>', !is_type('page'));

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

$p->html('<header class="mar20-rl mar20-b">');

	$p->line('[edit][title]');
	
	$p->div_start('info info-top t-gray600 t90');
		$p->line('[date][comments_count][cat]');
	$p->div_end('info info-top');
	
	/*
	if ($page['page_status'] == 'publish')
	{
		$p->html(' <div class="social-likes mar20-t"><div class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</div> <div class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</div><div class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</div><div class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</div> </div>');
	}
	*/
$p->html('</header>');


# end of file