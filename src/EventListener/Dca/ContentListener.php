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

namespace ContaoBootstrap\Tab\EventListener\Dca;

use Contao\ContentModel;
use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Database\Result;
use Contao\DataContainer;
use Contao\Model;
use Contao\StringUtil;

/**
 * Class ContentListener
 *
 * @package ContaoBootstrap\Tab\EventListener\Dca
 */
final class ContentListener
{


    /**
     * Initialize the dca.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function initializeDca(): void
    {
        $GLOBALS['TL_CSS'][] = 'bundles/contaobootstraptab/css/backend.css';
    }

    /**
     * Get all tab parent options.
     *
     * @return array
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function getTabParentOptions(): array
    {
        $columns[] = 'tl_content.type = ?';
        $columns[] = 'tl_content.pid = ?';
        $columns[] = 'tl_content.ptable = ?';

        $values[] = 'bs_tab_start';
        $values[] = CURRENT_ID;
        $values[] = $GLOBALS['TL_DCA']['tl_content']['config']['ptable'];

        $collection = ContentModel::findBy($columns, $values);
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

    /**
     * Generate the columns.
     *
     * @param DataContainer $dataContainer Data container driver.
     *
     * @return void
     */
    public function generateColumns($dataContainer)
    {
        if (!$dataContainer->activeRecord || $dataContainer->activeRecord->type !== 'bs_tab_start') {
            return;
        }

        /** @var ContentModel|Result $current */
        $current      = $dataContainer->activeRecord;
        $stopElement  = $this->getStopElement($current);
        $count        = $this->countRequiredSeparators($dataContainer->activeRecord->bs_tabs, $current);
        $nextElements = $this->getNextElements($stopElement);

        if ($count > 0) {
            $sorting = (int) $stopElement->sorting;
            $sorting = $this->createSeparators((int) $count, $current, $sorting);

            array_unshift($nextElements, $stopElement);
            $this->updateSortings($nextElements, $sorting);
        }
    }

    /**
     * Count the required separator fields which should be created.
     *
     * @param mixed        $definition The tab definitions.
     * @param ContentModel $current    The current content model.
     *
     * @return int
     */
    private function countRequiredSeparators($definition, $current): int
    {
        $definition = StringUtil::deserialize($definition, true);
        $count      = -1;

        foreach ($definition as $item) {
            if ($item['type'] !== 'dropdown') {
                $count++;
            }
        }

        $count -= ContentModel::countBy(
            [
                'tl_content.ptable=?',
                'tl_content.pid=?',
                '(tl_content.type = ? AND tl_content.bs_tab_parent = ?)',
            ],
            [$current->ptable, $current->pid, 'bs_tab_separator', $current->id],
            ['order' => 'tl_content.sorting ASC']
        );

        return $count;
    }

    /**
     * Create separators.
     *
     * @param int          $value   Number of separators being created.
     * @param ContentModel $current Current model.
     * @param int          $sorting Current sorting value.
     *
     * @return int
     */
    protected function createSeparators(int $value, $current, int $sorting): int
    {
        for ($count = 1; $count <= $value; $count++) {
            $sorting = ($sorting + 8);
            $this->createTabElement($current, 'bs_tab_separator', $sorting);
        }

        return $sorting;
    }

    /**
     * Update the sorting of given elements.
     *
     * @param Model[] $elements    Model collection.
     * @param int     $lastSorting Last sorting value.
     *
     * @return int
     */
    protected function updateSortings(array $elements, int $lastSorting): int
    {
        foreach ($elements as $element) {
            if ($lastSorting > $element->sorting) {
                $element->sorting = ($lastSorting + 8);
                $element->save();
            }

            $lastSorting = (int) $element->sorting;
        }

        return $lastSorting;
    }

    /**
     * Create the stop element.
     *
     * @param ContentModel $current Model.
     * @param int          $sorting Last sorting value.
     *
     * @return Model
     */
    protected function createStopElement($current, int $sorting): Model
    {
        $sorting = ($sorting + 8);

        return $this->createTabElement($current, 'bs_tab_end', $sorting);
    }

    /**
     * Create a tab element.
     *
     * @param ContentModel $current Current content model.
     * @param string       $type    Type of the content model.
     * @param int          $sorting The sorting value.
     *
     * @return Model
     */
    protected function createTabElement($current, string $type, int &$sorting): Model
    {
        $model                = new ContentModel();
        $model->tstamp        = time();
        $model->pid           = $current->pid;
        $model->ptable        = $current->ptable;
        $model->sorting       = $sorting;
        $model->type          = $type;
        $model->bs_tab_parent = $current->id;
        $model->save();

        return $model;
    }

    /**
     * Get the next content elements.
     *
     * @param ContentModel $current Current content model.
     *
     * @return ContentModel[]
     */
    protected function getNextElements($current): array
    {
        $collection = ContentModel::findBy(
            [
                'tl_content.ptable=?',
                'tl_content.pid=?',
                'tl_content.sorting > ?',
            ],
            [$current->ptable, $current->pid, $current->sorting],
            ['order' => 'tl_content.sorting ASC']
        );

        if ($collection) {
            return $collection->getIterator()->getArrayCopy();
        }

        return [];
    }

    /**
     * Get related stop element.
     *
     * @param ContentModel $current Current element.
     *
     * @return ContentModel|Model
     */
    protected function getStopElement($current): Model
    {
        $stopElement = ContentModel::findOneBy(
            ['tl_content.type=?', 'tl_content.bs_tab_parent=?'],
            ['bs_tab_end', $current->id]
        );

        if ($stopElement) {
            return $stopElement;
        }

        $nextElements = $this->getNextElements($current);
        $stopElement  = $this->createStopElement($current, (int) $current->sorting);
        $this->updateSortings($nextElements, (int) $stopElement->sorting);

        return $stopElement;
    }
}
