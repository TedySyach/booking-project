<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_detail_model extends CI_Model{

	function get_jam_mulai_terpakai($tanggal, $lapangan_id){
		$this->db->select('jam_mulai, durasi, jam_selesai,status');
		$this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
		$this->db->where('tanggal', $tanggal);
		$this->db->where('lapangan_id', $lapangan_id);
			$this->db->where('(status = "1" OR status = "2")'); // Gunakan operator OR untuk status 1 atau 2
		return $query = $this->db->get('transaksi_detail')->result();

		// $sql = "
		// 		SELECT
		// 			jam_mulai, durasi, jam_selesai
		// 		FROM futsal_transaksi_detail
		// 		where
		// 			tanggal = ? and lapangan_id = ?
		// 		";
		// $query = $this->db->query($sql, array($tanggal, $lapangan_id));
		//
		// return $query->result();
	}
	
	function get_jam_selesai_terpakai($tanggal, $lapangan_id, $jam_selesai) {
		$this->db->select('jam_mulai, durasi, jam_selesai, status');
		$this->db->join('transaksi', 'transaksi_detail.trans_id = transaksi.id_trans');
		$this->db->where('tanggal', $tanggal);
		$this->db->where('lapangan_id', $lapangan_id);
		$this->db->where('status', '2');
		$this->db->where('jam_mulai', $jam_selesai);
		$query = $this->db->get('transaksi_detail');
	
		// Menghitung jumlah baris (record) yang dihasilkan
		$num_rows = $query->num_rows();
	
		return $num_rows;
	}
}
