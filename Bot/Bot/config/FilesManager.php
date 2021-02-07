<?php


namespace Bot\config;


include_once 'Bot/config/File.php';
include_once 'Bot/config/Utils.php';

class FilesManager
{

    // FILES :

    private static $basedFile;
    private static $toxicFile;
    private static $niggerFile;

    public function __construct()
    {
        self::$basedFile = new File(Utils::getPath() . "basedFile.json", File::JSON);
        self::$toxicFile = new File(Utils::getPath() . "toxicFile.json", File::JSON);
        self::$niggerFile = new File(Utils::getPath() . "niggerFile.json", File::JSON);
    }

    // Based functions :

    /**
     * @param $id, To give a user based points !
     */

    public static function setBased($id) : void {

        $file = self::getBasedFile();
        $file->set($id, (int)$file->get($id) + 1); $file->save();

    }

    /**
     * @param $id
     * @return int, You can get the based points of a user by their id !
     */

    public static function getBased($id) : int {

        $file = self::getBasedFile();
        return (int)$file->get($id);

    }

    // Nigga functions :

    /**
     * @param $id, To give a user nigga count !
     */

    public static function setNigga($id) : void {

        $file = self::getNiggerFile();
        $file->set($id, (int)$file->get($id) + 1); $file->save();

    }

    /**
     * @param $id
     * @return int, You can get amount of times a user said nigga by their id !
     */

    public static function getNigga($id) : int {

        $file = self::getNiggerFile();
        return (int)$file->get($id);

    }

    /**
     * @param $id, To give a user toxic count !
     */

    public static function setToxic($id) : void {

        $file = self::getToxicFile();
        $file->set($id, (int)$file->get($id) + 1); $file->save();

    }

    /**
     * @param $id
     * @return int, You can get amount of times a user said toxic by their id !
     */

    public static function getToxic($id) : int {

        $file = self::getToxicFile();
        return (int)$file->get($id);

    }

    // Files returns :

    /**
     * @return File
     */
    public static function getBasedFile(): File
    {
        return self::$basedFile;
    }

    /**
     * @return File
     */
    public static function getToxicFile(): File
    {
        return self::$toxicFile;
    }

    /**
     * @return File
     */
    public static function getNiggerFile(): File
    {
        return self::$niggerFile;
    }

}