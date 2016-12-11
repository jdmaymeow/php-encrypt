<?php
/**
 * JsonHelper
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 22. 7. 2016
 * Time: 14:51
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Cafe\Gitlab\Blackfriday\Utils;

class JsonHelper
{
    /**
     * @param null $fileName Name of file
     * @return mixed
     */
    public function decode($fileName = null)
    {
        $configfile = file_get_contents(CONFIG . $fileName . '.json');

        return json_decode($configfile);
    }
}
