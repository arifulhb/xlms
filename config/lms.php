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
                    'can'   => 'Instructor|Admin|Trainee'
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
                    'name'  => 'Course Categories',
                    'href'  => '/admin/course-categories',
                    'icon'  => 'folder_open',
                    'can'   => 'Admin'
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
                    'href'  => '/admin/departments',
                    'icon'  => 'assignment_ind',
                    'can'   => 'Admin'
                ],
                [
                    'name'  => 'Role',
                    'href'  => '/admin/job-roles',
                    'icon'  => 'build',
                    'can'   => 'Admin'
                ]
            ]
        ]

    ],
    'course_categories' => [

        [
            'name'                  => 'Development',
            'slug'                  => 'development',
            'description'           => 'Development',
            'child' => [
                [
                    'name'                  => 'Web Development',
                    'slug'                  => 'Web Development',
                    'description'           => 'Web Development',
                ],
                [
                    'name'                  => 'Mobile App',
                    'slug'                  => 'Mobile App',
                    'description'           => 'Mobile App',
                ],
                [
                    'name'                  => 'Programming Languages',
                    'slug'                  => 'Programming Languages',
                    'description'           => 'Programming Languages',
                ],
            ]
        ],

        [
            'name'                  => 'Business',
            'slug'                  => 'business',
            'description'           => 'Development',
            'child' => [
                [
                    'name'                  => 'Finance',
                    'slug'                  => 'Finance',
                    'description'           => 'Finance',
                ],
                [
                    'name'                  => 'Enterpreneurship',
                    'slug'                  => 'Enterpreneurship',
                    'description'           => 'Enterpreneurship',
                ],
                [
                    'name'                  => 'Communication',
                    'slug'                  => 'Communication',
                    'description'           => 'Communication',
                ],
                [
                    'name'                  => 'Management',
                    'slug'                  => 'Management',
                    'description'           => 'Management',
                ],
                [
                    'name'                  => 'Sales',
                    'slug'                  => 'Sales',
                    'description'           => 'Sales',
                ],
            ]
        ],

        [
            'name'                  => 'IT & Software',
            'slug'                  => 'IT & Software',
            'description'           => 'IT & Software',
            'child' => [
                [
                    'name'                  => 'IT Certification',
                    'slug'                  => 'IT Certification',
                    'description'           => 'IT Certification',
                ],
                [
                    'name'                  => 'Network Security',
                    'slug'                  => 'Network Security',
                    'description'           => 'Network Security',
                ],
                [
                    'name'                  => 'Hardware',
                    'slug'                  => 'Hardware',
                    'description'           => 'Hardware',
                ],
            ]
        ],

        [
            'name'                  => 'Office Productivity',
            'slug'                  => 'Office Productivity',
            'description'           => 'Office Productivity',
            'child' => [
                [
                    'name'                  => 'Microsoft',
                    'slug'                  => 'Microsoft',
                    'description'           => 'Microsoft',
                ],
                [
                    'name'                  => 'Google',
                    'slug'                  => 'Google',
                    'description'           => 'Google',
                ],
                [
                    'name'                  => 'SAP',
                    'slug'                  => 'SAP',
                    'description'           => 'SAP',
                ],
            ]
        ],

        [
            'name'                  => 'Personal Development',
            'slug'                  => 'Personal Development',
            'description'           => 'Personal Development',
            'child' => [
                [
                    'name'                  => 'Productivity',
                    'slug'                  => 'Productivity',
                    'description'           => 'Productivity',
                ],
                [
                    'name'                  => 'Leadership',
                    'slug'                  => 'Leadership',
                    'description'           => 'Leadership',
                ],
                [
                    'name'                  => 'Influence',
                    'slug'                  => 'Influence',
                    'description'           => 'Influence',
                ],
            ]
        ],

        [
            'name'                  => 'Marketing',
            'slug'                  => 'Marketing',
            'description'           => 'Marketing',
            'child' => [
                [
                    'name'                  => 'Digital marketing',
                    'slug'                  => 'Digital marketing',
                    'description'           => 'Digital marketing',
                ],
                [
                    'name'                  => 'Social Media Marketing',
                    'slug'                  => 'Social Media Marketing',
                    'description'           => 'Social Media Marketing',
                ],
                [
                    'name'                  => 'Branding',
                    'slug'                  => 'Branding',
                    'description'           => 'branding',
                ],
            ]
        ],
        [
            'name'                  => 'Teaching',
            'slug'                  => 'Teaching',
            'description'           => 'Teaching',
            'child' => [
                [
                    'name'                  => 'Engineering',
                    'slug'                  => 'Engineering',
                    'description'           => 'Engineering',
                ],
                [
                    'name'                  => 'Science',
                    'slug'                  => 'Science',
                    'description'           => 'Science',
                ],
                [
                    'name'                  => 'Language',
                    'slug'                  => 'Language',
                    'description'           => 'Language',
                ],
            ]
        ],


    ]


];
