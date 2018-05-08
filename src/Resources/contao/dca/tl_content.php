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

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_start extends'] = [
    'type'      => ['type', 'name', 'bs_tab_name'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['ba_tab_separator'] = [
    'type'      => ['type', 'name', 'bs_grid_parent'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_end extends']   = [
    'type'      => ['type', 'name', 'bs_grid_parent'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];


$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tabs'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'tl_class'       => 'clr',
        'submitOnChange' => true,
        'columnFields'   => [
            'title' => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_title'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => [],
            ],
            'type'  => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_type'],
                'exclude'   => true,
                'inputType' => 'select',
                'options'   => ['dropdown', 'child'],
                'reference' => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_type'],
                'eval'      => ['includeBlankOption' => true, 'style' => 'width: 140px;', 'chosen' => true],
            ],
            'active' => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_active'],
                'exclude'   => true,
                'inputType' => 'checkbox',
                'eval'      => [],
            ],
        ],
    ],
    'sql'       => "blob NULL",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['bootstrap_fade'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bootstrap_fade'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "char(1) NOT NULL default ''",
];
