<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	info-top файл
	вывод только заголовка записи
*/

$p->format('title', '<h1 class="mar10-t t-gray700 bor-double-b bor3 bor-gray300 pad5-b">', '</h1>', false);

$p->format('edit', '<i class="i-edit t-gray600 hover-t-black" title="Edit page"></i>', '<div class="b-right mar10-t">', '</div>');



$p->html(NR . '<header class="mar20-rl mar10-b">');
	$p->line('[edit][title]');
$p->html('</header>');

# end file