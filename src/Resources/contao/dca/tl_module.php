<?php

$GLOBALS['TL_DCA']['tl_module']['fields']['showcase'] = [
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['showcase'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'select',
    'foreignKey'              => 'tl_showcase.title',
    'eval'                    => ['chosen' => true,],
    'sql'                     => "int(10) unsigned NOT NULL default ='0'",
    'relation'                => ['type'=>'hasOne', 'load'=>'eager'],
];

$GLOBALS['TL_DCA']['tl_module']['palettes']['showcase_overview'] = '{type_legend},type,headline;{content_legend},showcase;{image_legend},imgSize;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_module']['palettes']['showcase_detail'] = '{type_legend},type,headline;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible,start,stop';
