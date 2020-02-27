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
 * Class SitemapFeature
 *
 * @author  Ether Creative
 * @package ether\seokit\features
 */
class SitemapFeature implements FeatureInterface
{

	// Feature
	// =========================================================================

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

		if (!$user->can('manageSitemap'))
			return [];

		return [
			'sitemap' => [
				'label' => SEOKit::t('Sitemap'),
				'url'   => 'seo/sitemap',
			],
		];
	}

	/**
	 * @inheritDoc
	 */
	public function registerPermissions ()
	{
		return [
			'manageSitemap' => [
				'label' => SEOKit::t('Manage Sitemap'),
			],
		];
	}
}
