<?php

/*
 * Single Co
 */
return [
    'app'   =>  [
        'name' => 'SingleLte',
        'route-prefix' => 'dashboard',
        'filesystem-disk' => 'local',
    ],
    'top-bar'=>[
        'user-links-items'=>[
//            'dashboard'=>[
//                [
//                    'title' => 'dashboard.logout',
//                    'route' => 'dashboard.logout',
//                    'icon-class' => 'fa-solid fa-power-off'
//                ],
//            ]
        ],
        'user-links-view' => 'single::layout.user-top-bar-links',
    ],
    'menu' => [
        'view' => 'single::layout.menu',
        'items' => [
//            'dashboard'=>[
//                [
//                    'title' => 'dashboard.home',
//                    'route' => 'dashboard.home',
//                    'icon-class' => 'fa-solid fa-house'
//                ], # an example of menu item
//            ]
        ]
    ]
];
