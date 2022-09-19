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
 * @ContentElement("bs_tab_separator",category="bootstrap_tabs")
 */
final class TabSeparatorElement extends AbstractTabElement
{

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        $iterator = $this->getIterator($model);
        $parent   = $this->getParent($model);
        // $data     = parent::prepareTemplateData($data);

        $template->fade = ($parent && $parent->bs_tab_fade) ? ' fade' : '';

        if ($iterator) {
            $iterator->next();

            if ($iterator->valid()) {
                $currentItem = $iterator->current();

                $template->currentItem = $currentItem;

                if ($parent->bs_tab_fade && $currentItem && $currentItem->active()) {
                    $template->fade = rtrim($template->fade . ' show');
                }
            }
        }


        return $template->getResponse();    
    }
}
