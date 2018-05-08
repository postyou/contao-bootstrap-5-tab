<?php

/**
 * @package   contao-bootstrap
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   LGPL 3+
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

/*
 * Palettes
 */

// bootstrap tabs palette
$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bootstrap_tabPart extends _bootstrap_default_']  = array();
$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bootstrap_tabEnd extends _bootstrap_default_']   = array();
$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bootstrap_tabStart extends _bootstrap_default_'] = array
(
    'config' => array(
        'bootstrap_tabs',
        'bootstrap_fade',
    )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bootstrap_tabs'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bootstrap_tabs'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => array(
        'tl_class'       => 'clr',
        'submitOnChange' => true,
        'columnFields'   => array
        (
            'title' => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bootstrap_tabs_title'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => array(),
            ),
            'type'  => array
            (
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bootstrap_tabs_type'],
                'exclude'   => true,
                'inputType' => 'select',
                'options'   => array('dropdown', 'child'),
                'reference' => &$GLOBALS['TL_LANG']['tl_content']['bootstrap_tabs_type'],
                'eval'      => array('includeBlankOption' => true, 'style' => 'width: 140px;', 'chosen' => true),
            ),
        )
    ),
    'sql'       => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bootstrap_fade'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bootstrap_fade'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array('tl_class' => 'w50'),
    'sql'       => "char(1) NOT NULL default ''"
);
