 <?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . '/libraries/REST_Controller.php';
    use Restserver\Libraries\REST_Controller;

    class Login extends REST_Controller {

        function __construct($config = 'rest') {
            parent::__construct($config);
            $this->load->database();
        }

        function login_get(){
            $get_login = $this->db->query("SELECT * FROM user")->result();
            $this->response(array("status"=>"success","result" => $get_login));
        }

        public function login_post()
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('username',$this->input->post('username'));
            $this->db->where('password',$this->input->post('password'));
            $query = $this->db->get();
            $row = $query->first_row();

            if ($query->num_rows()==1) {
                return $this->response(array('status' => 'success','result'=>$row));
            }else{
                return $this->response(array('status' => 'failed', 502));
            }
        }
    }
?>