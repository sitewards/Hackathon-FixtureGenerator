<?php
/**
 * Fixture Generator module for PHP Unit test suite for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Hackathon
 * @package    Hackathon_FixtureGenerator
 * @author     Peter Jaap Blaakmeer <https://github.com/peterjaap>
 * @author     Ivan Chepurnyi <https://github.com/IvanChepurnyi>
 * @author     Dima Janzen <https://github.com/dimajanzen>
 * @author     Rouven Alexander Rieker <https://github.com/therouv>
 * @author     Michael Ryvlin <https://github.com/mryvlin>
 * @copyright  2013 Hackathon Dev Team (http://www.magento-hackathon.de/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link       https://github.com/magento-hackathon/Hackathon-FixtureGenerator/
 */
class Hackathon_FixtureGenerator_Model_Generator_Range extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    /**
     * @var array
     */
    protected $range;

    /**
     * @var string
     */
    protected $placeholder;

    /**
     * @param $format
     */
	public function __construct($format)
	{
	    parent::__construct($format);
		
        if (preg_match('/\\{range\:(.*)[,\:](.*)[,\:](.*)\\}/', $this->format, $vars)) {
        	$from = $vars[1];
			$to = $vars[2];
			$step = $vars[3];
			$this->range = range($from, $to, $step);
            $this->placeholder = $vars[0];
		}
	}

    /**
     * @param array $data
     * @return mixed|string
     */
    public function generate(array $data)
    {
		$next = current($this->range);

		if (next($this->range) === false) {
			reset($this->range);
		}

		return str_replace($this->placeholder, $next, $this->format);
	}
}
