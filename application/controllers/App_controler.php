<?php 
/**
* 
*/
class App_controler extends CI_Controller
{
	public function __construct() {

    parent::__construct();

    // load base_url
    $this->load->helper('url');
    
  	}
	public function Index()
	{
		if ($this->session->userdata('username')) {
			redirect('App_controler/CTampilMember');
		}
		$this->load->view('Vlogin');
	}
	public function CProsesLogin(){
		$pengguna = $this->input->post('nm_pengguna');
		$pass = $this->input->post('pass');
		$role = 'kasir';
		$hasil = $this->App_model->MprosesLogin($pengguna, $pass, $role);
		if ($hasil == false) {
			$this->session->set_flashdata('error_login', true);
			redirect('App_controler');
		}
		$hasil2 = array(
			'username' => $hasil['username'],
			'nm_user' => $hasil['nm_user'],
			'id_user' => $hasil['id_user'],
			'id_outlet' => $hasil['id_outlet']
			);
		$this->session->set_userdata($hasil2);
		//$this->session->set_userdata('id_outlet', $hasil2['id_outlet']);

		$this->session->set_flashdata('status', 'Selamat Datang : ' .$hasil2['username']);
		redirect('App_controler/CTampilMember');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('App_controler');
	}
	public function CTampilMember()
	{
		if (!$this->session->userdata('username')) {
			redirect('App_controler');
		}
		$id_user = $this->session->userdata('id_user');
		$data = $this->App_model->MTampilMember($id_user);
		$this->load->view('VHome', ['data' => $data]);
	}

	public function CTambahMember()
	{
		$this->load->view('VTambahMember');
	}

	public function CProsesTambahMember()
	{
		$id_user = $this->session->userdata('id_user');
		$nm_member = $this->input->post('nm_member');
		$tlp_member = $this->input->post('tlp_member');
		$alamat_member = $this->input->post('alamat_member');

		$hasil = $this->App_model->MProsesTambahMember($nm_member, $tlp_member, $alamat_member, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Menambahkan Member');

		}else {
			$this->session->set_flashdata('status', 'Gagal Menambahkan Member');
		}
		redirect('App_controler/CTampilMember');
	}

	public function Clogout()
	{
		$this->session->unset_userdata('username');
		redirect('App_controler');
	}

	public function CHapusMember($id)
	{
		$this->App_model->MHapusMember($id);
		redirect('App_controler/CTampilMember');
	}

	public function CEditMember($id)
	{
		$data = $this->App_model->MEditMember($id);
		$this->load->view('VEditMember', ['data' => $data]);
	}

	public function CProsesEditMember($id_member)
	{
		$id = $id_member;
		$nm_member = $this->input->post('nm_member');
		$tlp_member = $this->input->post('tlp_member');
		$alamat_member = $this->input->post('alamat_member');

		$hasil = $this->App_model->MProsesEditMember($nm_member, $tlp_member, $alamat_member, $id);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Merubah Member ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Merubah Member');
		}
		redirect('App_controler/CTampilMember');
	}

	public function CTampilService()
	{
		$ambil_jenis = $this->App_model->MAmbilJenis();
		$id_outlet = $this->session->userdata('id_outlet');


		foreach ($ambil_jenis as $j) {
			if ($j['jenis_paket'] == 'paketan') {
				$paketan = $this->App_model->MTampilPaket('paketan', $id_outlet);
				$paketan2 = $this->load->view('VServicePaket', ['data' => $paketan], true);
			} elseif ($j['jenis_paket'] == 'standar' ) {
				$standar = $this->App_model->MTampilPaket('standar', $id_outlet);
				$standar2 = $this->load->view('VServiceStandar', ['data' => $standar], true);
			}
		}

		$this->load->view('VService', ['standar' => $standar2, 'paketan' => $paketan2]);

	}

	public function CMasukKeranjang($id)
	{
		
		$id_paket = $id;
		$id_user = $this->session->userdata('id_user');
		$qty = $this->input->post('kuantitas');


		$hasil = $this->App_model->MMasukKeranjang($qty, $id_paket, $id_user);
		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Berhasil Masuk Keranjang ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Masuk Keranjang');
		}
		redirect('App_controler/CTampilService');
	}

	public function CTampilKeranjang()
	{
		$data = $this->App_model->MTampilKeranjang($this->session->userdata('id_user'));
		$this->load->view('VKeranjang', ['data' => $data]);
	}

	public function CHapusKeranjang($id_detail_transaksi)
	{
	 	$this->App_model->MHapusKeranjang($id_detail_transaksi);
	 	redirect('App_controler/CTampilKeranjang');
	}

	public function CProsesKeranjang()
	{
		$total_harga = $this->input->post('total_bayar');
		$id_member = $this->input->post('id_member');
		$biaya_tambahan = $this->input->post('biaya_tambahan');
		$pajak = $this->input->post('pajak');
		$diskon = $this->input->post('diskon');
		$keterangan = $this->input->post('keterangan');
		$batas_waktu = $this->input->post('batas_waktu');

		$id_user = $this->session->userdata('id_user');
		$id_outlet = $this->session->userdata('id_outlet');
		
		$hasil = $this->App_model->MProsesKeranjang($id_member, $biaya_tambahan, $pajak, $diskon, $id_user, $id_outlet, $batas_waktu, $total_harga);
		$hasil2 = $this->App_model->MUpdateKeranjang($id_user, $keterangan, $id_member);
		
		$invoice = $this->App_model->MAmbilDataTransaksi($id_member);
		$invoice2 = array(
			'kode_invoice' => $invoice['kode_invoice']
			);

		$updateStatus = $this->App_model->MUpdateStatus($invoice2['kode_invoice']);

		//mengecek klo berhasil checkout atau tidak
		if ($hasil == true) {
			$this->session->set_userdata($invoice2);
			$this->session->set_flashdata('status', 'Berhasil Checkout, dengan Kode Invoice : '.$invoice2['kode_invoice']);

		}else {
			$this->session->set_flashdata('status', 'Gagal Checkout');
		}
		redirect('App_controler/CTampilKeranjang');
	}


	public function CTampilPembayaran()
	{
		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MTampilPembayaran($id_user);
		$this->load->view('VPembayaran', ['data' => $data]);
	}

	public function CProsesTampilPembayaran($id_transaksi)
	{
		$data = $this->App_model->MProsesTampilBayar($id_transaksi);
		$this->load->view('VProsesPembayaran', ['data' => $data]);
	}

	public function CHapusPembayaran($id_transaksi)
	{
		$data = $this->App_model->MHapusPembayaran($id_transaksi);
		redirect('App_controler/CTampilPembayaran');
	}

	public function CProsesBayar($id_transaksi)
	{
		// $sql = $this->App_model->MProsesTampilBayar($id_transaksi);

		// $ambil_total_harga = $sql['total_harga'];
		// $ambil_bayar_transaksi = $sql['bayar_transaksi'];

		$bayar = $this->input->post('bayar');
		$ambil_total_harga = $this->App_model->MAmbilTotal($id_transaksi);
		$total_harga = $ambil_total_harga['total_harga'];
		

		$hasil = $this->App_model->MProsesBayar($id_transaksi, $bayar, $total_harga);




		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Pembayaran Berhasil ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembayaran');
		}

		redirect('App_controler/CProsesTampilPembayaran/'.$id_transaksi);
	}

	public function CTampilSelesai($id_transaksi)
	{
		$hasil = $this->App_model->MTampilSelesai($id_transaksi);

		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Data Berhasil Diperbaharui ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembaharuan');
		}

		redirect('App_controler/CTampilPembayaran/');
	}

	public function CProsesTampilPengambilan($id_transaksi)
	{
		$data = $this->App_model->MProsesTampilBayar($id_transaksi);
		$this->load->view('VProsesPengambilan', ['data' => $data]);
	}

	public function CProsesPengambilan($id_transaksi)
	{
		$hasil = $this->App_model->MProsesPengambilan($id_transaksi);

		if ($hasil == true) {
			$this->session->set_flashdata('status', 'Data Berhasil Diperbaharui ');

		}else {
			$this->session->set_flashdata('status', 'Gagal Melakukan Pembaharuan');
		}

		redirect('App_controler/CTampilPembayaran/');
	}

	public function CTampilLaporan()
	{
		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MTampilPembayaran($id_user);
		$this->load->view('VLaporan', ['data' => $data]);
	}

	public function CCariRange()
	{
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$id_user = $this->session->userdata('id_user');

		$data = $this->App_model->MCariRange($id_user, $tgl_awal, $tgl_akhir);
		$this->load->view('VLaporan', ['data' => $data]);
	}

	public function CPdf()
	{



	}

}

?>