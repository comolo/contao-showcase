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

$GLOBALS['BE_MOD']['content']['showcase'] = [
    'tables' => ['tl_showcase', 'tl_showcase_entry', 'tl_showcase_category', 'tl_content'],
];

$GLOBALS['TL_MODELS']['tl_showcase_category'] = \Comolo\ShowcaseBundle\Model\ShowcaseCategoryModel::class;
$GLOBALS['TL_MODELS']['tl_showcase_entry'] = \Comolo\ShowcaseBundle\Model\ShowcaseEntryModel::class;
$GLOBALS['TL_MODELS']['tl_showcase'] = \Comolo\ShowcaseBundle\Model\ShowcaseModel::class;

$GLOBALS['FE_MOD']['miscellaneous']['showcase_overview'] = \Comolo\ShowcaseBundle\FrontendModule\ShowcaseOverview::class;
$GLOBALS['FE_MOD']['miscellaneous']['showcase_detail'] = \Comolo\ShowcaseBundle\FrontendModule\ShowcaseDetail::class;
