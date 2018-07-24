<?php
/**
 * Dashboard
 */
define('DASHBOARD_MENU_HOME', 'Dashboard');
define('DASHBOARD_MENU_LESSONS', 'Lessons');
define('DASHBOARD_MENU_HOMEWORK', 'Homework');
define('DASHBOARD_MENU_STUDENT', 'Students');
define('DASHBOARD_MENU_BLOG', 'Blog');
define('DASHBOARD_MENU_PORTFOLIO', 'Portfolio');
define('DASHBOARD_MENU_CHAT', 'Chat');
define('DASHBOARD_MENU_STATISTIC', 'Statistics');

define('DASHBOARD_SECTION_STATISTIC', 'Statistics cms');
define('DASHBOARD_SECTION_REGISTER', 'User register');
define('DASHBOARD_SECTION_LESSON', 'Lesson post');
define('DASHBOARD_SECTION_COMMENT', 'Comments post');
define('DASHBOARD_SECTION_MESSAGE', 'Message send');
define('DASHBOARD_SECTION_NBARTICLE', 'Number of article in the blog');
define('DASHBOARD_SECTION_NBGROUPS', 'Number of groups');


/**
 * TABLE COLUMN HEADER
 */
    define('DASHBOARD_HEADER_TABLE_TITLE_MODAL', 'Latest lesson on your Website');
    define('DASHBOARD_HEADER_TABLE_NAME', 'View latest post on your blog');
    define('DASHBOARD_HEADER_TABLE_CREATED', 'Created at ');
    define('DASHBOARD_HEADER_TABLE_ACTION', 'Action');
    define('DASHBOARD_HEADER_TABLE_TYPE', 'Type');
    define('DASHBOARD_HEADER_TABLE_VALUE', 'Value');

    define('DASHBOARD_HEADER_TABLE_TITLE', 'Title');
    define('DASHBOARD_HEADER_TABLE_EDIT', 'Edit');
    define('DASHBOARD_HEADER_TABLE_UNPUBLISH', 'Unpublish');
    define('DASHBOARD_HEADER_TABLE_CHAPTERS', 'Chapters');

    define('DASHBOARD_HEADER_NEW_TABLE_AVATAR', 'Avatar');
    define('DASHBOARD_HEADER_NEW_TABLE_NAME', 'Name');
    define('DASHBOARD_HEADER_NEW_TABLE_ACTION', 'Action');
    define('DASHBOARD_HEADER_NEW_TABLE_NUMBER_USER', 'Users');
    define('DASHBOARD_HEADER_NEW_TABLE_FIRSTNAME', 'Firstname');
    define('DASHBOARD_HEADER_NEW_TABLE_LASTNAME', 'Lastname');
    define('DASHBOARD_HEADER_NEW_TABLE_EMAIL', 'Email');
    define('DASHBOARD_HEADER_NEW_TABLE_INSCRIPTION', 'Inscription date');

/**
 * Dashboard Lesson
 */
    define('DASHBOARD_BLOC_LESSON_GENERAL', 'Global menu');
        define('DASHBOARD_BLOC_LESSON_GENERAL_ACTION', 'Action');
        define('DASHBOARD_BLOC_LESSON_GENERAL_ADD_LESSON', 'Add lesson');
        define('DASHBOARD_BLOC_LESSON_GENERAL_ADD_CHAPTER', 'Add chapter');
    define('DASHBOARD_BLOC_LESSON_ANALYTICS', 'Lesson analytics');
        define('DASHBOARD_BLOC_LESSON_ANALYTICS_TYPE', 'Type');
        define('DASHBOARD_BLOC_LESSON_ANALYTICS_VALUE', 'Value');
        define('DASHBOARD_BLOC_LESSON_ANALYTICS_NUMBER_LESSON', 'Number lesson');
        define('DASHBOARD_BLOC_LESSON_ANALYTICS_NUMBER_CHAPTER', 'Number chapter');
    define('DASHBOARD_BLOC_LESSONS', 'Your lessons');
        define('DASHBOARD_BLOC_LESSONS_BUTTON_CHAPTER', 'Chapters');
        define('DASHBOARD_BLOC_LESSONS_BUTTON_EDIT', 'Edit');
        define('DASHBOARD_BLOC_LESSONS_BUTTON_PUBLISH', 'Publish');
        define('DASHBOARD_BLOC_LESSONS_BUTTON_UNPUBLISH', 'Unpublish');
    define('DASHBOARD_BLOC_CHAPTERS', 'Chapters from your lesson');
        define('DASHBOARD_BLOC_CHAPTERS_BUTTON_EDIT', 'Edit');
        define('DASHBOARD_BLOC_CHAPTERS_BUTTON_PUBLISH', 'Publish');
        define('DASHBOARD_BLOC_CHAPTERS_BUTTON_UNPUBLISH', 'Unpublish');
     define('DASHBOARD_BLOC_LESSONS_ADD_TITLE', 'Lesson Title');
     define('DASHBOARD_BLOC_LESSONS_ADD_TITLE2', 'Lesson Title');
        define('DASHBOARD_BLOC_LESSONS_ADD_SELECT_CATEGORY', 'Categories Selection');
        define('DASHBOARD_BLOC_LESSONS_ADD_CATEGORIES_CHOICES', 'You have the right to several choices');
        define('DASHBOARD_BLOC_LESSONS_ADD_CATEGORIES', 'Add categories');
        define('DASHBOARD_BLOC_LESSONS_ADD_CATEGORIES2', 'Adding of categories');
        define('DASHBOARD_BLOC_LESSONS_ADD_CATEGORIES_FORMAT', 'Format : [category 1; category 2; category 3]. They are add automaticaly.');
        define('DASHBOARD_BLOC_LESSONS_ADD_SELECT_GROUP', 'Selection group');
        define('DASHBOARD_BLOC_LESSONS_ADD_GROUP_CHOICES', 'You have the right to several choices ("CTRL + Clic")');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR', 'Choose lesson color
');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR_BASE', 'Base color');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR1', 'Purple');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR2', 'Red');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR3', 'Green');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR4', 'Orange');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR5', 'Pastel blue');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR6', 'Pastel pink');
        define('DASHBOARD_BLOC_LESSONS_ADD_COLOR_BACKGROUND', 'Background color');
        define('DASHBOARD_BLOC_LESSONS_ADD_TYPE', 'Lesson Type');
        define('DASHBOARD_BLOC_LESSONS_ADD_TYPE1', 'Public');
        define('DASHBOARD_BLOC_LESSONS_ADD_TYPE2', 'Private');
        define('DASHBOARD_BLOC_LESSONS_ADD_TYPE_OPTIONS', 'Private lesson or public lesson');
        define('DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY', 'Choose the lesson difficulty');
        define('DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY1', 'Easy');
        define('DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY2', 'Medium');
        define('DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY3', 'High');
        define('DASHBOARD_BLOC_LESSONS_ADD', 'Difficulty valued of the lesson');
        define('DASHBOARD_BLOC_LESSONS_ADD_DESCRIPTION', 'Lesson description');
        define('DASHBOARD_BLOC_LESSONS_ADD_MAX_CHARACTERS', 'Maximum 500 characters');
        define('DASHBOARD_BLOC_LESSONS_ADD_MAX_CHARACTERS2', 'A maximum of 500 characters');
        define('DASHBOARD_BLOC_LESSONS_ADD_OPTIONS', 'Options');
        define('DASHBOARD_BLOC_LESSONS_ADD_EXIT', 'Exit');
        define('DASHBOARD_BLOC_LESSONS_ADD_SAVE_DRAFT', 'Save as draft');
        define('DASHBOARD_BLOC_LESSONS_ADD_SAVE', 'Save  the new lesson');
        define('DASHBOARD_BLOC_LESSONS_ADD_CHAPTER_FILE', 'Select the file(s) to join to this chapter');
        define('DASHBOARD_BLOC_LESSONS_ADD_CHAPTER_SELECT', 'Select lesson');
        define('DASHBOARD_BLOC_LESSONS_ADD_CHAPTER_DESCRITPION', 'You can always edit it later');
        define('DASHBOARD_BLOC_LESSONS_ADD_CHAPTER_NOSELECT', 'no selected course
');



/**
 * Dashboard Student
 */
    define('DASHBOARD_BLOC_GROUPS', 'Group list');
    define('DASHBOARD_BLOC_AVATAR', 'Avatar');
    define('DASHBOARD_BLOC_NAME', 'Name');
    define('DASHBOARD_BLOC_NB_USERS', 'Numbers of users');
    define('DASHBOARD_BLOC_ACTIONS', 'Action');

    define('DASHBOARD_BLOC_USERS', 'Users list');
    define('DASHBOARD_BLOC_FIRSTNAME', 'Firstname');
    define('DASHBOARD_BLOC_EMAIL', 'Email');
    define('DASHBOARD_BLOC_INSCRIPTION', 'Inscription');




/**
 * Dashboard Blog
 */
    define('DASHBOARD_BLOC_BLOG_GENERAL', 'Global menu');
    define('DASHBOARD_BLOC_BLOG_ANALYTICS', 'Blog analytics');
        define('DASHBOARD_BLOC_BLOG_ANALYTICS_ARTICLES', 'Total number');
        define('DASHBOARD_BLOC_BLOG_ANALYTICS_ARTICLES_PUBLISH', 'Publish number');
        define('DASHBOARD_BLOC_BLOG_ANALYTICS_ARTICLES_UNPUBLISH', 'Unpublish number');
        define('DASHBOARD_BLOC_BLOG_ANALYTICS_ARTICLES_COMMENTS', 'Comment number');
        define('DASHBOARD_BLOC_BLOG_ANALYTICS_ARTICLES_FILES', 'File number');

    define('DASHBOARD_BLOC_BLOG_LAST', 'Last blogs');
    define('DASHBOARD_BLOC_BLOG_TITLE_MODAL', 'View all blog');
    define('DASHBOARD_BLOC_BLOG_ALL_PUBLISH', 'All published blogs');
    define('DASHBOARD_BLOC_BLOG_ALL_UNPUBLISH', 'All unpublished blogs');
    define('DASHBOARD_BLOC_BLOG_TITRE', 'Title');
    define('DASHBOARD_BLOC_BLOG_LIMIT', 'No limit');
    define('DASHBOARD_BLOC_BLOG_DATE_PUBLISH', 'Date of publication');
    define('DASHBOARD_BLOC_BLOG_ACTION', 'Action');
        define('DASHBOARD_BLOC_BLOG_BUTTON_VIEW', 'View');
        define('DASHBOARD_BLOC_BLOG_BUTTON_EDIT', 'Edit');
        define('DASHBOARD_BLOC_BLOG_BUTTON_PUBLISH', 'Publish');
        define('DASHBOARD_BLOC_BLOG_BUTTON_UNPUBLISH', 'Unpublish');

        define('DASHBOARD_BLOC_BLOG_BUTTON_SAVE', 'Save without publishing');
