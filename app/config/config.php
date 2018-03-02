<?php
/**
 * Copyright (c) 2017 AvikB, some rights reserved.
 *  Copyright under Creative Commons Attribution-ShareAlike 3.0 Unported,
 *  for details visit: https://creativecommons.org/licenses/by-sa/3.0/
 *
 * @Contributors:
 * Created by AvikB for noncommercial MusicBee project.
 *  Spelling mistakes and fixes from community members.
 *
 */


use App\Lib\ForumHook;

/**
 * Get all the website settings or get setting by key
 *
 * @param null $settingName array key
 *
 * @return mixed
 */
function setting($settingName = null)
{
    $setting['default-lang']    = 'en_US';
    $setting['charset']         = 'utf-8';
    $setting['version']         = '1.9.5';
    $setting['show_warning']    = false;
    $setting['is_test']         = true;
    $setting['github_link' ]    = 'https://github.com/Avik-B/musicbee-website';

    if (!empty($settingName)) {
        if (!empty($setting[$settingName])) {
            return $setting[$settingName];
        }
    }
    return $setting;
}


/**
 * Get the current user data
 *
 * @return array
 */
function getUserData() : array
{
    return ForumHook::getUserData();
}


function errorCode($errorName = null)
{
    $errorCode = [
        'ADMIN_ACCESS'      => '101',
        'LOGIN_MUST'        => '102',
        'FORUM_INTEGRATION' => '103',
        'NOT_FOUND'         => '104',
        'NO_DIRECT_ACCESS'  => '105',
        'MOD_ACCESS'        => '106',
    ];

    if (!empty($errorName)) {
        if (!empty($errorCode[$errorName])) {
            return $errorCode[$errorName];
        }
    }

    return $errorCode;
}
