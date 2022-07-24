<?php
if (!function_exists('seoUrl')) {
    function seoUrl($string = null)
    {
        // Remove HTML Tags if found
        $string = strip_tags($string);
        // Replace special characters with white space
        $string = preg_replace('/[^A-Za-z0-9-]+/', ' ', $string);
        // Trim White Spaces and both sides
        $string = trim($string);
        // Replace whitespaces with Hyphen (-)
        $string = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        // Conver final string to lowercase
        $slug = strtolower($string);
        return $slug;
    }
    /**
     * Return unique file name
     */
    function set_unique_image_file_name_on_save($unique_param = '', $extension = '')
    {
        $unique_param .= '-----';
        return base64_encode($unique_param) . '.' . $extension;
    }
    /**
     * This is just for added http if not
     */
    function addhttpIfNot($_url = null)
    {
        if ($_url == null) {
            return null;
        }
        $url = ltrim($_url, "/");
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return isDomainAvailible($url) == true ? $url : null;
    }
    /**
     * Validate URL
     */
    // function validateUrl($theURL)
    // {
    //     if (!filter_var($theURL, FILTER_VALIDATE_URL) === false) {
    //         return $theURL;
    //     } else {
    //         return false;
    //     }
    // }
    function isDomainAvailible($domain)
    {
        //check, if a valid url is provided
        if (!filter_var($domain, FILTER_VALIDATE_URL)) {
            return false;
        }
        //initialize curl
        $curlInit = curl_init($domain);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
        //get answer
        $response = curl_exec($curlInit);
        curl_close($curlInit);
        if ($response) {
            return true;
        }

        return false;
    }
    // splited text to number of pages
    function SplitStringToParts($sourceInput, $splitTextByWordCounter = 20)
    {
        $arr_exploded = explode(" ", $sourceInput);
        $result = [];
        $initial = 0;
        for ($i = 0; $i < count($arr_exploded); $i++) {
            $arr_part1 = array_slice($arr_exploded, $initial, $splitTextByWordCounter);
            $initial += $splitTextByWordCounter;
            $splitedContent = implode(" ", $arr_part1);
            if ($splitedContent) {
                $result[] = $splitedContent;
            }
            if (strlen($splitedContent) == 0) {
                break;
            }
        }
        return $result;
    }
}
/**
 * Convert second to HH::MM::SS format
 */
function secondToHHMMSSFormat($seconds)
{
    $t = round($seconds);
    return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
}
