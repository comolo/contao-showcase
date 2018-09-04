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

$GLOBALS['TL_DCA']['tl_module']['palettes']['showcase_overview'] = '{title_legend},name,headline,type;{config_legend},showcase,jumpTo;{image_legend},imgSize;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
$GLOBALS['TL_DCA']['tl_module']['palettes']['showcase_detail'] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';
