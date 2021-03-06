<?php
/**
 * Wordspop Framework
 *
 * @category   Wordspop
 * @package    WPop_Utils
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 * @version    $Id:$
 */
 
/**
 * @category   Wordspop
 * @package    WPop_Utils
 * @copyright  Copyright (c) 2010-2011 Wordspop
 * @license    http://www.opensource.org/licenses/gpl-2.0.php GNU GPL version 2
 */
class WPop_Utils
{
    /**
     * Get the list of files in directory
     *
     * @param   string  $dir string Directory
     * @param   array   $extension  Only file with these extensions
     * @return  array   List of files
     * @access  public
     * @static
     */
    function getFiles($dir, $extensions = array())
    {
        if (!is_dir($dir)) {
            return false;
        }

        if (!is_readable($dir)) {
            return false;
        }

        $files = array();
        $dh = dir($dir);
        while (false !== ($entry = $dh->read())) {
            if ($entry != '.' && $entry != '..') {
                if (!empty($extensions) && !in_array(self::getFileExtension($entry), $extensions)) {
                    continue;
                }

                $files[] = $dir . DIRECTORY_SEPARATOR . $entry;
            }
        }

        $dh->close();

        return $files;
    }

    /**
     * Get file extension
     *
     * @param   string  $filename Filename
     * @return  string  File extension
     * @access  public
     * @static
     */
    function getFileExtension($filename)
    {
        $filename = basename($filename);
        return strtolower(substr($filename, strrpos($filename, '.') + 1));
    }

    /**
     * Subtitute a string into formatted id
     *
     * @param   string  $string     A string
     * @param   string  $separator  Separator replacemet
     * @return  string  Formatted string
     * @access  public
     * @static
     */
    function idtify($string, $separator = '_')
    {
        return rtrim(strtolower(preg_replace('/[^a-z0-9%_\-]+/i', $separator, $string)),$separator);
    }

    /**
     * Find out whether attachement exists or not
     *
     * @param   string  $filename  An absolute path or an URL of filename.
     * @return  bool
     * @access  public
     * @static
     */
    function attachmentExists($filename)
    {
        // Find the whether the filename parameter is an absolute path or an url.
        if (preg_match('%(http|https):\/\/.+\/(files|uploads)\/(\d{4})\/(\d{2})\/(.+)%', $filename, $matches) == 1) {
            // Translate the url to absolute path agains WP rules
            if ($matches[2] == 'files') { // Network enabled and file on the sub site.
                global $blog_id;
                
                $filename = WP_CONTENT_DIR . DS . 'blogs.dir' . DS . $blog_id . DS . 'files' . DS . $matches[3] . DS . $matches[4] . DS . $matches[5];
            } else { // File in main site.
                // Unset unnecessary elements
                unset($matches[0]);
                unset($matches[1]);
                
                // Prepend content directory to the beginning of array
                array_unshift($matches, WP_CONTENT_DIR);
                $filename = implode(DS, $matches);
            }
        }
        
        return file_exists($filename);
    }
}
