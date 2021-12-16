<?php

// ? Code which hurts this principle

class User {
    protected $name;
    protected $email;
    protected $password;

    /**
     * @param $user
     */
    public function __construct($user){
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->password = password_hash($user['password'], PASSWORD_BCRYPT, [
            'cost' => 12,
        ]);
    }

    /**
     * @param $newUser
     */
    public function updateUser($newUser) {
        $this->name = $newUser['name'];
        $this->email = $newUser['email'];
        $this->password = password_hash($newUser['password'], PASSWORD_BCRYPT, [
            'cost' => 12,
        ]);
    }

    // * This code hurts the single responsibility principle because:
    // * The class User has one task (create and update user), but in these functions the password will be hashed
    // * That means: this class has two tasks: create / Update user AND has the password
}
