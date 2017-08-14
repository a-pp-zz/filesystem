<?php
/**
 * Filesystem helpers
 */
namespace AppZz\Helpers;

/**
 * Class Filesystem
 * @package AppZz\Helpers
 */
class Filesystem {

	/**
	 * check filename for existince and add prefix or suffix if exists
	 * @param  string $filename
	 * @param  string $prefix
	 * @param  string $suffix
	 * @return string
	 */
	public static function check_filename ($filename, $prefix = '_', $suffix = '')
	{
		if ( !file_exists ($filename) AND file_exists ( dirname ($filename)))
		{
			return $filename;
		}
		else
		{
			$dir  = pathinfo ($filename, PATHINFO_DIRNAME);
			$name = pathinfo ($filename, PATHINFO_FILENAME);
			$ext  = pathinfo ($filename, PATHINFO_EXTENSION);
			$inc  = 0;

			while (file_exists ($filename)) :
				$filename = $dir . DIRECTORY_SEPARATOR . $name . $prefix . ++$inc . $suffix . '.' . $ext;
			endwhile;

			return $filename;
		}
	}

	/**
	 * set new extension to file
	 * @param  string $filename
	 * @param  string $ext
	 * @return string
	 */
	public static function new_extension ($filename, $ext)
	{
		$name = pathinfo ($filename, PATHINFO_FILENAME);
		$dir  = pathinfo ($filename, PATHINFO_DIRNAME);
		$path = $dir ? $dir . DIRECTORY_SEPARATOR : '';
		return $path . $name . '.' . $ext;
	}

	/**
	 * add prefix to file
	 * @param string $filename
	 * @param string $prefix
	 * @return string
	 */
	public static function add_prefix ($filename, $prefix = '')
	{
		$name = pathinfo ($filename, PATHINFO_FILENAME);
		$ext  = pathinfo ($filename, PATHINFO_EXTENSION);
		$dir  = pathinfo ($filename, PATHINFO_DIRNAME);
		$path = $dir ? $dir . DIRECTORY_SEPARATOR : '';
		return $path . $name . $prefix . '.' . $ext;
	}

	/**
	 * create_folder_by_date
	 * @param  string  $parent_folder
	 * @param  string  $fmt
	 * @param  integer $chmod
	 * @return mixed
	 */
	public static function create_folder_by_date ($parent_folder, $fmt = 'Y/m/d', $chmod = 0755)
	{
		$dir = $parent_folder . DIRECTORY_SEPARATOR . date ($fmt);

		if ( ! file_exists ($dir) AND is_writable ($parent_folder)) {
			mkdir ($dir, $chmod, TRUE);
		}

		return file_exists ($dir) ? $dir : FALSE;
	}
}
