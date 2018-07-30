<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 30.07.18
 * Time: 17:15
 */

namespace Comolo\ShowcaseBundle\FrontendModule;

use Comolo\ShowcaseBundle\Model\ShowcaseCategoryModel;
use Module;
use Environment;

/**
 * Class ShowcaseDetail
 * @package Comolo\ShowcaseBundle\FrontendModule
 */
class ShowcaseDetail extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_showcase_detail';

    /**
     * Generate the frontend output
     */
    protected function compile()
    {
        // Backend mode
        if (TL_MODE == 'BE') {
            return $this->compileBackend('### Showcase Detail ###');
        }
    }

    /**
     * Compile backend template
     * @param $text
     */
    public function compileBackend($text)
    {
        $this->strTemplate          = 'be_wildcard';
        $this->Template             = new \BackendTemplate($this->strTemplate);
        $this->Template->title      = $this->headline;
        $this->Template->wildcard   = $text;
    }
}
