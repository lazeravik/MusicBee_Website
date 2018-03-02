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

function menu()
{
    global $lang;
    $link = path();
    $menu = [
        'dashboard' => [
            'title' => $lang['dashboard'],
            'href' => $link['addon']['dashboard'],
            'restriction' => 'login',
            'sub_menu' => [],
        ],
        'member-panel' => [
            'title' => '<img src="' . getUserData()['user']['avatar'] . '" class="user_avatar" />',
            'href' => $link['forum'] . '?action=profile',
            'restriction' => 'login',
            'sub_menu' => [
                'user-profile' => [
                    'title' => '' . sprintf($lang['hey_username'], getUserData()['user']['name']) . '',
                    'href' => $link['forum'] . '?action=profile',
                ],
                'line1' => ['title' => "<hr class=\"line\"/>",],
                'admin-panel' => [
                    'title' => $lang['web_admin'],
                    'href' => $link['addon']['dashboard'] . '#admin_setting',
                    'icon' => "<i class=\"fa fa-desktop\"></i>",
                    'restriction' => 'admin',
                ],
                'forum-admin' => [
                    'title' => $lang['forum_admin'],
                    'href' => $link['admin']['forum-panel'],
                    'icon' => "<i class=\"fa fa-comments\"></i>",
                    'restriction' => 'admin',
                ],
                'line2' => ['title' => "<hr class=\"line\"/>",],
                'sign-out' => [
                    'title' => $lang['sign_out'],
                    'href' => $link['logout'],
                    'icon' => "<i class=\"fa fa-sign-out\"></i>",
                ],
            ],
        ],
        'download' => [
            'title' => $lang['download'],
            'href' => $link['download'],
            'sub_menu' => [],
        ],
        'add-ons' => [
            'title' => $lang['addons'],
            'href' => $link['addon']['home'],
            'sub_menu' => [
                '1' => [
                    'title' => $lang['skins'],
                    'href' => $link['addon']['home'] . "s/?type=1",
                    'icon' => "<i class=\"fa fa-paint-brush\"></i>",
                    'desc' => $lang['skin_description'],
                    'id' => 1,
                ],
                '2' => [
                    'title' => $lang['plugins'],
                    'href' => $link['addon']['home'] . "s/?type=2",
                    'icon' => "<i class=\"fa fa-plug\"></i>",
                    'desc' => $lang['plugin_description'],
                    'id' => 2,
                ],
                '3' => [
                    'title' => $lang['visualizer'],
                    'href' => $link['addon']['home'] . "s/?type=3",
                    'icon' => "<i class=\"fa fa-bar-chart\"></i>",
                    'desc' => $lang['visualizer_description'],
                    'id' => 3,
                ],
                '4' => [
                    'title' => $lang['theater_mode'],
                    'href' => $link['addon']['home'] . "s/?type=4",
                    'icon' => "<i class=\"fa fa-arrows-alt\"></i>",
                    'desc' => $lang['theater_description'],
                    'id' => 4,
                ],
                '5' => [
                    'title' => $lang['misc'],
                    'href' => $link['addon']['home'] . "s/?type=5",
                    'icon' => "<i class=\"fa fa-ellipsis-h\"></i>",
                    'desc' => $lang['misc_description'],
                    'id' => 5,
                ],
            ],
        ],
        'forum' => [
            'title' => $lang['forum'],
            'href' => $link['forum'],
            'sub_menu' => [],
        ],
        'help' => [
            'title' => $lang['help'],
            'href' => $link['help'],
            'sub_menu' => [
                'faq' => [
                    'title' => $lang['faq'],
                    'href' => $link['help'],
                    'icon' => "<i class=\"fa fa-question\"></i>",
                ],
                'api' => [
                    'title' => $lang['dev_api'],
                    'href' => $link['api'],
                    'icon' => "<i class=\"fa fa-code\"></i>",
                ],
                'line2' => ['title' => "<hr class=\"line\"/>",],
                'release-note' => [
                    'title' => $lang['releasenote'],
                    'href' => $link['release-note'],
                    'icon' => "<i class=\"fa fa-sticky-note-o\"></i>",
                ],
                'press' => [
                    'title' => $lang['press'],
                    'href' => $link['press'],
                    'icon' => "<i class=\"fa fa-bullhorn\"></i>",
                ],
                'line3' => ['title' => "<hr class=\"line\"/>",],
                'bug' => [
                    'title' => $lang['report_bug'],
                    'href' => $link['bugreport'],
                    'icon' => "<i class=\"fa fa-bug\"></i>",
                    'hide' => true,
                ],
                'wiki' => [
                    'title' => $lang['mb_wiki'],
                    'href' => !empty($link['wiki']) ?: null,
                    'icon' => "<i class=\"fa fa-wikipedia-w\"></i>",
                    'target' => '_blank',
                    'hide' => true,
                ],
            ],
        ],
    ];

    return $menu;
}


