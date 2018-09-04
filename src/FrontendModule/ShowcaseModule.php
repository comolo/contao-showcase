<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 04.09.18
 * Time: 16:39
 */

namespace Comolo\ShowcaseBundle\FrontendModule;

use Comolo\ShowcaseBundle\Model\ShowcaseEntryModel;
use Module;
use Environment;

abstract class ShowcaseModule extends Module
{
    protected function getShowcaseContents(ShowcaseEntryModel $showcase)
    {
        return \ContentModel::findBy(
            ['ptable=?', 'pid=?'],
            ['tl_showcase_entry', $showcase->id]
        );
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
