.<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once( getinfo('common_dir') . 'category.php' ); // функции рубрик

?>
<h1><?= t('Рубрики') ?></h1>
<p class="info"><?= t('Настройка рубрик') ?></p>

<?php

# шаблон вывода информации об одной рубрике
$format = '
<div class="li" id="catli[ID]">
	<span class="id" title="' . t('ID рубрики') . '">[ID]</span>.
	<a class="edit" id="cat[[ID]][title]" title="' . t('Нажмите, чтобы перейти к редактированию') . '">[TITLE_HTML]</a>
	<span>[ ' . t('ссылка: ') . '<a href="' . getinfo('siteurl') . 'category/[SLUG_HTML]" id="cat[[ID]][page]" target="_blank" title="' . t('Смотреть рубрику на сайте') . '">[SLUG_HTML]</a> ]</span>
	<span>[ ' . t('записей: ') . '<a href="' . getinfo('site_admin_url') . 'page/category/[ID]" title="' . t('Список записей') . '" target="_blank">[COUNT]</a> ]</span>
</div>
<div class="form" id="catform[ID]">
	<p><label>' . t('Название') . '<input type="text" name="cat[[ID]][category_name]" value="[TITLE_HTML]"></label></p>
	<p><label>' . t('Описание') . '<textarea name="cat[[ID]][category_desc]">[DESCR_HTML]</textarea></label></p>
	<p class="flex">
		<label class="flex-grow3 mar20-r">' . t('Ссылка') . ' <input class="w-auto" type="text" name="cat[[ID]][category_slug]" value="[SLUG_HTML]" id="cat[[ID]][slug]"></label>
		<label class="flex-grow1 mar20-r">' . t('Родитель') . ' <input class="w-auto w100px-max" type="number" name="cat[[ID]][category_parent]" value="[ID_PARENT]"></label>
		<label class="flex-grow1">' . t('Порядок') . ' <input class="w-auto w100px-max" type="number" name="cat[[ID]][category_order]" value="[MENU_ORDER]"></label>
	</p>
	<p><button type="button" class="button do-save i-save" data-id="[ID]">' . t('Сохранить') . '</button> <button type="button" class="button do-remove i-remove" data-id="[ID]">' . t('Удалить') . '</button></p>
</div>
<div class="msg pos-fixed pos10-t pos0-r" id="cat[[ID]][msg]"></div>
';

# читаем информацию о всех рубриках сайта
$all = mso_cat_array('page', 0, 'category_menu_order', 'asc', 'category_menu_order', 'asc', false, false, false, false, false, false, false); 

#pr($all);

# формируем список-дерево с рубриками
$all_cats = mso_create_list($all,
	array(
		'childs'=>'childs',
		'format'=>$format,
		'format_current'=>$format,
		'class_ul'=>'rubrics',
		'class_li'=>'',

		'class_ul_style'=>'',
		'class_child_style'=>'',
		'class_li_style'=>'',

		'title'=>'category_name',
		'link'=>'category_slug',
		'current_id'=>true,
		'prefix'=>'category/',
		'count'=>'pages_count',
		'id'=>'category_id',
		'slug'=>'category_slug',
		'menu_order'=>'category_menu_order',
		'id_parent'=>'category_id_parent'
	));

# формируем тело страницы
echo $all_cats;

echo '
<script>
var
rubrics_ajax = "' . getinfo('ajax') . base64_encode('admin/plugins/admin_cat/do-ajax.php') . '",
current_url = "' . mso_current_url(true) . '",
cat_msg = {
	delete_confirm: "' . t('Вы действительно хотите удалить эту рубрику?') . '",
	delete_error: "' . t('Ошибка удаления!') . '",
	delete_ok: "' . t('Рубрика удалена!') . '",
	save_error: "' . t('Ошибка сохранения!') . '",
};
</script>';

echo mso_load_script(getinfo('admin_url') . 'plugins/admin_cat/script.js');

# end of file