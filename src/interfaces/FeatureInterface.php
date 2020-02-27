<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\interfaces;

/**
 * Interface FeatureInterface
 *
 * @author  Ether Creative
 * @package ether\seokit\interfaces
 */
interface FeatureInterface
{

	/**
	 * The edition required for this feature
	 *
	 * @return string
	 */
	public static function edition ();

	/**
	 * Initialize the feature during plugin init
	 *
	 * @return void
	 */
	public function init ();

	/**
	 * Return the CP nav items for this feature
	 *
	 * @return array
	 */
	public function getCpNavItem ();

	/**
	 * Register SEO permissions
	 *
	 * @return array
	 */
	public function registerPermissions ();

}
