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
 * @ContentElement("bs_tab_end",category="bootstrap_tabs")
 */
final class TabEndElement extends AbstractTabElement
{
    /**
     * Template name.
     *
     * @var string
     */
    protected $templateName = 'ce_bs_tab_end';

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        if ($iterator = $this->getIterator($model)) {
           $template->navigation = $iterator->navigation();
        }

        if ($parent = $this->getParent($model)) {
            $template->showNavigation = $parent->bs_tab_nav_position === 'after';
            $template->navClass       = $parent->bs_tab_nav_class;
        }

        return $template->getResponse();    
    }
}
