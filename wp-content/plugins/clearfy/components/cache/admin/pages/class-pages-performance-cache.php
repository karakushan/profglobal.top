<?php
/**
 * The page Settings.
 *
 * @since 1.0.0
 */

// Exit if accessed directly
if( !defined('ABSPATH') ) {
	exit;
}

class WCACHE_CachePage extends WBCR\Factory_Templates_131\Pages\PageBase {

	/**
	 * @see {@inheritDoc}
	 *
	 * @var string
	 */
	public $id = "clearfy_cache";

	/**
	 * @var string
	 */
	public $page_parent_page = 'performance';

	/**
	 * @see {@inheritDoc}
	 *
	 * @var string
	 */
	public $page_menu_dashicon = 'dashicons-performance';

	/**
	 * @see {@inheritDoc}
	 *
	 * @var int
	 */
	public $page_menu_position = 20;

	/**
	 * @see {@inheritDoc}
	 *
	 * @var bool
	 */
	//public $available_for_multisite = true;

	protected $errors = [
		98 => "<label>.htaccess was not found</label> <a target='_blank' href='http://www.wpfastestcache.com/warnings/htaccess-was-not-found/'>Read More</a>",
		99 => "define('WP_CACHE', true); is needed to be added into wp-config.php",
		100 => "You have to set <strong><u><a href=" . "'/wp-admin/options-permalink.php'>permalinks</a></u></strong>",
		101 => "Fast Velocity Minify needs to be deactivated",
		102 => 'Far Future Expiration Plugin needs to be deactivated',
		103 => "SG Optimizer needs to be deactived",
		104 => "AdRotate needs to be deactived",
		105 => "MobilePress needs to be deactived",
		106 => "Speed Booster Pack needs to be deactived",
		107 => "WP Performance Score Booster needs to be deactivated<br>This plugin has aldready Gzip, Leverage Browser Caching features",
		109 => "Check and Enable GZIP compression needs to be deactivated<br>This plugin has aldready Gzip feature",
		110 => "GZippy needs to be deactivated<br>This plugin has aldready Gzip feature",
		111 => "GZip Ninja Speed Compression needs to be deactivated<br>This plugin has aldready Gzip feature",
		112 => "WordPress Gzip Compression needs to be deactivated<br>This plugin has aldready Gzip feature",
		113 => "GZIP Output needs to be deactivated<br>This plugin has aldready Gzip feature",
		114 => "Head Cleaner needs to be deactivated",
		115 => "Far Future Expiration Plugin needs to be deactivated",
	];


	/**
	 * @param WCL_Plugin $plugin
	 */
	public function __construct(WCL_Plugin $plugin)
	{
		$this->menu_title = __('Cache', 'clearfy');
		$this->page_menu_short_description = __('Cache pages', 'clearfy');

		if( $plugin->premium->is_activate() && $plugin->premium->is_install_package() ) {
			$this->available_for_multisite = true;
		}

		parent::__construct($plugin);

		$this->plugin = $plugin;
	}

	/**
	 * We register notifications for some actions
	 *
	 * @param                         $notices
	 * @param \Wbcr_Factory478_Plugin $plugin
	 *
	 * @return array
	 * @see libs\factory\pages\themplates\FactoryPages478_ImpressiveThemplate
	 */
	public function getActionNotices($notices)
	{

		$notices[] = [
			'conditions' => [
				'wclearfy-cache-cleared' => 1
			],
			'type' => 'success',
			'message' => 'Cache has been cleared!'
		];

		foreach($this->errors as $key => $error_message) {
			$notices[] = [
				'conditions' => [
					'wclearfy-cache-error' => $key
				],
				'type' => 'danger',
				'message' => $error_message
			];
		}

		return $notices;
	}

	/**
	 * Permalinks options.
	 *
	 * @return mixed[]
	 * @since 1.0.0
	 */
	public function getPageOptions()
	{
		$options = [];

		$options[] = [
			'type' => 'html',
			'html' => '<div class="wbcr-factory-page-group-header">' . __('<strong>Cache settings</strong>', 'clearfy') . '<p>' . __('A very fast caching engine for WordPress that produces static html files. You can configure caching in this section.', 'clearfy') . '</p></div>'
		];

		$options[] = [
			'type' => 'checkbox',
			'way' => 'buttons',
			'name' => 'enable_cache',
			'title' => __('Enable cache', 'clearfy'),
			'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'green'],
			'hint' => __('This option enable cache to generates static html files from your dynamic WordPress blog. After a html file is generated your webserver will serve that file instead of processing the comparatively heavier and more expensive WordPress PHP scripts.', 'clearfy'),
			'default' => false
		];

		$options[] = [
			'type' => 'checkbox',
			'way' => 'buttons',
			'name' => 'dont_cache_for_logged_in_users',
			'title' => __('Don\'t cache for logged-in users', 'clearfy'),
			'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'green'],
			'hint' => __('Don\'t show the cached version for logged-in users', 'clearfy'),
			'default' => false
		];

		$options[] = [
			'type' => 'checkbox',
			'way' => 'buttons',
			'name' => 'gzip',
			'title' => __('Gzip', 'clearfy'),
			'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'green'],
			'hint' => __('Reduce the size of page decrease the page load time a lot. You can reduce the size of page with GZIP compression feature.

If the size of requested files are big, loading takes time so in this case there is needed to reduce the size of files. Gzip Compression feature compresses the pages and resources before sending so the transfer time is reduced.', 'clearfy'),
			'default' => false
		];

		$options[] = [
			'type' => 'checkbox',
			'way' => 'buttons',
			'name' => 'browser_caching',
			'title' => __('Browser Caching', 'clearfy'),
			'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'green'],
			'hint' => __('Reduce the load times of pages by storing commonly used files from your website on your visitors browser.

A browser loads the css, js, images resources to display the web page to the visitors. This process is always performed.

If the commonly used files are cached by browser, the visitors’ browsers do not have to load them evert time so the load times of pages are reduced.', 'clearfy'),
			'default' => false
		];

		$options[] = [
			'type' => 'textarea',
			'name' => 'cache_reject_uri',
			'title' => __('Never Cache URL(s)', 'clearfy'),
			//'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
			'hint' => __('Specify URLs of pages or posts that should never be cached (one per line). The domain part of the URL will be stripped automatically.
Use (.*) wildcards to address multiple URLs under a given path.', 'clearfy'),
		];

		$options[] = [
			'type' => 'textarea',
			'name' => 'cache_reject_user_agents',
			'title' => __('Rejected User Agents', 'clearfy'),
			'default' => "facebookexternalhit\nTwitterbot\nLinkedInBot\nWhatsApp\nMediatoolkitbot",
			//'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
			'hint' => __('Strings in the HTTP ’User Agent’ header that prevent WP-Cache from caching bot, spiders, and crawlers’ requests. Note that super cached files are still sent to these agents if they already exists.', 'clearfy'),
		];

		$options[] = [
			'type' => 'textarea',
			'name' => 'cache_reject_cookies',
			'title' => __('Rejected Cookies', 'clearfy'),
			//'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
			'hint' => __('Do not cache pages when these cookies are set. Add the cookie names here, one per line. Matches on fragments, so "test" will match "WordPress_test_cookie". (Simple caching only)', 'clearfy'),
		];

		$options[] = [
			'type' => 'more-link',
			'name' => 'cache-group',
			'title' => __('Advanced options', 'clearfy'),
			'count' => 8,
			'items' => [
				[
					'type' => 'checkbox',
					'way' => 'buttons',
					'name' => 'cache_mobile',
					'title' => __('Mobile', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __("Don't show the cached version for desktop to mobile devices", 'clearfy'),
					'default' => false
				],

				[
					'type' => 'checkbox',
					'way' => 'buttons',
					'name' => 'cache_mobile_theme',
					'title' => __('Create cache for mobile theme', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('If you use a mobile theme, you should enable both “Mobile” and “Create cache for mobile theme” options. If you use a responsive theme, no need to use the mobile cache feature. You should disable “Mobile” and “Create cache for mobile theme” options.', 'clearfy'),
					'default' => false,
				],

				[
					'type' => 'checkbox',
					'way' => 'buttons',
					'name' => 'widget_cache',
					'title' => __('Widget Cache', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('You can reduce the number of sql queries with this feature.

When “Cache System” is enabled, the page is saved as a static html file, thus PHP and MySQL does not work for the page which has been cached. MySQL and PHP work to generate the html of the other pages which have not been cached yet.

Every time before the cache is created, the same widgets are generated again and again. This feature avoids generating the widgets again and again to reduce the sql queries.', 'clearfy'),
					'default' => true,
				],

				[
					'type' => 'checkbox',
					'way' => 'buttons',
					'name' => 'preload_cache',
					'title' => __('Preload cache', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('The preload feature stars to work after delete cache.

When the Preload feature calls the urls, the cache of urls are created automatically. When all the pages are cached, the preload stops working. When the cache is clear, it starts working again.

The Preload runs every 5 minutes. If you want set a specific interval. Note: The preload feature works with the WP_CRON system.', 'clearfy'),
					'default' => false
				],
				[
					'type' => 'checkbox',
					'way' => 'buttons',
					'name' => 'clear_cache_for_newpost',
					'title' => __('Clear cache for new post', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('Clear cache files when a post or page is published', 'clearfy'),
					'default' => true
				],

				[
					'type' => 'checkbox',
					'way' => 'buttons',
					'name' => 'clear_cache_for_updated_post',
					'title' => __('Clear cache for updated Post', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('Clear cache files when a post or page is updated', 'clearfy'),
					'default' => true
				],
				[
					'type' => 'textarea',
					'name' => 'exclude_files',
					'title' => __('Filenames that can be cached', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('Add here those filenames that can be cached, even if they match one of the rejected substring specified above.', 'clearfy'),
					'default' => 'wp-comments-popup.php
wp-links-opml.php
wp-locations.php
'
				],
				[
					'type' => 'textarea',
					'name' => 'exclude_pages',
					'title' => __('Rejected User Agents', 'clearfy'),
					'layout' => ['hint-type' => 'icon', 'hint-icon-color' => 'grey'],
					'hint' => __('Strings in the HTTP ’User Agent’ header that prevent WP-Cache from caching bot, spiders, and crawlers’ requests. Note that super cached files are still sent to these agents if they already exists.', 'clearfy'),
					'default' => 'bot
ia_archive
slurp
crawl
spider
Yandex
'
				]
			]
		];

		$form_options = [];
		$form_options[] = [
			'type' => 'form-group',
			'items' => $options,
			//'cssClass' => 'postbox'
		];

		return apply_filters('wclearfy_cache_form_options', $form_options, $this);
	}

	public function afterFormSave()
	{
		try {
			do_action("wclearfy/cache/settings_page/after_form_save");

			WCL_Cache_Helpers::modifyHtaccess();
		} catch( Exception $e ) {
			if( !empty($e->getCode()) && isset($this->errors[$e->getCode()]) ) {
				$this->redirectToAction('index', ['wclearfy-cache-error' => $e->getCode()]);
			}
		}
	}
}
