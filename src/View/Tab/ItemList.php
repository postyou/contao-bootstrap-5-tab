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

namespace ContaoBootstrap\Tab\View\Tab;

use ContaoBootstrap\Tab\View\Tab\Item\NavItem;

/**
 * Interface ItemList
 */
interface ItemList
{
    /**
     * Add item.
     *
     * @param NavItem $navItem Nav item.
     *
     * @return ItemList
     */
    public function addItem(NavItem $navItem): ItemList;

    /**
     * Get all items.
     *
     * @return array|NavItem[]
     */
    public function items(): array;
}
