<?php
/*
 * This file is part of the SuperTheme extension by Comolo.
 *
 * Copyright (C) 2018 Comolo GmbH
 *
 * @author    Hendrik Obermayer <https://github.com/henobi>
 * @copyright 2018 Comolo GmbH <https://www.comolo.de/>
 * @license   proprietary
 */
namespace Comolo\ShowcaseBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Comolo\ShowcaseBundle\ComoloShowcaseBundle;

/**
 * Plugin for the Contao Manager.
 *
 * @author Hendrik Obermayer <https://github.com/henobi>
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ComoloShowcaseBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['showcase']),
        ];
    }
}
