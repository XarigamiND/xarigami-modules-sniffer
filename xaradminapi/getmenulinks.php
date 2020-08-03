<?php
/**
 * Sniffer System
 *
 * @package modules
 * @copyright (C) 2002-2006 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @subpackage Xarigami Sniffer Module
 * @copyright (C) 2009 2skies.com
 * @link http://xarigami.com/project/xarigami_sniffer
 * @author Frank Besler using phpSniffer by Roger Raymond
 */
/**
 * Utility function pass individual menu items to the main menu
 *
 * @public
 * @author Richard Cave
 * @return array containing the menulinks for the main menu items.
 */
function sniffer_adminapi_getmenulinks()
{

    if (xarSecurityCheck('AdminSniffer')) {
        $menulinks[] = Array('url'   => xarModURL('sniffer','admin','view'),
                              'title' => xarML('View browser and OS of visitors.'),
                              'label' => xarML('View Sniffs'),
                              'active'=> array('view')
                              );

        // Check that the GD library is available
        if (extension_loaded('gd')) {
            $menulinks[] = Array('url'   => xarModURL('sniffer','admin','chart'),
                                 'title' => xarML('Chart browser and OS of visitors.'),
                                 'label' => xarML('Chart Sniffs'),
                                 'active'=> array('chart'),
                                 );
        }
    }

    if (empty($menulinks)){
        $menulinks = '';
    }

    return $menulinks;
}
?>
