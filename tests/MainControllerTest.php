<?php
/**
 * MainController
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 25. 7. 2016
 * Time: 19:37
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace tests;

use Cafe\Gitlab\Blackfriday\Ca\MainController;
use Cafe\Gitlab\Blackfriday\Model\DomainName;

require_once dirname(__DIR__) . '/config/app.php';

require_once ROOT . DS . 'vendor/autoload.php';

class MainControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Function testInternalName
     * @return void
     */
    public function testInternalName()
    {
        $mc = new MainController(new DomainName());

        $desiredInternalName = 'MyInternalName';

        $mc->setInternalname($desiredInternalName);

        $this->assertEquals($desiredInternalName, $mc->getInternalname());
    }

    /**
     * Function TestDomainName
     */
    public function testDomainName()
    {
        $mc = new MainController(new DomainName());

        $cn = "meow";

        $mc->domainName->setCommonName($cn);

        $this->assertEquals($cn, $mc->domainName->getCommonName());
    }
}
