<?php
/**
 * Sniffer System
 *
 * @package modules
 * @copyright (C) 2002-2006 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @subpackage Xarigami Sniffer Module
 * @copyright (C) 2009-2011 2skies.com
 * @link http://xarigami.com/project/xarigami_sniffer
 */
$modversion['name']             = 'Sniffer';
$modversion['id']               = '775';
$modversion['version']          = '1.1.2';
$modversion['displayname']      = 'Sniffer';
$modversion['description']      = 'Used for browser detection';
$modversion['credits']          = 'xardocs/credits.txt';
$modversion['help']             = 'xardocs/help.txt';
$modversion['changelog']        = 'xardocs/changelog.txt';
$modversion['license']          = 'xardocs/license.txt';
$modversion['official']         = 1;
$modversion['author']           = 'Original author Frank Besler, Xarigami Team';
$modversion['contact']          = 'http://xarigami.com';
$modversion['admin']            = 1;
$modversion['user']             = 0;
$modversion['class']            = 'Utility';
$modversion['category']         = 'Utilities';
$modversion['dependencyinfo']   = array(
                                    0 => array(
                                            'name' => 'core',
                                            'version_ge' => '1.4.0'
                                         )
                                );
if (false) { //Load and translate once
    xarML('Sniffer');
    xarML('Used for browser detection');
}
?>
