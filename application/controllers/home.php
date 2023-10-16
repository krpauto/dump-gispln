<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->helper('cookie');
		$this->load->model('barang_model');
		$this->load->model('supplier_model');
		$this->load->model('user_model');
		$this->load->model('barangMasuk_model');
		$this->load->model('barangKeluar_model');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['jmlbarang'] = $this->barang_model->dataJoin()->num_rows();
		$data['jmlsupplier'] = $this->supplier_model->data()->num_rows();
		$data['jmlStok'] = $this->barang_model->totalStok();
		$data['jmlUser'] = $this->user_model->data()->num_rows();
		$data['bm5Terakhir'] = $this->barangMasuk_model->transaksiTerakhir()->result();
		$data['bk5Terakhir'] = $this->barangKeluar_model->transaksiTerakhir()->result();

		$data['yearnow'] = date('Y', strtotime('+0 year'));
		$data['previousyear'] = date('Y', strtotime('-1 year'));
		$data['twoyearago'] = date('Y', strtotime('-2 year'));

		$this->load->view('templates/header', $data);
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}
	public function show_map()
	{
		$this->load->view('map_view');
	}
}
