<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\features;

use Craft;
use ether\seokit\interfaces\FeatureInterface;
use ether\seokit\SEOKit;

/**
 * Class RedirectFeature
 *
 * @author  Ether Creative
 * @package ether\seokit\features
 */
class RedirectFeature implements FeatureInterface
{

	/**
	 * @inheritDoc
	 * @return string
	 */
	public static function edition ()
	{
		return SEOKit::EDITION_PRO;
	}

	/**
	 * Initialize the feature during plugin init
	 *
	 * @return void
	 */
	public function init ()
	{
		// TODO: Implement init() method.
	}

	/**
	 * Return the CP nav items for this feature
	 *
	 * @return array
	 */
	public function getCpNavItem ()
	{
		$user = Craft::$app->getUser();

		if ($user->can('manageRedirects'))
			return [];

		return [
			'redirects' => [
				'label' => SEOKit::t('Redirects'),
				'url'   => 'seo/redirects',
			],
		];
	}

	/**
	 * Register SEO permissions
	 *
	 * @return array
	 */
	public function registerPermissions ()
	{
		return [
			'manageRedirects' => [
				'label' => SEOKit::t('Manage Redirects'),
			],
		];
	}
}
