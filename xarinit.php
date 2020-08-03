<?php
/**
 * Sniffer System
 *
 * @package modules
 * @copyright (C) 2002-2006 The Digital Development Foundation
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 * @subpackage Xarigami Sniffer Module
 * @copyright (C) 2008-2011 2skies.com
 * @link http://xarigami.com
 */
/**
 * Initialise the mail module
 *
 * @author Frank Besler
 * @access public
 * @param none $
 * @return true on success or void or false on failure
 * @throws 'DATABASE_ERROR'
 * @todo nothing
 */
function sniffer_init()
{
    // Get database setup
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();
    // Load Table Maintainance API
    xarDBLoadTableMaintenanceAPI();
    // Create the Table
    $systemPrefix = xarDBGetSystemTablePrefix();
    $xartable['sniffer'] = $systemPrefix . '_sniffer';

    $query = xarDBCreateTable($xartable['sniffer'],
        array('xar_ua_id' => array('type' => 'integer','unsigned' => true, 'null' => false, 'increment' => true, 'primary_key' => true),
            'xar_ua_agent' => array('type' => 'text', 'null' => false),
            'xar_ua_osnam' => array('type' => 'varchar', 'size' => 40, 'null' => false),
            'xar_ua_osver' => array('type' => 'varchar', 'size' => 20, 'null' => false),
            'xar_ua_agnam' => array('type' => 'varchar', 'size' => 40, 'null' => false),
            'xar_ua_agver' => array('type' => 'varchar', 'size' => 20,'null' => false),
            'xar_ua_cap' => array('type' => 'text'),
            'xar_ua_quirk' => array('type' => 'text')
            ));
    if (empty($query)) return false; // throw back

    // Pass the Table Create DDL to adodb to create the table
    $result = $dbconn->Execute($query);
    if (!$result) return false;

    // set index
    $query = xarDBCreateIndex($xartable['sniffer'],
        array('name' => 'i_' . xarDBGetSiteTablePrefix() . '_sniff_ag',
            'fields' => array('xar_ua_agent(328)'),
            'unique' => true));
    $result = $dbconn->Execute($query);
    if (!$result) return false;

    // Register Masks
    xarRegisterMask('ReadSniffer','All','sniffer','All','All','ACCESS_READ');
    xarRegisterMask('EditSniffer','All','sniffer','All','All','ACCESS_EDIT');
    xarRegisterMask('AddSniffer','All','sniffer','All','All','ACCESS_ADD');
    xarRegisterMask('DeleteSniffer','All','sniffer','All','All','ACCESS_DELETE');
    xarRegisterMask('AdminSniffer','All','sniffer','All','All','ACCESS_ADMIN');

    // Set up module variables
    xarModSetVar('sniffer', 'itemsperpage', '20');

    // sniff the installing user
    xarModAPIFunc('sniffer', 'user', 'sniffbasic');

    return true;
}

/**
 * Upgrade the mail module from an old version
 *
 * @author Frank Besler
 * @access public
 * @param  $oldversion
 * @return true on success or false on failure
 * @throws no exceptions
 * @todo nothing
 */
function sniffer_upgrade($oldversion)
{
    // Get database setup
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();
    $sniffertable = $xartable['sniffer'];
    // load the table maintenance API
    xarDBLoadTableMaintenanceAPI();
    // Upgrade dependent on old version number
    switch ($oldversion) {
        case '1.0.0':
            if (xarDBGetType() !='sqlite') { //cannot upgrade sqlite tables
                $query = xarDBDropIndex($xartable['sniffer'],
                    array('name'=>"i_".xarDBGetSiteTablePrefix()."_sniff_ag"));
                $result = &$dbconn->Execute($query);
                if (!$result) return false;

                $query = xarDBAlterTable($xartable['sniffer'],
                    array('command'=>'modify',
                        'field'=>'xar_ua_agent',
                        'type'=>'text'));

                $result = $dbconn->Execute($query);
                if (!$result) return false;

                $query = xarDBCreateIndex($xartable['sniffer'],
                    array('name' => 'i_' . xarDBGetSiteTablePrefix() . '_sniff_ag',
                        'fields' => array('xar_ua_agent(328)'),
                        'unique' => true));
                $result = &$dbconn->Execute($query);

                if (!$result) return false;

                $query = "ANALYZE TABLE $sniffertable";
                $result = &$dbconn->Execute($query);
                if (!$result) return false;
            }
        case '1.1.0':
            if (xarDBGetType() !='sqlite') {
                $query = xarDBAlterTable($xartable['sniffer'],
                array( 'command'=>'modify',
                    'field'=>'xar_ua_id',
                    'type'=>'integer',
                    'size'=>11,
                    'unsigned'=>true,
                    'null'=>false,
                    'increment'=>true));
            $result = $dbconn->Execute($query);
            if (!$result) return false;
          }
        case '1.1.1':
            //upgrade for newer browsers
        case '1.1.2':
            //template changes and status for core 1.4.0
        case '1.1.3'://current version
            break;
    }
    return true;
}

/**
 * Delete the mail module
 *
 * @author Frank Besler
 * @access public
 * @param no $ parameters
 * @return true on success or false on failure
 * @todo restore the default behaviour prior to 1.0 release
 */
function sniffer_delete()
{
    // Remove Masks and Instances
    xarRemoveMasks('sniffer');
    xarRemoveInstances('sniffer');

    // Delete any module variables
    xarModDelVar('sniffer', 'itemsperpage');

    // Get database setup
    $dbconn = xarDBGetConn();
    $xartable = xarDBGetTables();

    // load the table maintenance API
    xarDBLoadTableMaintenanceAPI();

    // Drop the table
    $query = xarDBDropTable($xartable['sniffer']);
    if (empty($query)) return; // throw back

    // Drop the table
    $result = $dbconn->Execute($query);

    // Check for an error with the database code, and if so raise the
    if (!$result) return false;

    // Deletion successful
    return true;
}

?>