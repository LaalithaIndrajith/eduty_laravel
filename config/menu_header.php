<?php
// Header menu
return [

    'items' => [
        [],
        [
            'title' => 'Dashboard',
            'root' => true,
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'Features',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Bootstrap',
                        'desc' => '',
                        'icon' => 'media/svg/icons/Communication/Add-user.svg', // or can be 'flaticon-light' or any flaticon-*
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Utilities',
                                'page' => 'features/bootstrap/utilities'
                            ],
                            [
                                'title' => 'Typography',
                                'page' => 'features/bootstrap/typography'
                            ],
                            [
                                'title' => 'Buttons',
                                'page' => 'features/bootstrap/buttons'
                            ],
                            [
                                'title' => 'Button Group',
                                'page' => 'features/bootstrap/button-group'
                            ],
                            [
                                'title' => 'Dropdown',
                                'page' => 'features/bootstrap/dropdown'
                            ],
                            [
                                'title' => 'Navs',
                                'page' => 'features/bootstrap/navs'
                            ],
                            [
                                'title' => 'Tables',
                                'page' => 'features/bootstrap/tables'
                            ],
                            [
                                'title' => 'Progress',
                                'page' => 'features/bootstrap/progress'
                            ],
                            [
                                'title' => 'Modal',
                                'page' => 'features/bootstrap/modal'
                            ],
                            [
                                'title' => 'Alerts',
                                'page' => 'features/bootstrap/alerts'
                            ],
                            [
                                'title' => 'Popover',
                                'page' => 'features/bootstrap/popover'
                            ],
                            [
                                'title' => 'Tooltip',
                                'page' => 'features/bootstrap/tooltip'
                            ],
                        ]
                    ],
                    [
                        'title' => 'Custom',
                        'desc' => '',
                        'icon' => 'media/svg/icons/Files/Pictures1.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Utilities',
                                'page' => 'features/custom/utilities'
                            ],
                            [
                                'title' => 'Accordions',
                                'page' => 'features/custom/accordions'
                            ],
                            [
                                'title' => 'Label',
                                'page' => 'features/custom/labels'
                            ],
                            [
                                'title' => 'Line Tabs',
                                'page' => 'features/custom/line-tabs'
                            ],
                            [
                                'title' => 'Advance Navigations',
                                'page' => 'features/custom/advance-navs'
                            ],
                            [
                                'title' => 'Timeline',
                                'page' => 'features/custom/timeline'
                            ],
                            [
                                'title' => 'Pagination',
                                'page' => 'features/custom/pagination'
                            ],
                            [
                                'title' => 'Media',
                                'page' => 'features/custom/media'
                            ],
                            [
                                'title' => 'Spinners',
                                'page' => 'features/custom/spinners'
                            ],
                            [
                                'title' => 'Iconbox',
                                'page' => 'features/custom/iconbox'
                            ],
                            [
                                'title' => 'Callout',
                                'page' => 'features/custom/callout'
                            ],
                            [
                                'title' => 'Ribbons',
                                'page' => 'features/custom/ribbons'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Icons',
                        'desc' => '',
                        'icon' => 'media/svg/icons/Communication/Address-card.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Flaticon',
                                'page' => 'features/icons/flaticon'
                            ],
                            [
                                'title' => 'Fontawesome 5',
                                'page' => 'features/icons/fontawesome5'
                            ],
                            [
                                'title' => 'Lineawesome',
                                'page' => 'features/icons/lineawesome'
                            ],
                            [
                                'title' => 'Socicons',
                                'page' => 'features/icons/socicons'
                            ],
                            [
                                'title' => 'SVG Icons',
                                'page' => 'features/svg/icons'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Cards',
                        'desc' => '',
                        'icon' => 'media/svg/icons/Communication/Adress-book2.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'General Cards',
                                'page' => 'features/cards/general'
                            ],
                            [
                                'title' => 'Stacked Cards',
                                'page' => 'features/cards/stacked'
                            ],
                            [
                                'title' => 'Tabbed Cards',
                                'page' => 'features/cards/tabbed'
                            ],
                            [
                                'title' => 'Draggable Cards',
                                'page' => 'features/cards/draggable'
                            ],
                            [
                                'title' => 'Cards Tools',
                                'page' => 'features/cards/tools'
                            ],
                            [
                                'title' => 'Sticky Cards',
                                'page' => 'features/cards/sticky'
                            ],
                            [
                                'title' => 'Stretched Cards',
                                'page' => 'features/cards/stretched'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Widgets',
                        'desc' => 'dashboard widget examples',
                        'icon' => 'media/svg/icons/Communication/Chat1.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Lists',
                                'page' => 'features/widgets/lists'
                            ],
                            [
                                'title' => 'Stats',
                                'page' => 'features/widgets/stats'
                            ],
                            [
                                'title' => 'Charts',
                                'page' => 'features/widgets/charts'
                            ],
                            [
                                'title' => 'Charts',
                                'page' => 'features/widgets/charts'
                            ],
                            [
                                'title' => 'Mixed',
                                'page' => 'features/widgets/mixed',
                            ],
                            [
                                'title' => 'Tiles',
                                'page' => 'features/widgets/tiles',
                            ],
                            [
                                'title' => 'Engage',
                                'page' => 'features/widgets/engage',
                            ],
                            [
                                'title' => 'Tables',
                                'page' => 'features/widgets/tables',
                            ],
                            [
                                'title' => 'Forms',
                                'page' => 'features/widgets/forms',
                            ]
                        ]
                    ],
                    [
                        'title' => 'Calendar',
                        'desc' => '',
                        'icon' => 'media/svg/icons/Communication/Chat-check.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Basic Calendar',
                                'page' => 'features/calendar/basic'
                            ],
                            [
                                'title' => 'List Views',
                                'page' => 'features/calendar/list-view'
                            ],
                            [
                                'title' => 'Google Calendar',
                                'page' => 'features/calendar/google'
                            ],
                            [
                                'title' => 'External Events',
                                'page' => 'features/calendar/external-events'
                            ],
                            [
                                'title' => 'Background Events',
                                'page' => 'features/calendar/background-events'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Charts',
                        'icon' => 'media/svg/icons/Communication/Dial-numbers.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'amCharts',
                                'bullet' => 'dot',
                                'submenu' => [
                                    [
                                        'title' => 'amCharts Charts',
                                        'page' => 'features/charts/amcharts/charts'
                                    ],
                                    [
                                        'title' => 'amCharts Stock Charts',
                                        'page' => 'features/charts/amcharts/stock-charts'
                                    ],
                                    [
                                        'title' => 'amCharts Maps',
                                        'page' => 'features/charts/amcharts/maps'
                                    ]
                                ]
                            ],
                            [
                                'title' => 'Flot Charts',
                                'page' => 'features/charts/flotcharts'
                            ],
                            [
                                'title' => 'Google Charts',
                                'page' => 'features/charts/google-charts'
                            ],
                            [
                                'title' => 'Morris Charts',
                                'page' => 'features/charts/morris-charts'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Maps',
                        'icon' => 'media/svg/icons/Communication/Incoming-box.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Google Maps',
                                'page' => 'features/maps/google-maps'
                            ],
                            [
                                'title' => 'JQVMap',
                                'page' => 'features/maps/jqvmap'
                            ],
                        ]
                    ],
                    [
                        'title' => 'Miscellaneous',
                        'desc' => '',
                        'icon' => 'media/svg/icons/Communication/Active-call.svg',
                        'bullet' => 'dot',
                        'submenu' => [
                            [
                                'title' => 'Kanban Board',
                                'page' => 'features/miscellaneous/kanban-board'
                            ],
                            [
                                'title' => 'Sticky Panels',
                                'page' => 'features/miscellaneous/sticky-panels'
                            ],
                            [
                                'title' => 'Block UI',
                                'page' => 'features/miscellaneous/blockui'
                            ],
                            [
                                'title' => 'Perfect Scrollbar',
                                'page' => 'features/miscellaneous/perfect-scrollbar'
                            ],
                            [
                                'title' => 'Tree View',
                                'page' => 'features/miscellaneous/treeview'
                            ],
                            [
                                'title' => 'Bootstrap Notify',
                                'page' => 'features/miscellaneous/bootstrap-notify'
                            ],
                            [
                                'title' => 'Toastr',
                                'page' => 'features/miscellaneous/toastr'
                            ],
                            [
                                'title' => 'SweetAlert2',
                                'page' => 'features/miscellaneous/sweetalert2'
                            ],
                            [
                                'title' => 'Dual Listbox',
                                'page' => 'features/miscellaneous/dual-listbox'
                            ],
                            [
                                'title' => 'Session Timeout',
                                'page' => 'features/miscellaneous/session-timeout'
                            ],
                            [
                                'title' => 'Idle Timer',
                                'page' => 'features/miscellaneous/idle-timer'
                            ]
                        ]
                    ],
                ]
            ]
        ],
    ]

];
