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

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_start'] = [
    'type'      => ['type', 'name', 'bs_tab_name'],
    'config'    => ['bs_tabs'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_separator'] = [
    'type'      => ['type', 'name', 'bs_tab_parent'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_end']   = [
    'type'      => ['type', 'name', 'bs_tab_parent'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];

/*
 * Fields
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tab_parent'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['bs_tab_parent'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['contao_bootstrap.tab.listener.dca.content', 'getTabParentOptions'],
    'reference'        => &$GLOBALS['TL_LANG']['tl_content'],
    'eval'             => [
        'mandatory'          => true,
        'includeBlankOption' => true,
        'chosen'             => true,
        'doNotCopy'          => true,
        'tl_class'           => 'w50',
    ],
    'sql'              => "int(10) unsigned NOT NULL default '0'",
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
