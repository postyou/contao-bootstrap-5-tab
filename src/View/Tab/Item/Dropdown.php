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

namespace ContaoBootstrap\Tab\View\Tab\Item;

use ContaoBootstrap\Tab\View\Tab\ItemList;

/**
 * Class Dropdown
 */
class Dropdown extends NavItem implements ItemList
{
    /**
     * @var array|NavItem[]
     */
    private $items;

    /**
     * Dropdown constructor.
     *
     * @param string      $title
     * @param array       $items
     * @param string|null $cssId
     */
    public function __construct(string $title, array $items, string $cssId = null)
    {
        parent::__construct($title, false, $cssId);

        $this->items = $items;
    }

    /**
     * {@inheritdoc}
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(NavItem $navItem): ItemList
    {
        $this->items[] = $navItem;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function active(): bool
    {
        foreach ($this->items as $item) {
            if ($item->active()) {
                return true;
            }
        }

        return false;
    }
}
