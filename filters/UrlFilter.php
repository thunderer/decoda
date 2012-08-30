<?php
/**
 * @author      Miles Johnson - http://milesj.me
 * @copyright   Copyright 2006-2012, Miles Johnson, Inc.
 * @license     http://opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link        http://milesj.me/code/php/decoda
 */

namespace mjohnson\decoda\filters;

use mjohnson\decoda\filters\FilterAbstract;

/**
 * Provides tags for URLs.
 *
 * @package	mjohnson.decoda.filters
 */
class UrlFilter extends FilterAbstract {

	/**
	 * Regex pattern.
	 */
	const URL_PATTERN = '/^((?:http|ftp|irc|file|telnet)s?:\/\/)(.*?)$/is';

	/**
	 * Supported tags.
	 *
	 * @access protected
	 * @var array
	 */
	protected $_tags = array(
		'url' => array(
			'tag' => 'a',
			'displayType' => self::TYPE_INLINE,
			'allowedTypes' => self::TYPE_INLINE,
			'contentPattern' => self::URL_PATTERN,
			'testNoDefault' => true,
			'attributes' => array(
				'default' => self::URL_PATTERN
			),
			'mapAttributes' => array(
				'default' => 'href'
			)
		),
		'link' => array(
			'tag' => 'a',
			'displayType' => self::TYPE_INLINE,
			'allowedTypes' => self::TYPE_INLINE,
			'contentPattern' => self::URL_PATTERN,
			'testNoDefault' => true,
			'attributes' => array(
				'default' => self::URL_PATTERN
			),
			'mapAttributes' => array(
				'default' => 'href'
			)
		)
	);

	/**
	 * Using shorthand variation if enabled.
	 *
	 * @access public
	 * @param array $tag
	 * @param string $content
	 * @return string
	 */
	public function parse(array $tag, $content) {
		if (empty($tag['attributes']['href']) && empty($tag['attributes']['default'])) {
			$tag['attributes']['href'] = $content;
		}

		if ($this->getParser()->config('shorthand')) {
			$tag['content'] = $this->message('link');

			return '[' . parent::parse($tag, $content) . ']';
		}

		return parent::parse($tag, $content);
	}

}