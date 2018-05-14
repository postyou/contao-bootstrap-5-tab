<?php

/**
 * Contao Bootstrap
 *
 * @package    contao-bootstrap
 * @subpackage Tab
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2013-2018 netzmacht David Molineus. All rights reserved.
 * @license    LGPL-3.0 https://github.com/contao-bootstrap/tab
 * @filesource
 */

declare(strict_types=1);

use ContaoBootstrap\Tab\Component\ContentElement\TabEndElement;
use ContaoBootstrap\Tab\Component\ContentElement\TabSeparatorElement;
use ContaoBootstrap\Tab\Component\ContentElement\TabStartElement;

// Content elements
$GLOBALS['TL_CTE']['bootstrap_tabs']['bs_tab_start']     = TabStartElement::class;
$GLOBALS['TL_CTE']['bootstrap_tabs']['bs_tab_separator'] = TabSeparatorElement::class;
$GLOBALS['TL_CTE']['bootstrap_tabs']['bs_tab_end']       = TabEndElement::class;

// Wrapper settings
$GLOBALS['TL_WRAPPERS']['start'][]     = 'bs_tab_start';
$GLOBALS['TL_WRAPPERS']['stop'][]      = 'bs_tab_separator';
$GLOBALS['TL_WRAPPERS']['separator'][] = 'bs_tab_end';
