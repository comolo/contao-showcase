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
class TlShowcaseCategory
{
    /**
     * Return legend of category entries
     *
     * @param $arrRow
     * @return string
     */
    public function addCteType($arrRow)
    {
        return $arrRow['title'];
    }

    /**
     * Generate a category alias
     *
     * @param $varValue
     * @param \DataContainer $dc
     * @return mixed
     */
    public function generateAlias($varValue, \DataContainer $dc)
    {
        // Generate an alias if there is none
        if ($varValue == '')
        {
            $slugOptions = array();
            $varValue = \System::getContainer()->get('contao.slug.generator')->generate(\StringUtil::prepareSlug($dc->activeRecord->title), $slugOptions);
        }

        return $varValue;
    }
}
