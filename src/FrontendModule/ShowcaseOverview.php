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

class ShowcaseOverview extends ShowcaseModule
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_showcase';

    /**
     * Template
     * @var string
     */
    protected $strShowcaseEntryTemplate = 'mod_showcase_entry';

    /**
     * Generate the frontend output
     */
    protected function compile()
    {
        // Backend mode
        if (TL_MODE == 'BE') {
            return $this->compileBackend('### Showcase Overview ###');
        }

        // Add folder navigation
        \Input::setGet('showcase', \Input::get('showcase'));

        // Add isotope JS library
        $GLOBALS['TL_JAVASCRIPT'][] = Environment::get('path').'/bundles/comoloshowcase/js/isotope.pkgd.min.js|static';
        $GLOBALS['TL_JAVASCRIPT'][] = Environment::get('path').'/bundles/comoloshowcase/js/isotope-script.js|static';

        $this->Template->categories = ShowcaseCategoryModel::findBy('pid', $this->showcase, ['order' => 'sorting ASC']);
        $this->Template->strShowcases = $this->parseShowcases();
    }

    protected function parseShowcases()
    {
        $showcases = ShowcaseEntryModel::findPublishedByPid($this->showcase, null, null, ['order' => 'id ASC']);
        $strOutput = '';

        foreach ($showcases as $showcase)
        {
            $strOutput .= $this->parseShowcase($showcase);
        }

        return $strOutput;
    }

    protected function parseShowcase(ShowcaseEntryModel $showcase)
    {
        $objTemplate = new \FrontendTemplate($this->strShowcaseEntryTemplate);
        $objTemplate->setData($showcase->row());

        // Generate CSS Classes
        $categories = unserialize($showcase->categories);
        foreach ($categories as $category) {
            $objTemplate->cssClass .= ' cat-'.$category;
        }

        // Add Link
        if ($showcase->addUrl == '1') {
            $objTemplate->hasLink = true;

            $objTemplate->link = $this->parseLink($showcase->url);

            if ($showcase->target == '1') {
                $objTemplate->linkCss = '';
                $objTemplate->linkTarget = '_blank';
            } else {
                $objTemplate->linkCss = 'showcase-lightbox';
                $objTemplate->linkTarget = '_self';
            }
        }

        // Add content
        if (count($this->getShowcaseContents($showcase)) > 0) {
            $objTemplate->hasLink = true;
            $objTemplate->link = $this->generateShowcaseUrl($showcase);

            $objTemplate->linkCss = '';
            $objTemplate->linkTarget = '_self';
        }

        // Add Image
        $showcase->addImage = false;

        if ($showcase->thumbnail != '')
        {
            $objModel = \FilesModel::findByUuid($showcase->thumbnail);
            if ($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path))
            {
                // Do not override the field now that we have a model registry (see #6303)
                $arrShowcase = $showcase->row();
                // Override the default image size
                if ($this->imgSize != '')
                {
                    $size = \StringUtil::deserialize($this->imgSize);
                    if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2]))
                    {
                        $arrShowcase['size'] = $this->imgSize;
                    }
                }
                $arrShowcase['singleSRC'] = $objModel->path;
                $this->addImageToTemplate($objTemplate, $arrShowcase, null, null, $objModel);

                // Link to the news article if no image link has been defined (see #30)
                // Todo: check if is is working
                if (!$objTemplate->fullsize && !$objTemplate->imageUrl)
                {
                    // Unset the image title attribute
                    $picture = $objTemplate->picture;
                    unset($picture['title']);
                    $objTemplate->picture = $picture;
                    // Link to the news article
                    $objTemplate->href = $objTemplate->link;
                    $objTemplate->linkTitle = \StringUtil::specialchars(sprintf($GLOBALS['TL_LANG']['MSC']['readMore'], $showcase->headline), true);
                }
            }
        }


        return $objTemplate->parse();
    }

    protected function parseLink($strLink)
    {
        // Rewrite youtube links
        if (strpos($strLink, 'https://www.youtube.com/watch') !== false) {
            $strLink = str_replace('&#61;', '=', $strLink);
            parse_str( parse_url(htmlspecialchars_decode($strLink), PHP_URL_QUERY ), $youtubeParams);
            $youtubeId = $youtubeParams['v'];

            return sprintf('https://www.youtube.com/embed/%s?rel=0&wmode=transparent&autoplay=1', $youtubeId);
        }

        return $strLink;
    }
}
