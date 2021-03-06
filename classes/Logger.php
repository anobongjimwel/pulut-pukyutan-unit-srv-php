<?php
    namespace pulut {
        use Exception;
        class Logger
        {
            /*
             * Initialize Logger Class
             */
            function __construct()
            {

            }

            /**
             * Slightly modified version of http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
             * @author Torleif Berger, Lorenzo Stanco
             * @link http://stackoverflow.com/a/15025877/995958
             * @license http://creativecommons.org/licenses/by/3.0/
             */
            function tailReader($filepath, $lines = 1, $adaptive = true)
            {
                // Open file
                $f = @fopen($filepath, "rb");
                if ($f === false) return false;
                // Sets buffer size, according to the number of lines to retrieve.
                // This gives a performance boost when reading a few lines from the file.
                if (!$adaptive) $buffer = 4096;
                else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
                // Jump to last character
                fseek($f, -1, SEEK_END);
                // Read it and adjust line number if necessary
                // (Otherwise the result would be wrong if file doesn't end with a blank line)
                if (fread($f, 1) != "\n") $lines -= 1;

                // Start reading
                $output = '';
                $chunk = '';
                // While we would like more
                while (ftell($f) > 0 && $lines >= 0) {
                    // Figure out how far back we should jump
                    $seek = min(ftell($f), $buffer);
                    // Do the jump (backwards, relative to where we are)
                    fseek($f, -$seek, SEEK_CUR);
                    // Read a chunk and prepend it to our output
                    $output = ($chunk = fread($f, $seek)) . $output;
                    // Jump back to where we started reading
                    fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
                    // Decrease our line counter
                    $lines -= substr_count($chunk, "\n");
                }
                // While we have too many lines
                // (Because of buffer size we might have read too many)
                while ($lines++ < 0) {
                    // Find first newline and remove all text before that
                    $output = substr($output, strpos($output, "\n") + 1);
                }
                // Close file and return
                fclose($f);
                return trim($output);
            }

            function genLogger($log_msg)
            {
                $date = "[" . date("M d Y, H: i") . "] ";
                $log_filename = $_SERVER['DOCUMENT_ROOT']."/logs";
                if (!file_exists($log_filename))
                {
                    // create directory/folder uploads.
                    mkdir($log_filename, 0777, true);
                }
                $log_file_data = $log_filename.'/log_' . date("mdY") . '.log';
                file_put_contents($log_file_data, $date . $log_msg . "\n", FILE_APPEND);
            }

            function bioLogger($log_msg)
            {
                $date = "[" . date("M d Y, H: i") . "] ";
                $log_filename = $_SERVER['DOCUMENT_ROOT']."/logs/biodegradeable";
                if (!file_exists($log_filename))
                {
                    // create directory/folder uploads.
                    mkdir($log_filename, 0777, true);
                }
                $log_file_data = $log_filename.'/log_' . date("mdY") . '.log';
                file_put_contents($log_file_data, $date . $log_msg . "\n", FILE_APPEND);
            }

            function nonLogger($log_msg)
            {
                $date = "[" . date("M d Y, H: i") . "] ";
                $log_filename = $_SERVER['DOCUMENT_ROOT']."/logs/nonbiodegradeable";
                if (!file_exists($log_filename))
                {
                    // create directory/folder uploads.
                    mkdir($log_filename, 0777, true);
                }
                $log_file_data = $log_filename.'/log_' . date("mdY") . '.log';
                file_put_contents($log_file_data, $date . $log_msg . "\n", FILE_APPEND);
            }

            function unsLogger($log_msg)
            {
                $date = "[" . date("M d Y, H: i") . "] ";
                $log_filename = $_SERVER['DOCUMENT_ROOT']."/logs/unspecified";
                if (!file_exists($log_filename))
                {
                    // create directory/folder uploads.
                    mkdir($log_filename, 0777, true);
                }
                $log_file_data = $log_filename.'/log_' . date("mdY") . '.log';
                file_put_contents($log_file_data, $date . $log_msg . "\n", FILE_APPEND);
            }

            function countLines($file)
            {
                $linecount = 0;
                if (@fopen($file, "r") == false) {
                    return 0;
                } else {
                    @$handle = fopen($file, "r");
                    while (!feof($handle)) {
                        $line = fgets($handle);
                        $linecount++;
                    }
                    fclose($handle);

                    return $linecount - 1;
                }
            }

            function messageLogger($log_msg)
            {
                $date = "[" . date("M d Y, H: i") . "] ";
                $log_filename = $_SERVER['DOCUMENT_ROOT']."/logs/messages";
                if (!file_exists($log_filename))
                {
                    // create directory/folder uploads.
                    mkdir($log_filename, 0777, true);
                }
                $log_file_data = $log_filename.'/log_' . date("mdY") . '.log';
                file_put_contents($log_file_data, $date . $log_msg . "\n", FILE_APPEND);
            }
        }
    }