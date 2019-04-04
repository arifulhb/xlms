<?php

return [

    'admin' => env('ADMIN_USER', 'admin@xlms.com'),

    'menu'  => [
        'Welcome' => [
            'menu' => [
                [
                    'name'  => 'Dashboard',
                    'href'  => '/home',
                    'icon'  => 'dashboard',
                    'can'   => 'Instructor|Admin|student'
                ]
            ]
        ],
        'Modules' => [
            'menu' => [
                [
                    'name'  => 'Course Manager',
                    'href'  => '/admin/courses',
                    'icon'  => 'video_library',
                    'can'   => 'Instructor|Admin'
                ],
                [
                    'name'  => 'Quiz Manager',
                    'href'  => '/admin/quizes',
                    'icon'  => 'check_box',
                    'can'   => 'Instructor|Admin'
                ]
            ]
        ],
        'Reports' => [
            'menu' =>  [
                [
                    'name'  => 'Assigned Courses',
                    'href'  => '/instructor/assigned-courses',
                    'icon'  => 'event_note',
                    'can'   => 'Instructor|Admin'
                ],
                [
                    'name'  => 'Quiz Result',
                    'href'  => '/instructor/quiz-result',
                    'icon'  => 'content_paste',
                    'can'   => 'Instructor|Admin'
                ],
                [
                    'name'  => 'Course Engagement',
                    'href'  => '/instructor/course-engagement',
                    'icon'  => 'chrome_reader_mode',
                    'can'   => 'Instructor|Admin'
                ],

            ]
        ],
        'Management' => [
            'menu' => [
                [
                    'name'  => 'User',
                    'href'  => '/admin/users',
                    'icon'  => 'person',
                    'can'   => 'Admin'
                ],
                [
                    'name'  => 'Department',
                    'href'  => '/admin/department',
                    'icon'  => 'assignment_ind',
                    'can'   => 'Admin'
                ],
                [
                    'name'  => 'Role',
                    'href'  => '/admin/role',
                    'icon'  => 'build',
                    'can'   => 'Admin'
                ]
            ]
        ]

    ]

];
