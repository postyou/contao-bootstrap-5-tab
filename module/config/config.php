<?php

/**
 * @package   contao-bootstrap
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   LGPL 3+
 * @copyright 2013-2014 netzmacht creative David Molineus
 */


// Content elements
$GLOBALS['TL_CTE']['bootstrap_tabs']['bootstrap_tabStart'] = 'Netzmacht\Bootstrap\Components\Contao\ContentElement\Tab';
$GLOBALS['TL_CTE']['bootstrap_tabs']['bootstrap_tabPart']  = 'Netzmacht\Bootstrap\Components\Contao\ContentElement\Tab';
$GLOBALS['TL_CTE']['bootstrap_tabs']['bootstrap_tabEnd']   = 'Netzmacht\Bootstrap\Components\Contao\ContentElement\Tab';

// Wrapper settings
$GLOBALS['TL_WRAPPERS']['start'][]     = 'bootstrap_tabStart';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'bootstrap_tabEnd';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'bootstrap_tabPart';
