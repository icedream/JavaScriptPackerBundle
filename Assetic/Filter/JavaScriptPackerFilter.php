<?php
/**
 * This file is part of Icedream's JavaScriptPackerBundle for Symfony2.
 *
 * (c) 2014 Carl Kittelberger/Icedream
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Carl Kittelberger <icedream2k9@die-optimisten.net>
 * @license MIT
 * @version 1.0
 */

namespace Icedream\JavaScriptPackerBundle\Assetic\Filter;

use Assetic\Exception\FilterException;
use Assetic\Asset\AssetInterface;  
use Assetic\Filter\FilterInterface;

/**
 * This filter can compress JavaScript files using Nicolas Martin's PHP port
 * of Dean Edward's Packer.
 */
class JavaScriptPackerFilter implements FilterInterface
{
	private $_packerScriptPath;
	private $_encoding = 62;
	private $_fastDecode = true;
	private $_specialChars = false;

	public function setEncoding($encoding)
	{
		switch ($encoding)
		{
			case null:
			case false:
			case "none":
				$this->_encoding = 0;
				break;
			case "numeric":
			case "numbers":
				$this->_encoding = 10;
				break;
			case "normal":
				$this->_encoding = 62;
				break;
			case "high-ascii":
			case "highascii":
			case "high_ascii":
				$this->_encoding = 95;
				break;
			default:
				$this->_encoding = intval($encoding);
				break;
		}
	}

	public function setSpecialChars($specialChars)
	{
		$this->_specialChars = $specialChars;
	}

	public function setFastDecode($fastDecode)
	{
		$this->_fastDecode = $fastDecode;
	}

	public function __construct($packerScriptPath)
	{
		if (empty($packerScriptPath))
			throw new FilterException("Packer script path must be set.");

		$this->_packerScriptPath = $packerScriptPath;
	}

	public function filterLoad(AssetInterface $asset)
	{
		require_once($this->_packerScriptPath);
	}

	public function filterDump(AssetInterface $asset)
	{
		$script = $asset->getContent();
		
		$packer = new \JavaScriptPacker($script, $this->_encoding, $this->_fastDecode, $this->_specialChars);
		$script = $packer->pack();
		$asset->setContent(str_replace(";;", ";", trim($script) . ";"));
	}
}