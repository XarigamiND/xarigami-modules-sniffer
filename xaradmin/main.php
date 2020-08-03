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
 * Add a standard screen upon entry to the module.
 *
 * @public
 * @author Richard Cave
 * @return output with censor Menu information
 */
function sniffer_admin_main()
{
    // Security Check
    if(!xarSecurityCheck('AdminSniffer')) return;

    //common admin menu
   $data['menulinks'] = xarModAPIFunc('sniffer','admin','getmenulinks');

    // Return the template variables defined in this function
    return $data;
}

?>
