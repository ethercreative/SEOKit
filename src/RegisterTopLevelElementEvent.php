<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2020 Ether Creative
 */

namespace ether\seokit\events;

use yii\base\Event;

/**
 * Class RegisterTopLevelElementEvent
 *
 * @author  Ether Creative
 * @package ether\seokit\events
 */
class RegisterTopLevelElementEvent extends Event
{

	/** @var array - An array of possible top level element handles */
	public $handles;

}
