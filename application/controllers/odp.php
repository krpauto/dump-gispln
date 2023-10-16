<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Odp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('odp_model');
    }

    public function index()
    {
        $data['title'] = 'Odp';
        $data['odp'] = $this->odp_model->data()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('odp/index');
        $this->load->view('templates/footer');
    }

    public function proses_tambah()
    {
        $kode =     $this->odp_model->buat_kode();
        $odp = $this->input->post('odp');
        $lokasi =     $this->input->post('lokasi');
        $keterangan =     $this->input->post('keterangan');
        $latitude =     $this->input->post('latitude');
        $longitude =     $this->input->post('longitude');
        $kategori =     $this->input->post('kategori');

        $data = array(
            'id_odp' => $kode,
            'nama_odp' => $odp,
            'lokasi' => $lokasi,
            'keterangan' => $keterangan,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'kategori' => $kategori,
        );

        $this->odp_model->tambah_data($data, 'odp');
        $this->session->set_flashdata('Pesan', '
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil ditambahkan!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
        redirect('odp');
    }

    public function proses_ubah()
    {
        $kode =     $this->input->post('idodp');
        $odp = $this->input->post('odp');
        $notelp =     $this->input->post('notelp');
        $alamat =     $this->input->post('alamat');

        $data = array(
            'nama_odp' => $odp,
            'notelp' => $notelp,
            'alamat' => $alamat
        );

        $where = array(
            'id_odp' => $kode
        );

        $this->odp_model->ubah_data($where, $data, 'odp');
        $this->session->set_flashdata('Pesan', '
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil diubah!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
        redirect('odp');
    }

    public function proses_hapus($id)
    {
        $where = array('id_odp' => $id);
        $this->odp_model->hapus_data($where, 'odp');
        $this->session->set_flashdata('Pesan', '
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil dihapus!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
        redirect('odp');
    }

    public function getData()
    {
        $id = $this->input->post('id');
        $where = array('id_odp' => $id);
        $data = $this->odp_model->detail_data($where, 'odp')->result();
        echo json_encode($data);
    }
}
