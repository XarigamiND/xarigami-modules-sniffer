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
 * Delete a sniff
 *
 * @public
 * @author Richard Cave
 * @param 'id' id of the sniff to delete
 * @param 'confirm' confirmation of delete
 * @param 'startnum' starting number to display
 * @param 'sortby' sort by agent, os, etc.
 * @return array, or false on failure
 * @todo MichelV: add $args?
 * @throws BAD_PARAM
 */
function sniffer_admin_delete()
{
    // Security Check
    if(!xarSecurityCheck('DeleteSniffer')) return;

    // Get parameters from input
    if (!xarVarFetch('id', 'int:0:', $id)) return;
    if (!xarVarFetch('confirm', 'int:0:1', $confirm, 0)) return;
    if (!xarVarFetch('startnum', 'int:0:', $startnum, 1)) return;
    if (!xarVarFetch('sortby', 'str:1:', $sortby, 'id')) return;

    // Get the current sniff
    $sniff = xarModAPIFunc('sniffer',
                           'user',
                           'getsniff',
                           array('id' => $id));

    // Check for exceptions
    if (!isset($sniff) && xarCurrentErrorType() != XAR_NO_EXCEPTION)
        return; // throw back
    //common admin menu
   $data['menulinks'] = xarModAPIFunc('sniffer','admin','getmenulinks');
    // Check for confirmation.
    if (!$confirm) {

        // Specify for which sniff you want confirmation
        $data['id'] = $id;

        // Data to display in the template
        $data['agent'] = xarVarPrepForDisplay($sniff['agent']);
        $data['submitlabel'] = xarML('Confirm');

        // Generate a one-time authorisation code for this operation
        $data['authid'] = xarSecGenAuthKey();

        // Nice stuff for end user
        $data['startnum'] = $startnum;
        $data['sortby'] = $sortby;
        $data['cancelurl'] = xarModURL('sniffer',
                                       'admin',
                                       'view',
                                       array('startnum' => $startnum,
                                             'sortby' => $sortby));

        // Return the template variables defined in this function
        return $data;
    }

    // If we get here it means that the user has confirmed the action

    // Confirm authorisation code
    if (!xarSecConfirmAuthKey()) {
        $msg = xarML('Invalid authorization key for deleting #(1) Sniff #(2)',
                    'Sniffer', xarVarPrepForDisplay($id));
        return xarResponseForbidden(null,$msg);
    }

    // Remove the sniff
    if (!xarModAPIFunc('sniffer', 'admin', 'delete',
                       array('id' => $id))) {
        return; // throw back
    }

    $msg =  xarML('Sniff successfully deleted.');
    xarTplSetMessage($msg,'status');

    // Redirect
    xarResponseRedirect(xarModURL('sniffer', 'admin', 'view',
                                  array('startnum' => $startnum,
                                        'sortby' => $sortby)));


    // Return
    return true;
}

?>
