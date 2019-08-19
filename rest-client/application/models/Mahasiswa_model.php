<?php 
use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model {
    
	private $client; //private digunakan agar variabel ini hanya dapat digunakan di controller Mahasiswa.php

	public function __construct()
	{
		$this->client = new Client([
			'base_uri' => 'http://localhost/rest-api/rest-server/api/',
			'auth' => ['admin', '1234']
		]); //pembuatan construct ini agar tidak dilakukan berulang-ulang pada setiap method
	}

    public function getAllMahasiswa()
    {
        //return $this->db->get('mahasiswa')->result_array();
        //$client = new Client();

        $response = $this->client->request('GET', 'mahasiswa', [
        	'query' => [
        		'X-API-KEY' => 'firnan123'
        	]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data']; //data adalah nama array json jika di run meggunakan postman
    }

    public function getMahasiswaById($id)
    {
        $client = new Client();

        $response = $this->client->request('GET', 'mahasiswa', [
        	'query' => [
        		'X-API-KEY' => 'firnan123',
        		'id' => $id
        	]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0]; //0 karena hanya mengambil 1 id saja 
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "X-API-KEY" => 'firnan123'
        ];

        $response = $this->client->request('POST', 'mahasiswa', [
        	'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function hapusDataMahasiswa($id)
    {
        //form_params digunakan karena POST PUT DELETE digunakan di Body, jika query untuk GET karena digunakan di params
        $response = $this->client->request('DELETE', 'mahasiswa', [
        	'form_params' => [
        		'X-API-KEY' => 'firnan123',
        		'id' => $id
        	]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0]; 
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            "X-API-KEY" => 'firnan123'
        ];

        $response = $this->client->request('PUT', 'mahasiswa', [
        	'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}