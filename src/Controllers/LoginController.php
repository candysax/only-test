<?php

namespace Only\Test\Controllers;

use Only\Test\Base\DB;
use Only\Test\Base\View;
use Only\Test\Validators\LoginValidator;

class LoginController
{
    public function index(): View
    {
        return View::render('login', [
            'title' => 'Вход',
            'captcha_key' => (require base_path('config.php'))['CAPTCHA_CLIENT_KEY'],
            'errors' => $_SESSION['_flash']['errors'] ?? [],
        ]);
    }

    public function login($query): void
    {
        $errors = (new LoginValidator())->validate($query)->flashErrors();

        if (!$this->checkCaptcha($query['smart-token'])) {
            $_SESSION['_flash']['errors']['captcha'][] = 'Ошибка ввода капчи';
        }

        if (!empty($errors)) {
            redirect('/login');
        }

        $user = DB::query(
            'SELECT * FROM users WHERE `phone` = :phone_or_email OR `email` = :phone_or_email',
            ['phone_or_email' => $query['phone_or_email']]
        )->fetch();

        if ($user && password_verify($query['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            redirect('/profile');
        }

        $_SESSION['_flash']['errors']['global'][] = 'Неправильный телефон/email или пароль';
        redirect('/login');
    }

    private function checkCaptcha(string $token): bool
    {
        define('CAPTCHA_SERVER_KEY', (require base_path('config.php'))['CAPTCHA_SERVER_KEY']);

        $ch = curl_init("https://smartcaptcha.yandexcloud.net/validate");
        $args = [
            "secret" => CAPTCHA_SERVER_KEY,
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR'],
        ];
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return false;
        }

        $resp = json_decode($server_output);
        return $resp->status === "ok";
    }
}
