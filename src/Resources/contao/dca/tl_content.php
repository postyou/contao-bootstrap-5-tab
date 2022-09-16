<?php

/**
 * Contao Bootstrap
 *
 * @package    contao-bootstrap
 * @subpackage Tab
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2013-2020 netzmacht David Molineus. All rights reserved.
 * @license    LGPL-3.0-or-later https://github.com/contao-bootstrap/tab/blob/master/LICENSE
 * @filesource
 */

/*
 * Config
 */

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = [
    'ContaoBootstrap\Tab\EventListener\Dca\ContentListener',
    'initializeDca',
];

$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = [
    'ContaoBootstrap\Tab\EventListener\Dca\ContentListener',
    'generateColumns',
];

/*
 * Palettes
 */

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_start'] = [
    'type'      => ['headline', 'type', 'bs_tab_name'],
    'config'    => ['bs_tabs', 'bs_tab_nav_position', 'bs_tab_fade', 'bs_grid'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID', 'bs_tab_content_class', 'bs_tab_nav_class'],
    'invisible' => ['invisible', 'start', 'stop'],
];

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_separator'] = [
    'type'      => ['type', 'name', 'bs_tab_parent'],
    'template'  => [':hide', 'customTpl'],
    'protected' => [':hide', 'protected'],
    'expert'    => [':hide', 'guests', 'cssID'],
    'invisible' => ['invisible', 'start', 'stop'],
];

$GLOBALS['TL_DCA']['tl_content']['metapalettes']['bs_tab_end'] = [
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
    'options_callback' => ['ContaoBootstrap\Tab\EventListener\Dca\ContentListener', 'getTabParentOptions'],
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

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tab_name'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tab_name'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'clr w50', 'mandatory' => true, 'maxlength' => 64],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tabs'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'tl_class'       => 'clr lng bs-tabs',
        'submitOnChange' => true,
        'columnFields'   => [
            'type'   => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_type'],
                'exclude'   => true,
                'inputType' => 'select',
                'options'   => ['dropdown', 'child'],
                'reference' => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_type'],
                'eval'      => ['includeBlankOption' => true, 'style' => 'width: 140px;', 'chosen' => true],
            ],
            'title'  => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_title'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => ['mandatory' => true],
            ],
            'cssId'  => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_cssId'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => [],
            ],
            'active' => [
                'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tabs_active'],
                'exclude'   => true,
                'inputType' => 'checkbox',
                'eval'      => [],
            ],
        ],
    ],
    'sql'       => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tab_nav_position'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tab_nav_position'],
    'exclude'   => true,
    'inputType' => 'select',
    'eval'      => ['tl_class' => 'w50'],
    'options'   => ['before', 'after'],
    'sql'       => "varchar(12) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tab_fade'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tab_fade'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 m12'],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tab_content_class'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tab_content_class'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'clr w50', 'maxlength' => 64],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['bs_tab_nav_class'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['bs_tab_nav_class'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['tl_class' => 'w50', 'maxlength' => 64],
    'sql'       => "varchar(64) NOT NULL default ''",
];
