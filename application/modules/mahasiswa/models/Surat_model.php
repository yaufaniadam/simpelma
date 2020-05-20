<?php
class Surat_model extends CI_Model
{
    public function get_surat_bymahasiswa($id_mhs)
    {
      //  $query = $this->db->select('s.*, k.kategori_surat, ss.id_status, st.status')
        // $query = $this->db->select('s.*')
        //         ->from('surat s')
        //         ->join('surat_status ss','ss.id_surat = s.id','inner')
        //         // ->join('kategori_surat k','k.id = s.id_kategori_surat','left')
        //         // ->join('status st','st.id = ss.id_status','left')
        //         ->where('id_mahasiswa',$id_mhs)
        //         ->where('s.id',('SELECT max(ss2.id) FROM surat_status ss2 WHERE ss2.id_surat = s.id GROUP BY ss2.id_surat'))
        //         ->get();
        
        // return $result = $query->result_array();

        $query = $this->db->query("SELECT s.id as id_surat, ss.id_status, k.kategori_surat, st.status
        FROM surat s
        LEFT JOIN surat_status ss ON ss.id_surat = s.id
        LEFT JOIN status st ON st.id = ss.id_status
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        WHERE s.id_mahasiswa='$id_mhs' AND ss.id_status = (SELECT MAX(id_status) FROM surat_status WHERE id_surat=s.id) 
        ORDER BY s.id DESC        
        ");        
        return $result = $query->result_array();
    }
    public function get_detail_surat($id_surat)
    {
        $query = $this->db->query("SELECT s.id, s.id_kategori_surat, k.kategori_surat, k.kat_keterangan_surat, k.klien, ss.id_status, p.nama,p.nim FROM surat s
        LEFT JOIN profil p ON p.id_user = s.id_mahasiswa        
        LEFT JOIN surat_status ss ON ss.id_surat = s.id        
        LEFT JOIN status st ON st.id = ss.id_status
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        WHERE s.id = '$id_surat' AND ss.id_status= (SELECT MAX(id_status) FROM surat_status WHERE id_surat ='$id_surat')");
        return $result = $query->row_array();
    }
    public function get_kategori_surat($klien=0)
    {
        if($klien!='') {
            $query = $this->db->query("SELECT * FROM kategori_surat WHERE klien='$klien'");
        } else {
            $query = $this->db->query("SELECT * FROM kategori_surat");
        }
        
        return $result = $query->result_array();
    }
    public function get_keterangan_surat()
    {
        
    }
    public function tambah($data)
    {
        return $this->db->insert('surat', $data);
    }
    function simpan_upload($judul,$gambar){
        $hasil=$this->db->query("INSERT INTO keterangan_surat(ket_value,gambar) VALUES ('$judul','$gambar')");
        return $hasil;
    }

    

}
