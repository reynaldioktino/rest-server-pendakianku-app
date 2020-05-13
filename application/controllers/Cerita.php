<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Cerita extends REST_Controller {
//$this->response(array("status"=>"success","result" => $get_pembeli));
//$this->response(array("status"=>"success"));
	function cerita_get(){
		$get_cerita = $this->db->query("SELECT p.id_cerita, p.namagunung, p.cerita ,p.photo_id FROM cerita as p")->result();
		$this->response(array("status"=>"success","result" => $get_cerita));
	}
	function cerita_post() {

		$action = $this->post('action');
		$data_pembeli = array(
			'id_cerita' => $this->post('id_cerita'),
			'namagunung' => $this->post('namagunung'),
			'cerita' => $this->post('cerita'),
			'photo_id' => $this->post('photo_id')
		);
		if ($action==='post'){
			$this->insertPembeli($data_pembeli);
		}else if ($action==='put'){
			$this->updatePembeli($data_pembeli);
		}else if ($action==='delete'){
			$this->deletePembeli($data_pembeli);
		}else{
			$this->response(array("status"=>"failed","message" => "action harus diisi"));
		}
	}
	function insertPembeli($data_pembeli){
//function upload image
		$uploaddir = str_replace("application/", "", APPPATH).'upload/';
		if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
			echo mkdir($uploaddir, 0750, true);
		}
		if (!empty($_FILES)){
			$path = $_FILES['photo_id']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
// $user_img = time() . rand() . '.' . $ext;
			$user_img = $data_pembeli['id_cerita']. '.' . "png";
			$uploadfile = $uploaddir . $user_img;
			$data_pembeli['photo_id'] = "upload/".$user_img;
		}else{
			$data_pembeli['photo_id']="";
		}
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//cek validasi
		if (empty($data_pembeli['namagunung'])){
			$this->response(array('status' => "failed", "message"=>"Nama Gunung Harus Di Isi"));
		}else if (empty($data_pembeli['cerita'])){
			$this->response(array('status' => "failed", "message"=>"Cerita Harus Di Isi"));
		}
		else{
			$get_pembeli_baseid = $this->db->query("SELECT * FROM cerita as p WHERE p.id_cerita='".$data_pembeli['id_cerita']."'")->result();
			if(empty($get_cerita_baseid)){
				$insert= $this->db->insert('cerita',$data_pembeli);
				if (!empty($_FILES)){
					if ($_FILES["photo_id"]["name"]) {

						if

							(move_uploaded_file($_FILES["photo_id"]["tmp_name"],$uploadfile))

						{
							$insert_image = "success";

						} else{
							$insert_image = "failed";

						}
					}else{
						$insert_image = "Image Tidak ada Masukan";
					}
					$data_pembeli['photo_id'] = base_url()."upload/".$user_img;
				}else{

					$data_pembeli['photo_id'] = "";

				}
				if ($insert){
					$this->response(array('status'=>'success','result' =>

						array($data_pembeli),"message"=>$insert));

				}
			}else{
				$this->response(array('status' => "failed", "message"=>"Id_cerita
					sudah ada"));
			}
		}
	}
	function updatePembeli($data_pembeli){
//function upload image
		$uploaddir = str_replace("application/", "", APPPATH).'upload/';
		if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
			echo mkdir($uploaddir, 0750, true);
		}
		if(!empty($_FILES)){
			$path = $_FILES['photo_id']['name'];
// $ext = pathinfo($path, PATHINFO_EXTENSION);
//$user_img = time() . rand() . '.' . $ext;
			$user_img = $data_pembeli['id_cerita'].'.' ."png";
			$uploadfile = $uploaddir . $user_img;
			$data_pembeli['photo_id'] = "upload/".$user_img;
		}
//$this->response(array(base_url()."upload/".$user_img));
//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
//cek validasi
		if (empty($data_pembeli['id_cerita'])){
			$this->response(array('status' => "failed", "message"=>"Id Cerita harus
				diisi"));
		}else if (empty($data_pembeli['namagunung'])){
			$this->response(array('status' => "failed", "message"=>"nama gunung harus
				diisi"));
		}else if (empty($data_pembeli['cerita'])){
			$this->response(array('status' => "failed", "message"=>"cerita harus
				diisi"));
		}else{
			$get_pembeli_baseid = $this->db->query("SELECT * FROM cerita as p WHERE p.id_cerita='".$data_pembeli['id_cerita']."'")->result();
			if(empty($get_pembeli_baseid)){
				$this->response(array('status' => "failed", "message"=>"id_cerita Tidak ada dalam database"));
			}else{
//$this->response(unlink($uploadfile));
//cek apakah image
				if (!empty($_FILES["photo_id"]["name"])) {

					if

						(move_uploaded_file($_FILES["photo_id"]["tmp_name"],$uploadfile)){
							$insert_image = "success";

						} else{
							$insert_image = "failed";

						}
					}else{
						$insert_image = "Image Tidak ada Masukan";
					}
					if ($insert_image==="success"){
//jika photo di update eksekusi query
						$update= $this->db->query("Update cerita Set namagunung
							='".$data_pembeli['namagunung']."', cerita 
							='".$data_pembeli['cerita']."', photo_id 
							='".$data_pembeli['photo_id']."' Where id_cerita
							='".$data_pembeli['id_cerita']."'");

						$data_pembeli['photo_id'] = base_url()."upload/".$user_img;
					}else{
//jika photo di kosong atau tidak di update eksekusi query
						$update= $this->db->query("Update cerita Set namagunung
							='".$data_pembeli['namagunung']."', cerita ='".$data_pembeli['cerita']."' 
							Where id_cerita ='".$data_pembeli['id_cerita']."'");
						$getPhotoPath =$this->db->query("SELECT photo_id

							FROM cerita Where id_cerita='".$data_pembeli['id_cerita']."'")->result();

						if(!empty($getPhotoPath)){
							foreach ($getPhotoPath as $row)
							{
								$user_img = $row->photo_id;
								$data_pembeli['photo_id'] =

								base_url().$user_img;

							}
						}

					}
					if ($update){
						$this->response(array('status'=>'success','result' =>

							array($data_pembeli),"message"=>$update));

					}

				}
			}
		}
		function deletePembeli($data_pembeli){
			if (empty($data_pembeli['id_cerita'])){
				$this->response(array('status' => "failed", "message"=>"Id Cerita harus
					diisi"));
			}
			else{
				$getPhotoPath =$this->db->query("SELECT photo_id FROM cerita Where
					id_cerita='".$data_pembeli['id_cerita']."'")->result();
				if(!empty($getPhotoPath)){
					foreach ($getPhotoPath as $row)
					{
						$path = str_replace("application/", "",APPPATH).$row->photo_id;
					}
//delete image
					unlink($path);
					$this->db->query("Delete From cerita Where

						id_cerita='".$data_pembeli['id_cerita']."'");

					$this->response(array('status'=>'success',"message"=>"Data id =

						".$data_pembeli['id_cerita']." berhasil di delete "));

				} else{
					$this->response(array('status'=>'fail',"message"=>"Id

						Pembeli tidak ada dalam database"));

				}

			}
		}
	}