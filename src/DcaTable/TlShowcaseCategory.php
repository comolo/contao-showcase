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

use Comolo\ShowcaseBundle\DcaTable\Helper\AliasGenerator;

/**
 * tl_showcase_entry
 *
 * Class TlShowcaseEntry
 * @package Comolo\ShowcaseBundle\DcaTable
 */
class TlShowcaseCategory
{
    use AliasGenerator;

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
}
