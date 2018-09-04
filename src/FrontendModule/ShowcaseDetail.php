<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 30.07.18
 * Time: 17:15
 */

namespace Comolo\ShowcaseBundle\FrontendModule;

use Comolo\ShowcaseBundle\Model\ShowcaseCategoryModel;
use Comolo\ShowcaseBundle\Model\ShowcaseEntryModel;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Module;
use Environment;

/**
 * Class ShowcaseDetail
 * @package Comolo\ShowcaseBundle\FrontendModule
 */
class ShowcaseDetail extends ShowcaseModule
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

        // Add folder navigation
        \Input::setGet('showcase', \Input::get('showcase'));

        /*
         * TODO: Allow empty pages
        if (empty(\Input::get('showcase'))) {
            return '';
        }
        */

        /** @var \PageModel $objPage */
        global $objPage;

        $this->Template->articles = '';
        $this->Template->referer = 'javascript:history.go(-1)';
        $this->Template->back = $GLOBALS['TL_LANG']['MSC']['goBack'];

        // Get the news item
        $showcase = ShowcaseEntryModel::findPublishedByIdOrAlias(\Input::get('showcase'));

        // The news item does not exist or has an external target (see #33)
        if (null === $showcase)
        {
            throw new PageNotFoundException('Page not found: ' . \Environment::get('uri'));
        }

        $contents = $this->getShowcaseContents($showcase);

        $strContentHtml = '';

        foreach ($contents as $content) {
            $strContentHtml .= \Controller::getContentElement($content->id);
        }

        $this->Template->content = $strContentHtml;

        // Overwrite the page title (see #2853 and #4955)
        if ($showcase->headline != '')
        {
            $objPage->pageTitle = strip_tags(\StringUtil::stripInsertTags($showcase->headline));
        }

        // Overwrite the page description
        if ($showcase->teaser != '')
        {
            $objPage->description = $this->prepareMetaDescription($showcase->teaser);
        }
    }
}
