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
        $parent   = $this->getParent();

        $this->Template->fade = ($parent && $parent->bs_tab_fade) ? ' fade': '';

        if ($iterator) {
            $iterator->next();

            if ($iterator->valid()) {
                $currentItem = $iterator->current();

                $this->Template->currentItem = $currentItem;

                if ($parent->bs_tab_fade && $currentItem && $currentItem->active()) {
                    $this->Template->fade .= ' show';
                }
            }
        }
    }
}
