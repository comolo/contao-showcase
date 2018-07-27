<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 27.07.18
 * Time: 13:31
 */

namespace Comolo\ShowcaseBundle\DcaTable\Helper;

use Ausi\SlugGenerator\SlugGenerator;

trait AliasGenerator
{
    /**
     * Generate an alias
     *
     * @param $varValue
     * @param \DataContainer $dc
     * @return mixed
     */
    public function generateAlias($varValue, \DataContainer $dc)
    {
        // Generate an alias if there is none
        if ($varValue == '')
        {
            //TODO: use \System::getContainer()->get('contao.slug.generator')->generate
            $varValue =  (new SlugGenerator)->generate($dc->activeRecord->title);
        }

        return $varValue;
    }
}
