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

use Assert\AssertionFailedException;
use ContaoBootstrap\Tab\View\Tab\NavigationIterator;

/**
 * Class TabSeparatorElement
 */
class TabStartElement extends AbstractTabElement
{
    /**
     * Template name.
     *
     * @var string
     */
    protected $strTemplate = 'ce_bs_tab_start';

    /**
     * {@inheritdoc}
     */
    protected function compile()
    {
        $this->Template->navigation  = $this->getTabRegistry()->getNavigation((string) $this->id);
        $this->Template->currentItem = $this->getIterator()->current();
    }

    protected function getIterator(): ?NavigationIterator
    {
        try {
            return $this->getTabRegistry()->getIterator((string) $this->id);
        } catch (AssertionFailedException $e) {
            return null;
        }
    }
}
