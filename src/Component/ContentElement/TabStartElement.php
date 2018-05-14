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
use Contao\ContentModel;
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
        $this->Template->fade = $this->bs_tab_fade ? ' fade': '';
        $this->Template->grid = $this->getGridIterator();

        $iterator = $this->getIterator();
        if ($iterator) {
            $iterator->rewind();

            $currentItem = $iterator->current();

            $this->Template->navigation  = $iterator->navigation();
            $this->Template->currentItem = $currentItem;

            if ($this->bs_tab_fade && $currentItem && $currentItem->active()) {
                $this->Template->fade .= ' show';
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        if ($this->isBackendRequest()) {
            $iterator = $this->getIterator();

            if ($iterator) {
                $iterator->rewind();
            }
        }

        return parent::generate();
    }

    /**
     * @return NavigationIterator|null
     */
    protected function getIterator(): ?NavigationIterator
    {
        try {
            return $this->getTabRegistry()->getIterator((string) $this->id);
        } catch (AssertionFailedException $e) {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getParent(): ?ContentModel
    {
        return $this->getModel();
    }
}
