<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\traits;

use ether\seokit\services\SeoService;

trait Services
{

	// Public
	// =========================================================================

	public function getSeo (): SeoService
	{
		return $this->get('seo');
	}

	// Private
	// =========================================================================

	private function _setComponents ()
	{
		$this->setComponents([
			'seo' => SeoService::class,
		]);
	}

}
