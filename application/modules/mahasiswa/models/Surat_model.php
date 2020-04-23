<?php
class Surat_model extends CI_Model
{
    public function get_surat_bymahasiswa($id_mhs)
    {
       /* $query = $this->db->query("SELECT s.id, s.id_kategori_surat, k.kategori_surat, ss.id_status,  
        (SELECT status FROM status WHERE id=ss.id_status) as status, DATE_FORMAT(ss.date,'%d %M %Y') as date FROM surat s
        LEFT JOIN surat_status ss ON ss.id_surat = s.id
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        LEFT JOIN ci_users m ON m.id= s.id_mahasiswa
        WHERE s.id_mahasiswa = '$id_mhs'
        ORDER BY s.id DESC
        ");*/

        $query = $this->db->query("SELECT * FROM surat s
        ORDER BY s.id DESC"
        );

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
    public function tambah($data)
    {
        return $this->db->insert('surat', $data);
    }
}
