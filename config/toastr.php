<?php

/*
 * This file is part of the yoeunes/toastr package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

 return [

    /*
    |--------------------------------------------------------------------------
    | Toastr options
    |--------------------------------------------------------------------------
    |
    | Here you can specify the options that will be passed to the toastr.js
    | library. For a full list of options, visit the documentation.
    |
    */
    /**
     * Time out in seconds
     */
    'timeout'=>3000,

    /**
     * show close button
     */
    'show_close_btn'=>true,

    /**
     * show progress bar
     */
    'show_progress_bar'=>true,

    /**
     * Prevent showing duplicate notifications
     */
    'prevent_duplicates'=>true,

    /**
     * Redirect status code default : 302
     */
    'redirect_status_code'=>302

];
