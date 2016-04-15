<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Helper class for UUID conversion.
 *
 * @author Fritz Michael Gschwantner <https://github.com/fritzmg>
 */
class FilepickerUuid extends \Controller
{

	/**
	 * Load callback for the DCA fields.
	 * Converts any file insert tag back to its path.
	 *
	 * @param mixed $varValue The loaded value
	 *
	 * @return string The processed value
	 */
	public function loadCallback( $varValue )
	{
		if( strncmp($varValue, '{{file::', 8) === 0 )
			$varValue = $this->replaceInsertTags( $varValue, false );
		return $varValue;
	}


	/**
	 * Save callback for the DCA fields.
	 * Converts any file path to a {{file::*}} insert tag.
	 *
	 * @param mixed $varValue The ipnut value
	 *
	 * @return string The processed value
	 */
	public function saveCallback( $varValue )
	{
		// search for the file
		if( ( $objFile = \FilesModel::findOneByPath( $varValue ) ) !== null )
		{
			// convert the uuid
			if( version_compare( VERSION . '.' . BUILD, '3.5.1', '<' ) )
				$uuid = \String::binToUuid( $objFile->uuid );
			else
				$uuid = \StringUtil::binToUuid( $objFile->uuid );

			// convert to insert tag
			$varValue = "{{file::$uuid}}";
		}

		// return the value
		return $varValue;
	}

}
