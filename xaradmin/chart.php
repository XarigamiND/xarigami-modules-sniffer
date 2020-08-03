<?php
/**
 * Sniffer System - find out the browser and OS of the visitor
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
 * @author Richard Cave
 * @param void
 * @return array of items, or false on failure
 * @throws BAD_PARAM, DATABASE_ERROR, NO_PERMISSION
 */
function sniffer_admin_chart()
{
    //common admin menu
   $data['menulinks'] = xarModAPIFunc('sniffer','admin','getmenulinks');

    return $data;
}

?>
