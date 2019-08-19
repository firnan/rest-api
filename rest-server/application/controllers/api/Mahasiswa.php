<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends CI_Controller
{
	use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

	function __construct()
	{
		parent::__construct();
		$this->__resTraitConstruct();
		$this->load->model('M_Mahasiswa');

		//$this->methods['METHOD_NAME']['limit'] = [NUM_REQUESTS_PER_HOUR]; //limit per jam berapa kali hit dan method name per method tidak bisa langsung semua
		//$this->methods['index_post']['limit'] = 3;
		$this->methods['index_get']['limit'] = 100;
	}

	public function index_get()
	{
		$id = $this->get('id');

		if ($id === null) {
			$mahasiswa = $this->M_Mahasiswa->getMahasiswa();
		} else {
			$mahasiswa = $this->M_Mahasiswa->getMahasiswa($id);
		}
		
		
		if ($mahasiswa) {
			$this->set_response([
                'status' => true,
                'data' => $mahasiswa
            ], 200); //200 is HTTP_OK
		} else {
			$this->set_response([
                'status' => false,
                'message' => 'ID Not Found!'
            ], 404); //404 is HTTP_NOT_FOUND
		}

	}

	public function index_delete() 
	{
		$id = $this->delete('id');

		if ($id === null) {
			$this->set_response([
                'status' => false,
                'message' => 'Provide an ID'
            ], 400); //400 is HTTP_BAD_REQUEST
		} else {
			if ($this->M_Mahasiswa->deleteMahasiswa($id) > 0) {
				//OK
				$this->set_response([
	                'status' => true,
	                'id' => $id,
	                'message' => 'Deleted Success!'
            	], 200); //200 is HTTP_NO_CONTENT
			} else {
				//ID Not Found
				$this->set_response([
	                'status' => false,
	                'message' => 'ID Not Found!'
            	], 400);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'nrp' => $this->post('nrp'),
			'nama' => $this->post('nama'),
			'email' => $this->post('email'),
			'jurusan' => $this->post('jurusan')
		];

		if ($this->M_Mahasiswa->createMahasiswa($data) > 0 ) {
			$this->set_response([
	            'status' => true,
	            'id' => $id,
	            'message' => 'Insert Data is Success!'
            ], 201); //201 is HTTP_CREATED
		} else {
			$this->set_response([
	            'status' => false,
	            'message' => 'Failed to Insert Data!'
            ], 400);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');
		$data = [
			'nrp' => $this->put('nrp'),
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'jurusan' => $this->put('jurusan')
		];

		if ($this->M_Mahasiswa->updateMahasiswa($data, $id) > 0 ) {
			$this->set_response([
	            'status' => true,
	            'id' => $id,
	            'message' => 'Modify Data is Success!'
            ], 200); 
		} else {
			$this->set_response([
	            'status' => false,
	            'message' => 'Failed to Update Data!'
            ], 400);
		}
	}
}

?>