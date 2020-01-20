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

use Contao\ContentModel;

/**
 * Class TabSeparatorElement
 */
final class TabStartElement extends AbstractTabElement
{
    /**
     * Template name.
     *
     * @var string
     */
    protected $templateName = 'ce_bs_tab_start';

    /**
     * {@inheritDoc}
     */
    protected function prepareTemplateData(array $data): array
    {
        $data = parent::prepareTemplateData($data);

        $data['fade']     = $this->get('bs_tab_fade') ? ' fade' : '';
        $data['grid']     = $this->getGridIterator();
        $data['navClass'] = $this->get('bs_tab_nav_class');

        $iterator = $this->getIterator();
        if ($iterator) {
            $iterator->rewind();

            $currentItem = $iterator->current();

            $data['navigation']  = $iterator->navigation();
            $data['currentItem'] = $currentItem;

            if ($this->get('bs_tab_fade') && $currentItem && $currentItem->active()) {
                $data['fade'] = rtrim($data['fade'] .= ' show');
            }
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(): string
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
     * {@inheritdoc}
     */
    protected function getParent(): ?ContentModel
    {
        return $this->getModel();
    }
}
