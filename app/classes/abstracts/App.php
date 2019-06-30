<?php

namespace App\Abstracts;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class App {

    /**
     * Database Connection
     * Responsible for connecting to MySQL database
     * @var \Core\Database\Connection
     */
    public static $db_conn;

    /**
     * Database Schema
     * Responsible for database schema in MySQL
     * @var \Core\Database\Schema
     */
    public static $db_schema;

    /**
     * User Repository
     * Handles user data
     * @var \Core\User\Repository
     */
    public static $user_repo;

    /**
     * Session
     * Handles login operations
     * @var \Core\User\Session
     */
    public static $session;
  
    /**
     * Konstruktoriaus paskirtis nustatyti 
     * visus klasės property'ies 
     */
    abstract public function __construct();

}
