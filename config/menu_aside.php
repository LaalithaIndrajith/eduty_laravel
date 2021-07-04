<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'System Administration',
        ],
        [
            'title' => 'Masters',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Users',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'User Creation',
                            'page' => '/viewRegisterUser',
                        ],
                        [
                            'title' => 'User List',
                            'page' => '/viewUserList'
                        ],
                    ]
                ],
            ]
        ],
        [
            'title' => 'Configurations',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Access & Permissions',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'User Types',
                            'page' => '/viewUserType',
                        ],
                        [
                            'title' => 'Permissions',
                            'page' => '/viewPermission'
                        ],
                    ]
                ],
            ]
        ],
        [
            'section' => 'Jobs',
        ],
        [
            'section' => 'Reports',
        ],
       
       
    ]

];
