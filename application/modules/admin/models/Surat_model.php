<?php
class Surat_model extends CI_Model
{
    public function get_surat()
    {
        $query = $this->db->query("SELECT ss.id, ss.id_surat,ss.id_status, st.status, s.id_kategori_surat, k.kategori_surat, s.id_mahasiswa, p.nama FROM surat_status ss
        LEFT JOIN surat s ON s.id = ss.id_surat
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        LEFT JOIN profil p ON p.id_user = s.id_mahasiswa
        LEFT JOIN keterangan_surat ks ON ks.id_surat = s.id
      
        LEFT JOIN status st ON st.id = ss.id_status
        WHERE ss.id in (SELECT max(ss.id) FROM surat_status ss  GROUP BY ss.id_surat)
        AND ss.id_status != 4
        ORDER BY s.id DESC");        
        return $result = $query->result_array();
    }
   
    public function get_detail_surat($id_surat)
    { 
        $query = $this->db->query("SELECT s.id, k.kategori_surat, k.klien, ss.id_status, p.nama,p.nim FROM surat s
        LEFT JOIN profil p ON p.id_user = s.id_mahasiswa        
        LEFT JOIN surat_status ss ON ss.id_surat = s.id        
        LEFT JOIN status st ON st.id = ss.id_status
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        WHERE s.id = '$id_surat' AND ss.id_status= (SELECT MAX(id_status) FROM surat_status WHERE id_surat ='$id_surat')");
        return $result = $query->row_array();
    }
    public function get_kategori_surat()
    {
        $query = $this->db->query("SELECT * FROM kategori_surat");
        return $result = $query->result_array();
    }
    public function tambah($data)
    {
        return $this->db->insert('surat', $data);
    }
}
