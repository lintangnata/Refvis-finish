<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ResetpwModel;

class Auth extends BaseController
{
    protected $UserModel;
    protected $ResetpwModel;
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->ResetpwModel = new ResetpwModel();
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function valid_register()
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'password' => $this->request->getVar('password'),
            'confirm' => $this->request->getVar('confirm')
        ];

        $errors = $this->validation->getErrors();

        if ($errors) {
            session()->setFlashdata('nama', $this->validation->getError('nama'));
            session()->setFlashdata('username', $this->validation->getError('username'));
            session()->setFlashdata('email', $this->validation->getError('email'));
            session()->setFlashdata('alamat', $this->validation->getError('alamat'));
            session()->setFlashdata('password', $this->validation->getError('password'));
            if ($data['password'] != $data['confirm']) {
                session()->setFlashdata('confirm', $this->validation->getError('confirm'));
            }
            return redirect()->to('/register');
        }

        $token = bin2hex(random_bytes(10));

        $email = \Config\Services::email();
        $email->setTo($data['email']);
        $email->setFrom('refvisofficials@gmail.com', 'Refvis');
        $email->setSubject('Registrasi Akun');
        $email->setMessage('Selamat Datang ' . $data['nama'] . ' di Refvis, akun anda berhasil dibuat. Silahkan Activasi akun anda dengan klik link berikut :' . base_url() . 'auth/activate/' . $token);
        $email->send();

        $this->UserModel->save([
            'nama' => $data['nama'],
            'username' => $data['username'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'actv' => $token,
            'foto' => 'user.png'
        ]);

        session()->setFlashdata('pesan', 'Akun berhasil dibuat Silahkan cek email anda untuk aktivasi akun');
        return redirect()->to('/login');
    }

    public function valid_login()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password')
        ];

        $user = $this->UserModel->where(['username' => $data['username']])->first();

        if ($user) {
            if (password_verify($data['password'], $user['password'])) {
                if ($user['actv'] == 'true') {
                    $data = [
                        'id_user' => $user['id_user'],
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'email' => $user['email'],
                        'alamat' => $user['alamat'],
                        'foto' => $user['foto'],
                        'is_login' => 'true'
                    ];

                    session()->set($data);
                    return redirect()->to('/home');
                } else {
                    session()->setFlashdata('pesan', 'Akun belum diaktivasi');
                    return redirect()->to('/login');
                }
            } else {
                session()->setFlashdata('password', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('username', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function activate($token)
    {
        if ($token) {
            $user = $this->UserModel->where(['actv' => $token])->first();
            if ($user) {
                $this->UserModel->save([
                    'id_user' => $user['id_user'],
                    'actv' => 'true'
                ]);

                session()->setFlashdata('pesan', 'Akun berhasil diaktivasi');
                return redirect()->to('/login');
            } else {
                session()->setFlashdata('pesan', 'Token tidak ditemukan');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('pesan', 'Token tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function lupapw()
    {
        $data = [
            'email' => $this->request->getVar('email'),
            'token' => bin2hex(random_bytes(10))
        ];

        $user = $this->UserModel->where(['email' => $data['email']])->first();

        $id = $user['id_user'];

        if ($user) {
            $email = \Config\Services::email();
            $email->setTo($data['email']);
            $email->setFrom('refvisofficials@gmail.com', 'Refvis');
            $email->setSubject('Reset Password');
            $email->setMessage('Silahkan klik link berikut untuk reset password anda :' . base_url() . 'auth/reset/' . $data['email'] . '/' . $data['token']);
            $email->send();

            $this->ResetpwModel->save([
                'email' => $data['email'],
                'token' => $data['token'],
                'id_user' => $id
            ]);

            session()->setFlashdata('resetpw', 'Silahkan cek email anda untuk reset password');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('resetpwfailed', 'Email tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function reset($email, $token)
    {
        $data = [
            'token' => $token,
            'email' => $email
        ];

        $user = $this->ResetpwModel->where(['token' => $data['token']])->first();
        $cekemail = $this->ResetpwModel->where(['email' => $data['email']])->first();

        if ($user && $cekemail) {

            $this->session->set('email', $data['email']);

            session()->setFlashdata('reset', 'Silahkan buat password baru');
            return view('start/reset');
        } else {
            session()->setFlashdata('resetfailed', 'Token tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function newpw()
    {
        $data = [
            'password' => $this->request->getVar('password'),
            'confirm' => $this->request->getVar('confirm')
        ];

        $errors = $this->validation->getErrors();

        $email = $this->session->get('email');

        $user = $this->UserModel->where(['email' => $email])->first();
        $id = $user['id_user'];

        if ($errors) {
            if ($data['password'] != $data['confirm']) {
                session()->setFlashdata('newpwfailed', 'Password tidak sama');
                return redirect()->to('/auth/reset/' . $email . '/' . $user['token']);
            } else {
                session()->setFlashdata('newpwfailed', 'Password minimal 6 karakter');
                return redirect()->to('/auth/reset/' . $email . '/' . $user['token']);
            }
        } else {
            $this->UserModel->save([
                'id_user' => $id,
                'password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);

            $this->ResetpwModel->where(['email' => $email])->delete();

            session()->setFlashdata('newpw', 'Password berhasil diubah');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
