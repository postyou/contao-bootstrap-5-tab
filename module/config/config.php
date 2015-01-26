<?php

/**
 * @package   contao-bootstrap
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   LGPL 3+
 * @copyright 2013-2015 netzmacht creative David Molineus
 */


// Content elements
$GLOBALS['TL_CTE']['bootstrap_tabs']['bootstrap_tabStart'] = 'Netzmacht\Bootstrap\Tab\TabElement';
$GLOBALS['TL_CTE']['bootstrap_tabs']['bootstrap_tabPart']  = 'Netzmacht\Bootstrap\Tab\TabElement';
$GLOBALS['TL_CTE']['bootstrap_tabs']['bootstrap_tabEnd']   = 'Netzmacht\Bootstrap\Tab\TabElement';

// Wrapper settings
$GLOBALS['TL_WRAPPERS']['start'][]     = 'bootstrap_tabStart';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'bootstrap_tabEnd';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'bootstrap_tabPart';
