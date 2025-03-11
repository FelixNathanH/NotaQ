<?php

namespace App\Controllers;

use App\Models\ModelKaryawan;
use App\Models\ModelPasswordRes;
use App\Models\ModelTemplates;
use config\Email;

class auth extends Home
{
    public function login()
    {
        if (isset($_SESSION['nama']) && isset($_SESSION['user_id']) == true) {
            return view('error-page/login-error');
        }
        $data['title'] = 'login';
        return view('login/index', $data);
    }

    public function loginAuth()
    {
        //Captcha
        // $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        // $secretKey = '6LeyX-IpAAAAABBr1oLv6tsAJWP1PqhunfWPrPfW';
        // $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

        // Verify the reCAPTCHA response
        // $response = file_get_contents($recaptchaUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
        // $responseKeys = json_decode($response, true);

        // if (!$responseKeys["success"]) {
        //     return $this->response->setJSON(['error' => true, 'message' => 'Please complete the CAPTCHA']);
        // }

        //login logic
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        if (empty($email) || empty($password)) {
            return $this->response->setJSON(['error' => 'Email and password are required']);
        }

        // Retrieve user from database
        $user = $this->ModelKaryawan->getUserByEmail($email);

        if (!$user) {
            return $this->response->setJSON(['error' => true, 'message' => 'User not found']);
        }
        if ($user['is_verified'] == 0) {
            return $this->response->setJSON(['error' => true, 'message' => 'User is not verified, Please contact your Admin or Check your E-mail for a verification link']);
        }
        // Verify user Password
        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['error' => 'Invalid password']);
        }

        $_SESSION['user_id'] = $user['user_id']; // Example: Store user ID
        $_SESSION['email'] = $user['email']; // Example: Store email
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['group_name'] = $user['group_name'];
        // $_SESSION['language'] = $user['language_preference'];


        // Redirect to home page
        return $this->response->setJSON(['success' => 'Login successful']);

        // Debug information
        /*
        $debugInfo = [
            'email' => $email,
            'password_entered' => $password,
            'hashed_password_stored' => $user['password'], // Hashed password retrieved from the database
            'password_verification' => password_verify($password, $user['password']) ? 'Match' : 'Mismatch',
            'user_id' => $_SESSION['user_id'],
            'email' => $_SESSION['email'],
            'nama' => $_SESSION['nama'],
        ];

        // Return debug information in JSON format
        return $this->response->setJSON(['debug' => $debugInfo]);
        */
    }

    public function logout()
    {
        // Destroy session upon logout
        session_destroy();
        // Redirect to the login page after logout
        return redirect()->to('/login');
    }
}
