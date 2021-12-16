<?php

// ? Same code without hurting this principle

class User {
    protected $name;
    protected $email;
    protected $password;

    /**
     * @param $user
     */
    public function __construct($user){
        $hash = new Hash($user['password']);
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->password = $hash->getHashedPassword();
    }

    /**
     * @param $newUser
     */
    public function updateUser($newUser) {
        $hash = new Hash($newUser);
        $this->name = $newUser['name'];
        $this->email = $newUser['email'];
        $this->password = $hash->getHashedPassword();
    }

    // * This code does not hurt the single responsibility principle because:
    // * The class User has one task (create and update user), and the other class Hash has the second task (hashing the password)
}

class Hash {
    protected $hashedPassword;
    protected $options = [
        'cost' => 12,
    ];

    /**
     * @param $password
     */
    public function __construct($password) {
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT, $this->options);
    }

    /**
     * @return false|string|null
     */
    public function getHashedPassword() {
        return $this->hashedPassword;
    }
}