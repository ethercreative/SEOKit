<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\web\twig;

use ether\seokit\web\twig\tokenparsers\SeoTokenParser;
use Twig\Extension\AbstractExtension;

/**
 * Class Extension
 *
 * @author  Ether Creative
 * @package ether\seokit\web\twig
 */
class Extension extends AbstractExtension
{

	public function getTokenParsers ()
	{
		return [
			new SeoTokenParser(),
		];
	}

}
