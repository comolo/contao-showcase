<?php
/*
 * This file is part of the Showcase extension by Comolo.
 *
 * Copyright (C) 2018 Comolo GmbH
 *
 * @author    Hendrik Obermayer <https://github.com/henobi>
 * @copyright 2018 Comolo GmbH <https://www.comolo.de/>
 * @license   proprietary
 */
namespace Comolo\ShowcaseBundle\DcaTable;

use Ausi\SlugGenerator\SlugGenerator;

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
            //TODO: use \System::getContainer()->get('contao.slug.generator')->generate
            $varValue =  (new SlugGenerator)->generate($dc->activeRecord->title);
        }

        return $varValue;
    }
}
