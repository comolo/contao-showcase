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
use Comolo\ShowcaseBundle\DcaTable\TlShowcaseEntry;

/**
 * Table tl_showcase_folder
 */
$GLOBALS['TL_DCA']['tl_showcase_entry'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_showcase',
        'ctable'                      => array('tl_content'),
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
            'mode'                    => 1,
            'fields'                  => array('publishingDate'),
            'flag'                    => 6
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
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_entry']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.svg',
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_entry']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_entry']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_showcase_entry']['show'],
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
        '__selector__'                => array('type','addUrl'),
        'default'                     => '{general_legend},title,type,alias,publishingDate;{subheading_legend},subheadline;{content_legend},thumbnail,addUrl;{categories_legend},categories;{expert_legend:hide},cssClass;{publish_legend},published,start,stop',
        'regular'                     => '{general_legend},title,type,alias,publishingDate;{subheading_legend},subheadline;{content_legend},thumbnail,addUrl;categories_legend},categories;{expert_legend:hide},cssClass;{publish_legend},published,start,stop',
        'subpage'                     => '{general_legend},title,type,alias,publishingDate;{subheading_legend},subheadline;{content_legend},thumbnail;categories_legend},categories;{expert_legend:hide},cssClass;{publish_legend},published,start,stop',
    ),

    // Subpalettes
    'subpalettes' => array
    (
        'addUrl'                            => 'url,target'
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
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'alias' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['alias'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'folderalias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50', 'unique' => true),
            'sql'                     => "varchar(255) NOT NULL default ''",
            'save_callback' => array
            (
                array(TlShowcaseEntry::class, 'generateAlias')
            ),
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'publishingDate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['publishingDate'],
            'default'                 => time(),
            'exclude'                 => true,
            'filter'                  => true,
            'sorting'                 => true,
            'flag'                    => 8,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'date', 'mandatory'=>true, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'load_callback'           => [[TlShowcaseEntry::class, 'loadDate']],
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'type' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['type'],
            'default'                 => 'text',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array(TlShowcaseEntry::class, 'getShowcaseElements'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_showcase_entry']['types'],
            'eval'                    => array('helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'subheadline' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['subheadline'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'long'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'flag'                    => 1,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'start' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['start'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['stop'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        ),
        'thumbnail' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['thumbnail'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>\Config::get('validImageTypes'), 'mandatory'=>true),
            'sql'                     => "binary(16) NULL"
        ),
        'addUrl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['addUrl'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'url' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['MSC']['url'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'dcaPicker'=>true, 'addWizardClass'=>false, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'target' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['MSC']['target'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'cssClass' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['cssClass'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'categories' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_showcase_entry']['categories'],
            'inputType'               => 'checkboxWizard',
            'options_callback'        => [TlShowcaseEntry::class, 'getCategories'],
            'eval'                    => array('mandatory'=>false, 'tl_class'=>'wizard', 'multiple'=>true),
            'sql'                     => "blob NULL",
        ),
    )
);
