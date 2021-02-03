<?php


namespace Bot\config;


class Config
{

    // COLORS :

    const PINK = 0;
    const GRAY = 1;
    const YELLOW = 2;
    const RED = 3;
    const GREEN = 4;

    // Logs channel :

    public static function getLogsChannel() : string {
        return "776186189509296128";
    }

    // Color picker :

    public static function getColor($color) : string {
        return ["#f4c8c7", "#b4cbd9", "#e6ba34", "#C80000", "#3AA33A"][(int)$color];
    }

}