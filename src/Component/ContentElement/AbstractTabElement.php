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
use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\ContentModel;
use ContaoBootstrap\Tab\View\Tab\NavigationIterator;
use ContaoBootstrap\Tab\View\Tab\TabRegistry;

abstract class AbstractTabElement extends ContentElement
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        if ($this->isBackendRequest()) {
            $iterator = $this->getIterator();

            if ($iterator) {
                $iterator->next();
            }

            return $this->renderBackendView($this->getParent(), $iterator);
        }

        return parent::generate();
    }

    /**
     * Get the grid provider.
     *
     * @return TabRegistry
     */
    protected function getTabRegistry(): TabRegistry
    {
        return static::getContainer()->get('contao_bootstrap.tab.tab_registry');
    }

    /**
     * Render the backend view.
     *
     * @param Model|null   $start    Start element.
     * @param NavigationIterator $iterator Iterator.
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected function renderBackendView($start, NavigationIterator $iterator = null): string
    {
        $template = new BackendTemplate('be_bs_tab');

        if ($start) {
            $colorRotate = static::getContainer()->get('contao_bootstrap.core.helper.color_rotate');

            $template->color = $colorRotate->getColor('ce:' . $start->id);
        }

        if (!$start) {
            $template->error = $GLOBALS['TL_LANG']['ERR']['bsGridParentMissing'];
        }

        if ($iterator) {
            $template->name = $iterator->currentTitle();
        }

        return $template->parse();
    }

    /**
     * Check if we are in backend mode.
     *
     * @return bool
     */
    protected function isBackendRequest(): bool
    {
        $scopeMatcher   = static::getContainer()->get('contao.routing.scope_matcher');
        $currentRequest = static::getContainer()->get('request_stack')->getCurrentRequest();

        return $scopeMatcher->isBackendRequest($currentRequest);
    }

    /**
     * @return NavigationIterator
     */
    protected function getIterator(): ?NavigationIterator
    {
        try {
            return $this->getTabRegistry()->getIterator((string) $this->bs_tab_parent);
        } catch (AssertionFailedException $e) {
            return null;
        }
    }

    /**
     * Get the parent model.
     *
     * @return ContentModel|null
     */
    protected function getParent():? ContentModel
    {
        return ContentModel::findByPk($this->bs_tab_parent);
    }
}
