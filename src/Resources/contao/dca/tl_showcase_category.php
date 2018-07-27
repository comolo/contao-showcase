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

use Comolo\ShowcaseBundle\DcaTable\TlShowcaseCategory;

/**
 * Table tl_showcase_folder
 */
$GLOBALS['TL_DCA']['tl_showcase_category'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_showcase',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'alias' => 'index',
            )
        ),
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 4,
            'panelLayout'             => 'filter;search,limit',
            'fields'                  => array('sorting'),
            'flag'                    => 1,
            'child_record_callback'   => array(TlShowcaseCategory::class, 'addCteType'),
            'headerFields'            => array('title'),

        ),
        'label' => array
        (
            'fields'                  => array('title'),
            'format'                  => '%s'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_category']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg',
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_category']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_category']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_category']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Select
    'select' => array
    (
        'buttons_callback' => array()
    ),

    // Edit
    'edit' => array
    (
        'buttons_callback' => array()
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'                => array(),
        'default'                     => '{general_legend},title,alias,isotopeFilter,isotopeSorting,default;',
    ),

    // Subpalettes
    'subpalettes' => array
    (
        ''                            => ''
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL"
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_category']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'alias' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_category']['alias'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'folderalias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''",
            'save_callback' => array
            (
                array(TlShowcaseCategory::class, 'generateAlias')
            ),
        ),
        'isotopeFilter' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_category']['isotopeFilter'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'isotopeSorting' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_category']['isotopeSorting'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'default' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_category']['default'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true, 'mandatory'=>false, 'maxlength'=>1, 'tl_class'=>'clr w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        /*
         * TODO:
         *  - Kurze Beschreibung
         *  - Kategorien auswählen
         *  - Thumbnail auswählen
         *  - Lightbox-Foto auswählen / Youtube Link
         *  - tl_content Elemente anlegbar machen
         *  - Veröffentlichen ja / nein & von / bis
         *
         * Frontend Module:
         *  - Listendarstellung
         *  - Unterseitendarstellung
         */
    )
);

