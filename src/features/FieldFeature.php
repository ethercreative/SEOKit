<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\features;

use ether\seokit\interfaces\FeatureInterface;
use ether\seokit\SEOKit;

/**
 * Class FieldFeature
 *
 * @author  Ether Creative
 * @package ether\seokit\features
 */
class FieldFeature implements FeatureInterface
{

	// Feature
	// =========================================================================

	/**
	 * @inheritDoc
	 * @return string
	 */
	public static function edition ()
	{
		return SEOKit::EDITION_LITE;
	}

	/**
	 * Initialize the feature during plugin init
	 *
	 * @return void
	 */
	public function init ()
	{
	}

	/**
	 * Return the CP nav items for this feature
	 *
	 * @return array
	 */
	public function getCpNavItem ()
	{
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function registerPermissions ()
	{
		return [];
	}

}
