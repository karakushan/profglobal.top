<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('WP_HOME','https://profglobal.top' );
define('WP_SITEURL','https://profglobal.top' ); 

define('WP_ALLOW_REPAIR', true); 
// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', "admin_profglobal");

/** Имя пользователя MySQL */
define('DB_USER', "admin_profglobal");

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', "BTwKCzNeE9");

/** Имя сервера MySQL */
define('DB_HOST', "localhost");

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'eD{Zf>{dL5+PzvG7*fmnFrlL%9_=ma*6bY;{VL83PneS(`73T<i|`-6(0%yAT Vn');
define('SECURE_AUTH_KEY',  '|l*Bg5{Y<t.T$9Yq->A/x%MpI3!v$~=y.Z1B](TSspBwP4tYu5J]rKp>m?3zBo+&');
define('LOGGED_IN_KEY',    '@:-b#m6u;S0z4v$1}cjq!&^3?@],,yIQXf[~_S+,lDq91CPcCxiv03cVry-#71?j');
define('NONCE_KEY',        ']KLc/fKyifFxOz4gV}NRa3g(-qC~>*F xu,q=~0{drK_uFS|zSPm-0lDa]4W{A&[');
define('AUTH_SALT',        '+IYLDzCO!VQtMs&h+{Ni`.],T(By!F9(xzcN1*Huv%I{D6;=7o_U^/mUc&UZi))P');
define('SECURE_AUTH_SALT', 'e+`u1cJhgqXQCO<H9iSz=E%-9a[(9ON!1a{jI_;vseITyrx_p9s@cSU.$s2N[(eY');
define('LOGGED_IN_SALT',   'tm3WSd8?v8Gk#:s}D|86eymb+E&-=bGjSl%^BFO}!6#F4A 7#W@mgHprf2_ v !z');
define('NONCE_SALT',       'xt[/J5wZWg2(LRs%+V;V=&F;@zWJq,H$ow,)lexV8nXkKkz#V)o^?{sK$6Xg0Zo?');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wxcwg_';

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
define('WP_DEBUG', true);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
