<?php

/**
 * @package   contao-bootstrap
 * @author    David Molineus <david.molineus@netzmacht.de>
 * @license   LGPL 3+
 * @copyright 2013-2015 netzmacht creative David Molineus
 */

return array(
    'wrappers' => array(
        'tabs' => array(
            'start' => array
            (
                'name'           => 'bootstrap_tabStart',
                'trigger-create' => true, // auto create separators and stop element
                'trigger-delete' => true, // auto delete separators and stop element
            ),

            'separator' => array
            (
                'name'           => 'bootstrap_tabPart',
                'auto-create'    => true, // can be auto created
                'auto-delete'    => true, // can be auto deleted

                // callback to detect how many separators exists
                'count-existing' => array('Netzmacht\Bootstrap\Tab\Dca\Content', 'countExistingTabSeparators'),

                // callback to detect how many separators are required
                'count-required' => array('Netzmacht\Bootstrap\Tab\Dca\Content', 'countRequiredTabSeparators'),
            ),

            'stop' => array
            (
                'name'        => 'bootstrap_tabEnd',
                'auto-create' => true,
                'auto-delete' => true,
            ),
        ),
    ),
);
