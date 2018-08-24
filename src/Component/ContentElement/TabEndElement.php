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

namespace ContaoBootstrap\Tab\Component\ContentElement;

/**
 * Class TabSeparatorElement
 */
final class TabEndElement extends AbstractTabElement
{
    /**
     * Template name.
     *
     * @var string
     */
    protected $templateName = 'ce_bs_tab_end';

    /**
     * {@inheritDoc}
     */
    protected function prepareTemplateData(array $data): array
    {
        $data         = parent::prepareTemplateData($data);
        $data['grid'] = $this->getGridIterator();

        if ($iterator = $this->getIterator()) {
            $data['navigation'] = $iterator->navigation();
        }

        if ($parent = $this->getParent()) {
            $data['showNavigation'] = $parent->bs_tab_nav_position === 'after';
            $data['navClass']       = $parent->bs_tab_nav_class;
        }

        return $data;
    }
}
