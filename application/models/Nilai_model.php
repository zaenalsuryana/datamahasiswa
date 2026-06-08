<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nilai_model extends CI_Model {

    public function get_pengampu_by_dosen($dosen_id)
    {
        $this->db->select('p.*, mk.nama_mk');
        $this->db->from('pengampu p');
        $this->db->join('matakuliah mk', 'mk.mk_id = p.mk_id');
        $this->db->where('p.dosen_id', $dosen_id);
        return $this->db->get()->result();
    }

    public function get_pengampu($id)
    {
        $this->db->select('p.*, mk.nama_mk');
        $this->db->from('pengampu p');
        $this->db->join('matakuliah mk', 'mk.mk_id = p.mk_id');
        $this->db->where('p.pengampu_id', $id);
        return $this->db->get()->row();
    }

    public function get_mahasiswa_krs($pengampu_id)
    {
        $this->db->select('k.krs_id, m.nama, m.npm, n.nilai_angka, n.nilai_huruf, n.grade, m.mhs_id');
        $this->db->from('krs k');
        $this->db->join('penjadwalan pj', 'pj.jadwal_id = k.jadwal_id');
        $this->db->join('pengampu p', 'p.pengampu_id = pj.pengampu_id');
        $this->db->join('mahasiswa m', 'm.mhs_id = k.mhs_id');
        $this->db->join('nilai n', 'n.mhs_id = m.mhs_id AND n.mk_id = p.mk_id', 'left');
        $this->db->where('p.pengampu_id', $pengampu_id);

        return $this->db->get()->result();
    }

    public function simpan_nilai_batch($pengampu_id)
    {
        $mk_id = $this->get_pengampu($pengampu_id)->mk_id;
        $post = $this->input->post();

        foreach ($post['nilai'] as $mhs_id => $nilai) {
            $nilai_angka = $nilai['angka'];
            $nilai_huruf = $nilai['huruf'];
            $grade       = $nilai['grade'];

            // Cek apakah sudah ada
            $this->db->where('mhs_id', $mhs_id);
            $this->db->where('mk_id', $mk_id);
            $exists = $this->db->get('nilai')->row();

            $data = [
                'mhs_id'      => $mhs_id,
                'mk_id'       => $mk_id,
                'semester'    => $post['semester'],
                'nilai_angka' => $nilai_angka,
                'nilai_huruf' => $nilai_huruf,
                'grade'       => $grade
            ];

            if ($exists) {
                $this->db->where('nilai_id', $exists->nilai_id);
                $this->db->update('nilai', $data);
            } else {
                $this->db->insert('nilai', $data);
            }
        }
    }
}
