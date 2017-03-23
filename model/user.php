<?php

/**
 * Created by PhpStorm.
 * User: zh99998
 * Date: 2017/3/23
 * Time: 下午5:39
 */
class User
{
    /**
     * @var int $id
     */
    public $id;
    /**
     * @var string $username
     */
    public $username;
    /**
     * @var string $created_at
     */
    public $created_at;
    /**
     * @var string $updated_at
     */
    public $updated_at;
    /**
     * @var string $name
     */
    public $name;
    /**
     * @var string $email
     */
    public $email;
    /**
     * @var string $password_hash
     */
    public $password_hash;
    /**
     * @var string $salt ;
     */
    public $salt;
    /**
     * @var boolean $active
     */
    public $active;
    /**
     * @var string $last_seen_at
     */
    public $last_seen_at;
    /**
     * @var boolean $admin
     */
    public $admin;
    /**
     * @var string $ip_address
     */
    public $ip_address;
    /**
     * @var boolean $blocked
     */
    public $blocked;
    /**
     * @var string $locale
     */
    public $locale;
    /**
     * @var string $registration_ip_address
     */
    public $registration_ip_address;
    /**
     * @var string $first_seen_at
     */
    public $first_seen_at;
    /**
     * @var string $auth_token_updated_at
     */
    public $auth_token_updated_at;
    /**
     * @var string $avatar
     */
    public $avatar;
}
