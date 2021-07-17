<?php
// Aside menu
return [

    'systemAdmin' => [
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
                [
                    'title' => 'Departments',
                    'bullet' => 'dot',
                    'page' => '/viewDepartmentList'
                ],
                [
                    'title' => 'Designations',
                    'bullet' => 'dot',
                    'page' => '/viewDesignationList'
                ]
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
                        [
                            'title' => 'Authorization',
                            'page' => '/viewAccessControl'
                        ],
                    ]
                ],
            ]
        ],
        [
            'title' => 'TaskFlows',
            'icon' => 'media/svg/icons/Code/Git4.svg',
            'bullet' => 'dot',
            'page' => '/viewTaskFlowList'
            
        ],
        
       
       
    ],
    'admin' =>[
        // Custom
        [
            'section' => 'Admin',
        ],
    ],
    'frontDesk' =>[
        // Custom
        [
            'section' => 'Front Desk',
        ],
    ],
    'other' =>[
        // Custom
        [
            'section' => 'Normal User',
        ],
    ],

];
