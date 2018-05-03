<?php
namespace App\Service;

class AuthService
{
    // const FILE_NAME='../../../.htpasswd';

    protected $users = array (
        array(
            'username' => 'admin' ,
            'password' => '123'
    ));

    public function login($username, $password)
    {
        $result = false;

        if ($username and $password) {
            $user = $this->findUser($username);
            if ($user) {
                if (strpos($user['password'], $password) !== false) {
                    session_start();
                    $_SESSION['admin'] = true;
                    session_write_close();
                    $result = true;
                }
            }
        }

        return $result;
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }

    public function findUser($username)
    {
        $result = false;
//это проверка из файла с хэша
//         if(is_file(FILE_NAME)) {
//             $users = file(FILE_NAME);
//
//             foreach($users as $user) {
//                 if(strpos($user, $username.':') !== false) {
//                     $result = $user;
//                 }
//             }
//         }

        foreach ($this->users as $user) {
            if(strpos($user['username'], $username) !== false) {
                $result = $user;
            }
        }
        return $result;
    }

    public function isAuth() {
        $isAuth = false;

        session_start();
        if(isset($_SESSION['admin'])) {
            $isAuth = $_SESSION['admin'];
        }
        session_write_close();

        return $isAuth;
    }
}
