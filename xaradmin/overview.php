<?php
/**
 * Displays standard Overview page
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
 * Overview function that displays the standard Overview page
 *
 */
function sniffer_admin_overview()
{
    $data=array();

   /* Security Check */
    if (!xarSecurityCheck('AdminSniffer',0)) return $data;

    /* if there is a separate overview function return data to it
     * else just call the main function that displays the overview
     */
    //common admin menu
   $data['menulinks'] = xarModAPIFunc('sniffer','admin','getmenulinks');
    return xarTplModule('sniffer', 'admin', 'main', $data,'main');
}

?>
