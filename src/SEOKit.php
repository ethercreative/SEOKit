<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2020 Ether Creative
 */

namespace ether\seokit;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterUserPermissionsEvent;
use craft\helpers\UrlHelper;
use craft\services\UserPermissions;
use craft\web\UrlManager;
use ether\seokit\features\FieldFeature;
use ether\seokit\features\RedirectFeature;
use ether\seokit\features\SitemapFeature;
use ether\seokit\interfaces\FeatureInterface;
use ether\seokit\models\Settings;
use ether\seokit\web\twig\Extension;
use ether\seokit\traits\Services;
use yii\base\Event;

/**
 * Class SEOKit
 *
 * @author  Ether Creative
 * @package ether\seokit
 */
class SEOKit extends Plugin
{

	use Services;

	// Constants
	// =========================================================================

	const EDITION_LITE = 'lite';
	const EDITION_PRO = 'pro';

	// Properties
	// =========================================================================

	public $hasCpSettings = true;
	public $hasCpSection = true;

	/**
	 * @var FeatureInterface[]
	 */
	private $_features = [];

	// Static
	// =========================================================================

	public static function editions (): array
	{
		return [
			self::EDITION_LITE,
			self::EDITION_PRO,
		];
	}

	// Craft
	// =========================================================================

	/**
	 * Initialize the SEO Plugin
	 */
	public function init ()
	{
		parent::init();

		$this->_setComponents();

		// Events
		// ---------------------------------------------------------------------

		Event::on(
			UrlManager::class,
			UrlManager::EVENT_REGISTER_CP_URL_RULES,
			[$this, 'onRegisterCpUrlRules']
		);

		Event::on(
			UserPermissions::class,
			UserPermissions::EVENT_REGISTER_PERMISSIONS,
			[$this, 'onRegisterPermissions']
		);

		Craft::$app->getView()->registerTwigExtension(
			new Extension()
		);

		// Features
		// ---------------------------------------------------------------------

		$this->_features = [
			new FieldFeature(),
			new SitemapFeature(),
			new RedirectFeature(),
		];

		foreach ($this->_features as $i => $feature)
		{
			if ($this->is($feature::edition(), '<'))
			{
				unset($this->_features[$i]);
				continue;
			}

			$feature->init();
		}
	}

	/**
	 * Returns the CP nav item definition for this plugin’s CP section.
	 *
	 * @inheritDoc
	 * @return array
	 */
	public function getCpNavItem ()
	{
		$item = parent::getCpNavItem();
		$user = Craft::$app->getUser();
		$allowSettings = Craft::$app->getConfig()->getGeneral()->allowAdminChanges;

		$subNav = [
			'dashboard' => [
				'label' => self::t('Dashboard'),
				'url' => 'seo',
			],
		];

		foreach ($this->_features as $feature)
			$subNav += $feature->getCpNavItem();

		if ($user->getIsAdmin() && $allowSettings)
		{
			$subNav['settings'] = [
				'label' => Craft::t('app', 'Settings'),
				'url' => 'seo/settings',
			];
		}

		$item['subnav'] = $subNav;

		return $item;
	}

	// Settings
	// =========================================================================

	/**
	 * Creates and returns the model used to store the plugin’s settings.
	 *
	 * @return Settings
	 */
	protected function createSettingsModel (): Settings
	{
		return new Settings();
	}

	/**
	 * Returns the model that the plugin’s settings should be stored on, if the
	 * plugin has settings.
	 *
	 * @return Settings
	 */
	public function getSettings (): Settings
	{
		/** @noinspection PhpIncompatibleReturnTypeInspection */
		return parent::getSettings();
	}

	/**
	 * Returns the settings page response.
	 *
	 * @return void
	 */
	public function getSettingsResponse ()
	{
		Craft::$app->controller->redirect(
			UrlHelper::cpUrl('seo/settings')
		);
	}

	// Events
	// =========================================================================

	/**
	 * Register CP rules for SEO
	 *
	 * @param RegisterUrlRulesEvent $event
	 */
	public function onRegisterCpUrlRules (RegisterUrlRulesEvent $event)
	{
		$event->rules['seo/settings'] = 'seo/settings/index';
	}

	/**
	 * Register user permissions
	 *
	 * @param RegisterUserPermissionsEvent $event
	 */
	public function onRegisterPermissions (RegisterUserPermissionsEvent $event)
	{
		$perms = [];

		foreach ($this->_features as $feature)
			$perms += $feature->registerPermissions();

		$event->permissions[self::t('SEOKit')] = $perms;
	}

	// Helpers
	// =========================================================================

	/**
	 * Translates a message to the specified language.
	 *
	 * This is a shortcut method of [[\yii\Yii::t()]].
	 *
	 * The translation will be conducted according to the message category and
	 * the target language will be used.
	 *
	 * You can add parameters to a translation message that will be substituted
	 * with the corresponding value after translation. The format for this is
	 * to use curly brackets around the parameter name as you can see in the
	 * following example:
	 *
	 * ```php
	 * $username = 'Alexander';
	 * echo \SEOKit::t('Hello, {username}!', ['username' => $username]);
	 * ```
	 *
	 * Further formatting of message parameters is supported using the
	 * [PHP intl extensions](https://secure.php.net/manual/en/intro.intl.php)
	 * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
	 *
	 * @param string $message The message to be translated.
	 * @param array $params The parameters that will be used to replace the
	 *                      corresponding placeholders in the message.
	 *
	 * @return string The translated message.
	 */
	public static function t ($message, $params = [])
	{
		return Craft::t('seokit', $message, $params);
	}

}
