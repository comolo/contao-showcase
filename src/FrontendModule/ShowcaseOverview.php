<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 30.07.18
 * Time: 17:15
 */

namespace Comolo\ShowcaseBundle\FrontendModule;

use Comolo\ShowcaseBundle\Model\ShowcaseEntryModel;
use Module;
use Comolo\ShowcaseBundle\Model\ShowcaseCategoryModel;
use Environment;

class ShowcaseOverview extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_showcase';

    /**
     * Generate the frontend output
     */
    protected function compile()
    {
        // Backend mode
        if (TL_MODE == 'BE') {
            return $this->compileBackend('### Showcase Overview ###');
        }

        // Add isotope JS library
        $GLOBALS['TL_JAVASCRIPT'][] = Environment::get('path').'/bundles/comoloshowcase/js/isotope.pkgd.min.js|static';
        $GLOBALS['TL_JAVASCRIPT'][] = Environment::get('path').'/bundles/comoloshowcase/js/isotope-script.js|static';

        $this->Template->categories = ShowcaseCategoryModel::findBy('pid', $this->showcase, ['order' => 'sorting ASC']);
        $this->Template->showcases = $this->getShowcases();
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

    protected function getShowcases()
    {
        $showcases = ShowcaseEntryModel::findBy('pid', $this->showcase, ['order' => 'id ASC']);

        /*
        foreach ($showcases as $showcase)
        {
            $categories = unserialize($showcase->categories);

            foreach ($categories as $category) {
                $showcase->cssClass .= $category;
            }
        }
        */

        return $showcases;
    }


}
