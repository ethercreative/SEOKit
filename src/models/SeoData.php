<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\models;

use craft\base\Model;

/**
 * Class SeoData
 *
 * @author  Ether Creative
 * @package ether\seo\models
 */
class SeoData extends Model
{

	// Properties
	// =========================================================================

	private $_data = [
		'title' => '',
		'description' => '',
		'image' => null,

		'facebook' => [
			'title' => '',
			'description' => '',
			'image' => null,
		],

		'twitter' => [
			'title' => '',
			'description' => '',
			'image' => null,
		],

		'robots' => [],
		'canonical' => '',
	];

	private $_dataOverrides = [];
	private $_markupOverrides = [];

	// Methods
	// =========================================================================

	// Overrides
	// -------------------------------------------------------------------------

	/**
	 * Store the data overrides
	 *
	 * @param array $data
	 */
	public function overrideData ($data)
	{
		$this->_dataOverrides[] = $data;
	}

	/**
	 * Store the markup overrides
	 *
	 * @param string $markup
	 */
	public function overrideMarkup ($markup)
	{
		$this->_markupOverrides[] = $markup;
	}

	/**
	 * Merge the data overrides into this SEO data
	 */
	public function mergeDataOverrides ()
	{
		if (empty($this->_dataOverrides))
			return;

		$data = array_reverse($this->_dataOverrides);
		$data = call_user_func_array('array_merge', $data);

		// TODO: Handle nested array (i.e. for social)

		foreach ($data as $key => $value)
			if (array_key_exists($key, $this->_data))
				$this->_data[$key] = $value;
	}

	/**
	 * Get the markup overrides
	 *
	 * @return array
	 */
	public function getMarkupOverrides ()
	{
		return array_reverse($this->_markupOverrides);
	}

	// Getters
	// -------------------------------------------------------------------------

	/**
	 * Get the SEO Title
	 *
	 * @return string
	 */
	public function getTitle ()
	{
		// TODO: Render title from field
		return $this->_data['title'];
	}

	/**
	 * Get the SEO Description
	 *
	 * @return string
	 */
	public function getDescription ()
	{
		// TODO: Render description from field
		return $this->_data['description'];
	}

	// TODO: Get social
	// TODO: Allow images to pull from field

}
