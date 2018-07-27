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
use Comolo\ShowcaseBundle\Model\ShowcaseCategoryModel;

/**
 * tl_showcase_entry
 *
 * Class TlShowcaseEntry
 * @package Comolo\ShowcaseBundle\DcaTable
 */
class TlShowcaseEntry
{
    use AliasGenerator;

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

    /**
     * Set the timestamp to 00:00:00 (see #26)
     *
     * @source \tl_news::loadDate
     * @param integer $value
     * @return integer
     */
    public function loadDate($value)
    {
        return strtotime(date('Y-m-d', $value) . ' 00:00:00');
    }

    /**
     * Get all categories with the same pid
     *
     * @param $dc
     * @return array
     */
    public function getCategories(\DataContainer $dc)
    {
        $categories = ShowcaseCategoryModel::findBy('pid', $dc->pid);

        $arrCategories = [];
        foreach ($categories as $category)
        {
            $arrCategories[$category->id] = $category->title;
        }

        return $arrCategories;
    }
}
