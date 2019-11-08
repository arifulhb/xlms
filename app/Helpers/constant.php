<?php


/**
 * USER ROLES
 */

 const USER_ROLE_ADMIN = 'Admin';
 const USER_ROLE_INSTRUCTOR = 'Instructor';
 const USER_ROLE_STUDENT = 'Trainee';

/**
 * USER Constants
 */
const USER_STATUS_SUSPENDED = 0;
const USER_STATUS_BLOCKED = 1;
const USER_STATUS_PENDING = 2;
const USER_STATUS_ACTIVE = 3;
const USER_STATUS_INACTIVE = 4;

const USER_STATUS = [
    0   => 'Suspended',
    1   => 'Blocked',
    2   => 'Pending',
    3   => 'Active',
    4   => 'Inactive'
];


/**
 * Course Difficulty Level
 */
 const COURSE_DIFFICULTY_LEVEL_BEGINNER = 1;
 const COURSE_DIFFICULTY_LEVEL_INTERMEDIATE = 2;
 const COURSE_DIFFICULTY_LEVEL_EXPERT = 3;
 const COURSE_DIFFICULTY_LEVEL_SPECIALIST = 4;

 const COURSE_DIFFICULTY_LEVELS = [
    1 => 'Beginner',
    2 => 'Intermediate',
    3 => 'Expert',
    4 => 'Specialist',
 ];


 /**
  * Course Status
  */
  const COURSE_STATUS_INACTIVE = 0;
  const COURSE_STATUS_DRAFT = 1;
  const COURSE_STATUS_PUBLISHED = 5;

  const COURSE_STATUS = [
    0 => 'Inactive',
    1 => 'Draft',
    5 => 'Published'
  ];


/**
  * Course MODULE Status
  */
  const MODULE_STATUS_NEW = 0;
  const MODULE_STATUS_IN_PROGRESS = 1;
  const MODULE_STATUS_COMPLETE = 5;

  const MODULE_STATUS = [
    0 => 'New',
    1 => 'In Progress',
    5 => 'Complete'
  ];

/**
  * Course Lesson Status
  */
  const LESSON_STATUS_NEW = 0;
  const LESSON_STATUS_IN_PROGRESS = 1;
  const LESSON_STATUS_COMPLETE = 5;

  const LESSON_STATUS = [
    0 => 'New',
    1 => 'In Progress',
    5 => 'Complete'
  ];

  /**
   * Course Lesson Types
   */
   const LESSON_TYPES = [
    1 => 'Video',
    2 => 'Audio',
    3 => 'Image',
    4 => 'Pdf',
    5 => 'Document',
    6 => 'Downloadable File'
   ];

   const LESSON_TYPE_VIDEO = 1;
   const LESSON_TYPE_AUDIO = 2;
   const LESSON_TYPE_IMAGE = 3;
   const LESSON_TYPE_PDF = 4;
   const LESSON_TYPE_DOCUMENT = 5;
   const LESSON_TYPE_DOWNLOADABLE_FILE = 6;
