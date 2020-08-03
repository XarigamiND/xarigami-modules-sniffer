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
 * Function to determine the client (browser, bot, ...)
 *
 * @return Boolean
 */
function sniffer_eventapi_OnSessionCreate($arg)
{
    // Note : we can't use xarModAPIFunc for this event !
    sys::import('modules.sniffer.xaruserapi.sniff');
    return sniffer_userapi_sniff($arg);
}

?>
