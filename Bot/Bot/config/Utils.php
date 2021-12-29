<?php


namespace Bot\config;


class Utils
{

    // COLORS :

    const PINK = 0;
    const GRAY = 1;
    const YELLOW = 2;
    const RED = 3;
    const GREEN = 4;
    // https://iconarchive.com/show/small-n-flat-icons-by-paomedia/sign-question-icon.html

    /*
     * Utils functions :
     * Fancy stuff, strings and arrays functions...
     */

    /**
     * @return string
     */

    public static function getLogsChannel() : string {
        return "776186189509296128";
    }

    /**
     * @param $color
     * @return string
     */

    public static function getColor($color) : string {
        return ["#f4c8c7", "#b4cbd9", "#e6ba34", "#C80000", "#3AA33A"][(int)$color];
    }

    /**
     * @return string
     */

    public function getProfilePicture() : string {
        $pictures = [
            "https://cdn.discordapp.com/attachments/732798739269287966/806988299456872508/sketch-1612452076909.png",
            "https://cdn.discordapp.com/attachments/732798739269287966/806988299306270730/sketch-1612453076023.png",
            "https://cdn.discordapp.com/attachments/732798739269287966/806988298937040956/sketch-1612471166219.png",
            "https://cdn.discordapp.com/attachments/732798739269287966/806988299134435378/sketch-1612470967688.png"];
        return $pictures[array_rand($pictures)];
    }

    /**
     * @return string
     */

    public static function getPath() : string {
        return "db/";
    }

    /*
     * Strings functions :
     */

    public function startsWith2(string $message, $starts) {
        return ($message[(int)0] === $starts);
    }
    
    public static function stripSpace(string $string) : string{
        return preg_replace('/\s+/', '', $string);
    }

    public static function equals(string $a, string $b, bool $caseSensitive = true) : bool{
        return ($caseSensitive ? strcmp($a, $b) : strcasecmp($a, $b)) === 0;
    }

    public static function indexOf(string $haystack, string $needle, bool $caseSensitive = true) : int{
        $ret = ($caseSensitive ? strpos($haystack, $needle) : stripos($haystack, $needle));
        return $ret === false ? -1 : $ret;
    }

    public static function startsWith(string $haystack, string $needle, bool $caseSensitive = true) : bool{
        return $needle === "" || self::indexOf($haystack, $needle, $caseSensitive) === 0;
    }

    public static function endsWith(string $haystack, string $needle, bool $caseSensitive = true) : bool{
        return $needle === "" || self::equals(substr($haystack, -strlen($needle)), $needle, $caseSensitive);
    }

    public static function contains(string $haystack, string $needle, bool $caseSensitive = true) : bool{
        return $needle === "" || self::indexOf($haystack, $needle, $caseSensitive) !== -1;
    }

    public static function removeExtension(string $string) : string{
        return substr($string, 0, (strrpos($string, ".")));
    }

    /*
     * Array functions :
     */

}
