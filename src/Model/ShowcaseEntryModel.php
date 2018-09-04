<?php
/**
 * Created by PhpStorm.
 * User: hendrik
 * Date: 27.07.18
 * Time: 14:22
 */

namespace Comolo\ShowcaseBundle\Model;

class ShowcaseEntryModel extends \Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_showcase_entry';

    public static function findPublishedByIdOrAlias($varId, array $arrOptions=array())
    {
        $t = static::$strTable;

        $arrColumns = !is_numeric($varId) ? array("$t.alias=?") : array("$t.id=?");

        if (!static::isPreviewMode($arrOptions))
        {
            $time = \Date::floorToMinute();
            $arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published='1'";
        }

        return static::findOneBy($arrColumns, $varId, $arrOptions);
    }

    public static function findPublishedByPid($pid, $intLimit=0, $intOffset=0, array $arrOptions=array())
    {
        if (empty($pid) || !\is_numeric($pid))
        {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = array("$t.pid = ".intval($pid));

        // Never return unpublished elements in the back end, so they don't end up in the RSS feed
        if (!BE_USER_LOGGED_IN || TL_MODE == 'BE')
        {
            $time = \Date::floorToMinute();
            $arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'" . ($time + 60) . "') AND $t.published='1'";
        }

        if (!isset($arrOptions['order']))
        {
            $arrOptions['order']  = "$t.date DESC";
        }

        $arrOptions['limit']  = $intLimit;
        $arrOptions['offset'] = $intOffset;
        return static::findBy($arrColumns, null, $arrOptions);
    }
}
