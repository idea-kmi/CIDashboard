<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2015 The Open University UK                                   *
 *                                                                              *
 *  This software is freely distributed in accordance with                      *
 *  the GNU Lesser General Public (LGPL) license, version 3 or later            *
 *  as published by the Free Software Foundation.                               *
 *  For details see LGPL: http://www.fsf.org/licensing/licenses/lgpl.html       *
 *               and GPL: http://www.fsf.org/licensing/licenses/gpl-3.0.html    *
 *                                                                              *
 *  This software is provided by the copyright holders and contributors "as is" *
 *  and any express or implied warranties, including, but not limited to, the   *
 *  implied warranties of merchantability and fitness for a particular purpose  *
 *  are disclaimed. In no event shall the copyright owner or contributors be    *
 *  liable for any direct, indirect, incidental, special, exemplary, or         *
 *  consequential damages (including, but not limited to, procurement of        *
 *  substitute goods or services; loss of use, data, or profits; or business    *
 *  interruption) however caused and on any theory of liability, whether in     *
 *  contract, strict liability, or tort (including negligence or otherwise)     *
 *  arising in any way out of the use of this software, even if advised of the  *
 *  possibility of such damage.                                                 *
 *                                                                              *
 ********************************************************************************/
/**
 * filelocationmanager.php
 *
 * Michelle Bachler (KMi)
 *
 * Manages accessing styles, images and pages, through the theme or custom or default locations.
 */

///////////////////////////////////////
// FileLocationManager Class
///////////////////////////////////////

class FileLocationManager {

	private $DEFAULTTHEME = 'default';
	private $themefolder = '';

	/**
	 * Constructor
 	 *
	 * @return FileLocationManager (this)
	 */
	function FileLocationManager($theme = "") {
		$this->themefolder = $theme;
	}

	function setTheme($theme = "") {
		$this->themefolder = $theme;
	}

	/**
	 * Return the full path for the image file name passed.
	 * If the image is in a subfolder, the subfolder name should be included in the filename.
	 *
	 * $filename, the filename of the image to return the path for. (include any subfolder name, e.g. 'nodetypes/Default/challenge.png')
	 * returns a web path
	 */
	function getImagePath($filename) {
		global $CFG;
		$path = $filename;

		// strip 'images/' from the front if it is there
		if (substr($path, 0, 7) == "images/") {
			$path = substr($path, 7);
		}

		// BASE DEFAULT THEME
		if (file_exists($CFG->dirAddress.'theme/'.$this->DEFAULTTHEME.'/images/'.$filename)) {
			$path = $CFG->homeAddress.'theme/'.$this->DEFAULTTHEME.'/images/'.$filename;

		// BASE IMAGES FOLDER
		} else if (file_exists($CFG->dirAddress.'images/'.$filename)) {
			$path = $CFG->homeAddress.'images/'.$filename;
		}

		return $path;
	}

	/**
	 * Return the path for the image file name passed relative to site main folder.
	 * If the image is in a subfolder, the subfolder name should be included in the filename.
	 *
	 * $filename, the filename of the image to return the relative path for. (include any subfolder name, e.g. 'nodetypes/Default/challenge.png')
	 * returns a web path
	 */
	function getRelativeImagePath($filename) {
		global $CFG;
		$path = $filename;

		// strip 'images/' from the front if it is there
		if (substr($path, 0, 7) == "images/") {
			$path = substr($path, 7);
		}

		// BASE DEFAULT THEME
		if (file_exists($CFG->dirAddress.'theme/'.$this->DEFAULTTHEME.'/images/'.$path)) {
			$path = 'theme/'.$this->DEFAULTTHEME.'/images/'.$path;

		// BASE IMAGES FOLDER
		} else if (file_exists($CFG->dirAddress.'images/'.$path)) {
			$path = 'images/'.$path;
		}

		return $path;
	}


	/**
	 * Return the full path for the help image file name passed.
	 * If the image is in a subfolder, the subfolder name should be included in the filename.
	 *
	 * $filename, the filename of the image to return the path for. (include any subfolder name, e.g. 'nodetypes/Default/challenge.png')
	 * returns a web path
	 */
	function getHelpImagePath($filename) {
		global $CFG;
		$path = $filename;

		// BASE DEFAULT THEME
		if (file_exists($CFG->dirAddress.'theme/'.$this->DEFAULTTHEME.'/images/'.$filename)) {
			$path = $CFG->homeAddress.'theme/'.$this->DEFAULTTHEME.'/images/'.$filename;

		// BASE HELP IMAGES FOLDER
		} else if (file_exists($CFG->dirAddress.'help/images/'.$filename)) {
			$path = $CFG->homeAddress.'help/images/'.$filename;
		}

		return $path;
	}

	/**
	 * Return the full path for the stylesheet file name passed.
	 *
	 * $filename the filename of the stylesheet to return the path for.
	 * returns a web path
	 */
	function getStylePath($filename) {
		global $CFG;
		$path = $CFG->homeAddress.'theme/'.$this->DEFAULTTHEME.'/styles/'.$filename;
		return $path;
	}

	/**
	 * Return the full web address path for the code file name passed.
	 * Check is there is a local customization for the given file.
	 * If so return the path to the local file instead or the default file.
	 *
	 * $file, the default file path of the code file to return the path for.
	 * This is the full path and filename as would be used in a script statement.
	 * returns a path to the Custom file if found else returns the passed path.
	 */
	function getCodeWebPath($file) {
		global $CFG;
		$path = $CFG->homeAddress.$file;
		return $path;
	}

	/**
	 * Return the full directory path for the code file name passed.
	 * Check is there is a local customization for the given file.
	 * If so return the path to the local file instead or the default file.
	 *
	 * $file, the default file path of the code file to return the path for.
	 * This is the full path and filename as would be used in an include statement.
	 * returns a path to the Custom file if found else returns the passed path.
	 */
	function getCodeDirPath($file) {
		global $CFG;
		$path = $CFG->dirAddress.$file;
		return $path;
	}

	function getEmbedLib() {
		global $HUB_CACHE;
		if (isset($HUB_CACHE)) {
			return $this->getCodeDirPath("core/embedlib.php");
		} else {
			return $this->getCodeDirPath("core/embedlibnocache.php");
		}
	}
}