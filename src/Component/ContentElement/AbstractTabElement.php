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

declare(strict_types=1);

namespace ContaoBootstrap\Tab\Component\ContentElement;

use Assert\AssertionFailedException;
use Contao\ContentModel;
use ContaoBootstrap\Tab\View\Tab\NavigationIterator;
use ContaoBootstrap\Tab\View\Tab\TabRegistry;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\Routing\ScopeMatcher;

/**
 * Class AbstractTabElement
 */
abstract class AbstractTabElement extends AbstractContentElementController
{
    /**
     * Request scope matcher.
     *
     * @var RequestScopeMatcher
     */
    private $scopeMatcher;

    /**
     * Tab registry.
     *
     * @var TabRegistry
     */
    private $tabRegistry;


    public function __construct(ScopeMatcher $scopeMatcher, TabRegistry $tabRegistry)
    {
        // $this->requestStack = $requestStack;
        $this->scopeMatcher = $scopeMatcher;
        $this->tabRegistry = $tabRegistry;
    }




    /**
     * Get the grid provider.
     *
     * @return TabRegistry
     */
    protected function getTabRegistry(): TabRegistry
    {
        return $this->tabRegistry;
    }


    /**
     * Check if we are in backend mode.
     *
     * @return bool
     */
    protected function isBackendRequest(): bool
    {
        return $this->scopeMatcher->isBackendRequest();
    }

    /**
     * Get the tab navigation iterator.
     *
     * @return NavigationIterator
     */
    protected function getIterator($model): ?NavigationIterator
    {
        $parent = $this->getParent($model);
        if (!$parent) {
            return null;
        }

        try {
            return $this->getTabRegistry()->getIterator((string) $parent->id);
        } catch (AssertionFailedException $e) {
            return null;
        }
    }

    /**
     * Get the parent model.
     *
     * @return ContentModel|null
     */
    protected function getParent($model): ?ContentModel
    {
        return ContentModel::findByPk($model->bs_tab_parent ? $model->bs_tab_parent : $model->id);
    }



}
