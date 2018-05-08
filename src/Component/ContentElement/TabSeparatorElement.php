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
class TabSeparatorElement extends AbstractTabElement
{
    /**
     * Template name.
     *
     * @var string
     */
    protected $strTemplate = 'ce_bs_tab_separator';

    /**
     * {@inheritdoc}
     */
    protected function compile()
    {
        $iterator = $this->getIterator();

        if ($iterator) {
            $iterator->next();

            if ($iterator->valid()) {
                $this->Template->currentItem = $iterator->current();
            }
        }
    }

    /**
     * @return NavigationIterator
     *
     * @throws \Assert\AssertionFailedException
     */
    protected function getIterator(): ?NavigationIterator
    {
        try {
            return $this->getTabRegistry()->getIterator((string) $this->bs_tab_parent);
        } catch (AssertionFailedException $e) {
            return null;
        }
    }
}
