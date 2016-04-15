<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


$GLOBALS['TL_DCA']['tl_content']['fields']['url']['load_callback'][] = array('FilepickerUuid', 'loadCallback');
$GLOBALS['TL_DCA']['tl_content']['fields']['url']['save_callback'][] = array('FilepickerUuid', 'saveCallback');
