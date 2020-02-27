<?php
/**
 * SEOKit for Craft CMS
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2019 Ether Creative
 */

namespace ether\seokit\web\twig\nodes;

use ether\seokit\SEOKit;
use Twig\Compiler;
use Twig\Node\Expression\ArrayExpression;
use Twig\Node\Node;
use Twig\Node\NodeCaptureInterface;

/**
 * Class SeoNode
 *
 * @author  Ether Creative
 * @package ether\seokit\web\twig\nodes
 */
class SeoNode extends Node implements NodeCaptureInterface
{

	public function compile (Compiler $compiler)
	{
		/** @var ArrayExpression $data */
		$handle = $this->getAttribute('handle');
		$data = $this->getAttribute('data');
		$value = $this->getNode('value');

		$compiler
			->addDebugInfo($this)
			->write('$originalSeoValue = @$context[\'seo\'];' . PHP_EOL)
			->write(Seo::class . '::getInstance()->getSeo()->getSeoVariable($context, \'' . $handle . '\');' . PHP_EOL)
			->write('ob_start();' . PHP_EOL)
			->subcompile($value)
			->write(Seo::class . '::getInstance()->getSeo()->output(!$this->doGetParent($context), $context, ')
			->raw($data->compile($compiler) . ', ')
			->raw('ob_get_clean());' . PHP_EOL)
			->write('$context[\'seo\'] = $originalSeoValue;' . PHP_EOL);
	}

}
