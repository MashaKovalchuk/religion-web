<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

# секретная фраза - она будет использоваться при генерации ключей
$MSO->config['secret_key'] = 'e:m69p2JHL4,BNo';

# можно указать свой ключ для удаленного постинга
# $MSO->config['remote_key'] = '0';

# можно указать язык сайта
//$MSO->language = 'en'; // english
//$MSO->language = 'ua'; // украинский
//$MSO->language = 'de'; // deutsch
//$MSO->language = 'ro'; // română

# можно изменить время жизни кэша (в секундах)
# $MSO->config['cache_time'] = 9600;


# подключаем нужные плагины, настройки и т.д.
function mso_autoload_custom()
{

}

# аналогичная функция только для админки
function mso_autoload_admin_custom()
{

}

# end file