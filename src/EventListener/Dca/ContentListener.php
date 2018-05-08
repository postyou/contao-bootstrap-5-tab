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

namespace ContaoBootstrap\Tab\EventListener\Dca;

use Contao\ContentModel;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFrameworkInterface as ContaoFramework;
use Contao\DataContainer;

/**
 * Class ContentListener
 *
 * @package ContaoBootstrap\Tab\EventListener\Dca
 */
class ContentListener
{
    /**
     * Contao framework.
     *
     * @var ContaoFramework
     */
    private $framework;

    /**
     * Content Model repository.
     *
     * @var Adapter|ContentModel
     */
    private $repository;

    /**
     * ContentDataContainer constructor.
     *
     * @param ContaoFramework $framework   Contao framework.
     */
    public function __construct(ContaoFramework $framework)
    {
        $this->framework  = $framework;
        $this->repository = $this->framework->getAdapter(ContentModel::class);
    }

    /**
     * @param DataContainer|null $dataContainer
     *
     * @return array
     * @throws \Exception
     */
    public function getTabParentOptions($dataContainer = null)
    {
        $columns[] = 'tl_content.type = ?';
        $values[]  = 'bs_tab_start';

        if ($dataContainer) {
            $columns[] = 'tl_content.pid = ?';
            $columns[] = 'tl_content.ptable = ?';

            $values[] = $dataContainer->activeRecord->pid;
            $values[] = $dataContainer->activeRecord->ptable;
        }

        $collection = $this->repository->findBy($columns, $values);
        $options    = [];

        if ($collection) {
            foreach ($collection as $model) {
                $options[$model->id] = sprintf(
                    '%s [%s]',
                    $model->bs_tab_name,
                    $model->id
                );
            }
        }

        return $options;
    }
}
