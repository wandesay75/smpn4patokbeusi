<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	
	public function index()
	{
        $data['title'] = 'Login';
		$this->load->view('header.php', $data);
		$this->load->view('auth', $data);
		$this->load->view('footer.php', $data);

	}


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'km6smpn4.patokbeusi@gmail.com',
            'smtp_pass' => 'ohaleqgqvefpwbke',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        
        $this->email->initialize($config);

        $this->email->from('km6smpn4.patokbeusi@gmail.com', 'KM6 SMPN4PATOKBEUSI');
        $this->email->to($this->input->post('email'));

        if ($type == 'forgot'){
            $this->email->subject('Reset Password');
            $this->email->message('Klik link ini untuk mereset password anda : <a href="'.base_url().'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password Anda!</a>');
        }

        if ($this->email->send())
        {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function LupaPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false)
        {
            $data['title'] = 'Lupa Password';
            $this->load->view('header.php', $data);
            $this->load->view('lupa_password.php', $data);
            $this->load->view('footer.php', $data);
        } else{
            $cek_email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $cek_email])->row_array();

            if ($user){
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $cek_email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="text-center alert alert-success" role="alert">Cek email anda untuk reset password! *Note: cek bagian spam apabila tidak ada di inbox utama email </div>');
                redirect('Auth');

            } else{
                $this->session->set_flashdata('message', '<div class="text-center alert alert-danger" role="alert">Email Anda Tidak Terdaftar!</div>');
                redirect('Auth/LupaPassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if($user_token){
                $this->session->set_userdata('reset_email', $email);
                $this->ubahPassword();
            }else {
                $this->session->set_flashdata('message', '<div class="text-center alert alert-danger" role="alert">Token kadaluarsa! harap ulangi</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="text-center alert alert-danger" role="alert">Reset password anda gagal!</div>');
            redirect('Auth');
        }
    }

    public function ubahPassword()
    {
        if(!$this->session->userdata('reset_email')){
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[8]|matches[password1]');
        if ($this->form_validation->run() == false){
            $data['title'] = 'Ubah Katasandi';
            $this->load->view('header.php', $data);
            $this->load->view('ubah_password.php', $data);
            $this->load->view('footer.php', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token',['email' =>$email]);
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="text-center alert alert-success" role="alert">Katasandi berhasil diubah! <br> Silahkan Login</div>');
            redirect('Auth');
        }
    }

	public function login()
	{
        $cek_user = $this->db->get_where('user', ['email' => $this->input->post('email', true)])->row();
        if ($cek_user){
            if(password_verify($this->input->post('password'), $cek_user->password)){
                if ($cek_user->role == 'admin'){
                    $data_session = [
                         'id_user' => $cek_user->id_user,
                         'nama_user' => $cek_user->nama_user,
                         'role' => $cek_user->role,
                     ];
                    $this->session->set_userdata($data_session);
                    redirect("Manager/Dashboard");
                } else {
                    $data_session = [
                         'id_user' => $cek_user->id_user,
                         'nama_user' => $cek_user->nama_user,
                         'role' => $cek_user->role,
                    ];
                    $this->session->set_userdata($data_session);
                    redirect("Guru/Dashboard");
                }

            }else { 
                echo "<script>
                alert('Katasandi anda salah!');
                window.location.href = `" . site_url('Auth') . "`;
                </script>";
               }

        } else {
            echo "<script>
                alert('Email/Akun anda tidak terdaftar!');
                window.location.href = `" . site_url('Auth') . "`;
             </script>";
        }
    }

public function logout()
{
    $this->session->sess_destroy();
    redirect('Auth');
}

}

?>