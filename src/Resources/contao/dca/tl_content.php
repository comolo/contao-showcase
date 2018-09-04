<?php
/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

// Dynamically add the permission check and parent table
if (Input::get('do') == 'showcase')
{
    $GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_showcase_entry';
    // TODO $GLOBALS['TL_DCA']['tl_content']['list']['operations']['toggle']['button_callback'] = array('tl_content_showcase', 'toggleIcon');
}
