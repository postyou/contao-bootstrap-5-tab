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
use Contao\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;

/**
 * @ContentElement("bs_tab_start",category="bootstrap_tabs")
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
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        // $data = parent::prepareTemplateData($data);

        // $data['fade']     = $this->bs_tab_fade ? ' fade' : '';
        $template->fade   = $model->bs_tab_fade ? ' fade' : '';
        // $data['grid']     = $this->getGridIterator();
        // $data['navClass'] = $this->bs_tab_nav_class;
        $template->navClass = $model->bs_tab_nav_class;

        $iterator = $this->getIterator($model);
        if ($iterator) {
            $iterator->rewind();

            $currentItem = $iterator->current();

            // $data['navigation']  = $iterator->navigation();
            $template->navigation = $iterator->navigation();
            $template->currentItem = $currentItem;
            // $data['currentItem'] = $currentItem;

            if ($model->bs_tab_fade && $currentItem && $currentItem->active()) {
                // $data['fade'] = rtrim($data['fade'] .= ' show');
                $template->fade = trim($template->fade .= ' show');
            }
        }

        // $template->data = $data;

        return $template->getResponse();    
    }



}
