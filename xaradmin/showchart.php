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
/**
 * Utility function to show a pie chart
 *
 * Based on work by:
 * 2D Pie Chart Version 1.0
 * Programer: Xiao Bin Zhao
 * E-mail: love1001_98@yahoo.com
 * Date: 03/31/2001
 * All Rights Reserved 2001.
 *
 * @public
 * @author Richard Cave
 * @param string type
 * @return array of items, or false on failure
 * @throws FORBIDDEN_OPERATION
 */
function sniffer_admin_showchart()
{
    // Check that the GD library is available
    if (!extension_loaded('gd')) {
        $msg = xarML('The GD graphics library is required to chart.');
        xarErrorSet(XAR_USER_EXCEPTION, 'FORBIDDEN_OPERATION',
                       new SystemException($msg));
        return;
    }
    //common admin menu
   $data['menulinks'] = xarModAPIFunc('sniffer','admin','getmenulinks');
    // Get parameters from the input
    if (!xarVarFetch('snifftype', 'str:1:', $type, 'osnam')) return;

    switch($type) {
        case 'osnam':
            $title = "OS Name";
            break;
        case 'osver':
            $title = "OS Version";
            break;
        case 'agnam':
            $title = "Browser Name";
            break;
        default:
            $title = 'Sniffer Results';
            break;
    }

    xarModAPIFunc('sniffer',
                  'admin',
                  'drawchart',
                  array('type' => $type,
                        'title' => $title,
                        'menulinks'=>    $data['menulinks']));

    // Don't return to the template!!!
    exit();
}

?>
