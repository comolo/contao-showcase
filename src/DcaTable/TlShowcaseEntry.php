<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 26.07.18
 * Time: 17:09
 */

namespace Comolo\ShowcaseBundle\DcaTable;

/**
 * tl_showcase_entry
 *
 * Class TlShowcaseEntry
 * @package Comolo\ShowcaseBundle\DcaTable
 */
class TlShowcaseEntry
{
    /**
     * Types of showcase elements
     */
    public function getShowcaseElements()
    {
        return [
            'regular',
            'subpage'
        ];
    }

}
