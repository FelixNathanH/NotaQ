<?php

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelPasswordRes;
use App\Models\ModelCompany;
use config\Email;

class auth extends Home
{
    protected $db, $builder, $ModelUser, $ModelPasswordRes, $ModelCompany, $email;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('user');
        $this->ModelUser = new ModelUser();
        $this->ModelPasswordRes = new ModelPasswordRes();
        $this->ModelCompany = new ModelCompany();
        $this->request = \Config\Services::request();
        $this->email = \Config\Services::email();
    }
    public function login()
    {
        // Check if user is already logged in
        if (isset($_SESSION['name']) && isset($_SESSION['user_id']) == true) {
            return view('error-page/login-error');
        }
        $data['title'] = 'login';
        return view('login/index', $data);
    }

    public function loginAuth()
    {
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        if (empty($email) || empty($password)) {
            return $this->response->setJSON(['error' => 'Email and password are required']);
        }

        // Retrieve user from database
        $user = $this->ModelUser->getUserByEmail($email);

        if (!$user) {
            return $this->response->setJSON(['error' => true, 'message' => 'User not found']);
        }
        if ($user['deleted_at'] != null) {
            return $this->response->setJSON(['error' => true, 'message' => 'Akun ini telah dihapus. Silahkan hubungi Admin']);
        }
        if ($user['is_verified'] == 0) {
            return $this->response->setJSON(['error' => true, 'message' => 'Akun ini belum terverifikasi, Silahkan hubungi Admin atau check email anda untuk link verifikasi']);
        }
        // Verify user Password
        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['error' => 'Invalid password']);
        }

        // Set session using CodeIgniter 4's session service
        session()->set([
            'user_id'     => $user['user_id'],
            'email'       => $user['email'],
            'name'        => $user['name'],
            'company'     => $user['company'],
            'company_id'  => $user['company_id'],
        ]);
        // If success return JSON response back to login page
        return $this->response->setJSON(['success' => 'Login successful']);
    }

    public function logout()
    {
        // Destroy session upon logout
        session_destroy();
        // Redirect to the login page after logout
        return redirect()->to('/login');
    }

    public function registerAuth()
    {
        // Start database connection and transaction
        $db = \Config\Database::connect();
        $db->transStart();

        // Grab input from form register form
        $userId = 'ppg' . uniqid();
        $companyId = 'cmp' . uniqid();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $companyName = $this->request->getPost('company');
        $phone_number = $this->request->getPost('phone_number');
        $password = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(32));

        // Check existing email
        $existingUser = $this->ModelUser->getUserByEmail($email);
        if ($existingUser) {
            return $this->response->setJSON(['error' => true, 'message' => 'User already exists']);
        }

        // User data
        $userData = [
            'user_id' => $userId,
            'name' => $name,
            'email' => $email,
            'company' => $companyName,
            'phone_number' => $phone_number,
            'password' => $hashedPassword,
            'token' => $token,
            'is_verified' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Company data
        $companyData = [
            'company_id' => $companyId,
            'user_id' => $userId,
            'company_name' => $companyName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Insert operations
        $this->ModelUser->add_dataUser($userData);
        $this->ModelCompany->add_dataCompany($companyData);

        // Commit transaction
        $db->transComplete();

        // Check if any insert failed
        if ($db->transStatus() === false) {
            return $this->response->setJSON(['error' => true, 'message' => 'Registration failed. Please try again.']);
        }

        // Send verification email
        $this->sendEmailverif($email, $token);

        return $this->response->setJSON(['success' => true, 'message' => 'An Email verification link has been sent to your inbox']);
    }


    private function sendEmailverif($email, $token)
    {
        $verificationLink = site_url('/verify/' . $token);
        $message = "
        <p>Hello,</p>
        <p>You are almost there to complete your registration. Please click the link below to verify your email:</p>
        <p><a href='$verificationLink'>Verify email</a></p>
        <p>This link will expire in 24 hours.</p>
    ";
        //load the email config
        $emailConfig = new Email();
        $this->email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
        $this->email->setTo($email);
        $this->email->setSubject('Account Verification');
        $this->email->setMessage($message);
        if (!$this->email->send()) {
            return $this->response->setJSON(['error' => true, 'message' => 'There is an error!! Verification has not been sent']);
        } else {
            return $this->response->setJSON(['success' => true, 'message' => 'A verification link has been sent to your email']);;
        }
    }

    public function verify($token)
    {
        // Fetch the token request from the database
        $tokenRequest = $this->ModelUser->tokenRequest($token);

        if (!$tokenRequest) {
            // Token does not exist
            return redirect()->to('/register')->with('error', 'Invalid token or the token has expired.');
        }

        // Calculate token expiration time
        $tokenCreatedAt = new \DateTime($tokenRequest['created_at']);
        $currentDateTime = new \DateTime();
        $tokenExpirationTime = $tokenCreatedAt->modify('+1 hour');

        if ($tokenExpirationTime < $currentDateTime) {
            // Token is expired
            return redirect()->to('/register')->with('error', 'Expired token.');
        }

        // Verify user by token
        $user = $this->ModelUser->getToken($token);

        if ($user && !$user->is_verified) {
            // Update user as verified
            $this->ModelUser->update($user->user_id, [
                'is_verified' => true,
                'token' => null
            ]);
            return redirect()->to('/login')->with('success', 'Verification successful! You can now log in.');
        } else {
            return redirect()->to('/register')->with('error', 'There is an error!! Please try again in a few minutes.');
        }
    }

    // ----- Forget Password ------ //
    //forget password view
    public function forget()
    {
        $data['title'] = "Forget Password";
        return view('forget-password/index', $data);
    }

    //logic forget password
    public function forgetAuth()
    {
        $email = $this->request->getPost('email');
        $user = $this->ModelUser->emailValid($email);
        if (!$user) {
            return $this->response->setJSON(['error' => true, 'message' => 'Email not found']);
        } else {
            $token = $token = bin2hex(random_bytes(32));
            $data = [
                'email' => $email,
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $resetLink = site_url('/resetPassForm/' . $token);

            $message = "
        <p>Hello,</p>
        <p>You requested a password reset. Click the link below to reset your password:</p>
        <p><a href='$resetLink'>Reset Your Password</a></p>
        <p>This link will expire in 24 hours.</p>
    ";

            $emailConfig = new Email();
            $this->ModelPasswordRes->insertData($data);
            $this->email->setFrom($emailConfig->fromEmail, $emailConfig->fromName);
            $this->email->setTo($email);
            $this->email->setSubject('Password Reset request');
            $this->email->setMessage($message);
            if (!$this->email->send()) {
                return $this->response->setJSON(['error' => true, 'message' => 'There is an error!! Verification has not been sent']);
            } else {
                return $this->response->setJSON(['success' => true, 'message' => 'A verification link has been sent to your email']);;
            }
        }
    }

    public function showResetPasswordForm($token)
    {
        // Check if the token exists in the password_resets table
        $resetRequest = $this->ModelPasswordRes->tokenRequest($token);
        // If the token does not exist or is older than 1 hour, redirect with an error message
        if (!$resetRequest) {
            // Token does not exist
            return redirect()->to('auth/forget')->with('error', 'Invalid token.');
        }

        $tokenCreatedAt = new \DateTime($resetRequest['created_at']);
        $currentDateTime = new \DateTime();
        $tokenExpirationTime = $tokenCreatedAt->modify('+1 hour');
        if ($tokenExpirationTime < $currentDateTime) {
            // Token is expired
            return redirect()->to('auth/forget')->with('error', 'Expired token.');
        }
        return view('forget-password/recoverPass', ['token' => $token]);
    }

    public function resetPassword()
    {
        //Grab the Token from the POST request of the form
        $token = $this->request->getPost('token');
        if (!$token) {
            return $this->response->setJSON(['error' => true, 'message' => 'Token is not set']);
        }

        //Validate the token
        $resetInfo = $this->ModelPasswordRes->getToken($token);
        if (!$resetInfo) {
            return $this->response->setJSON(['error' => true, 'message' => 'Invalid or expired token']);
        }

        // Extract email associated with the token
        $email = $resetInfo->email;
        $newPassword = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $data = [
            $hashedPassword,
        ];

        $this->ModelUser->updateByEmail($email, ['password' => $hashedPassword]);
        $this->ModelPasswordRes->deleteToken($token);
        return $this->response->setJSON(['success' => true, 'message' => 'Password reset successful, you will be redirected shortly']);
    }
}
