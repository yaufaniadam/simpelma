<?php
class Surat_model extends CI_Model
{
    public function get_surat()
    {
        if($this->session->userdata('role') == 1) {
            $prodi ='';
        } else {            
            $prodi = "AND p.id_prodi = '" . $this->session->userdata('id_prodi') ."'";
        }
        $query = $this->db->query("SELECT s.id as id_surat, s.id_mahasiswa, p.nama, ss.id_status, k.kategori_surat, st.status, st.badge, DATE_FORMAT(ss.date, '%d %M') as date,  DATE_FORMAT(ss.date, '%H:%i') as time,  DATE_FORMAT(ss.date, '%d %M %Y') as date_full, pr.prodi
        FROM surat s
        LEFT JOIN profil p ON p.id_user = s.id_mahasiswa
        LEFT JOIN surat_status ss ON ss.id_surat = s.id
        LEFT JOIN status st ON st.id = ss.id_status
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        LEFT JOIN prodi pr ON pr.id = p.id_prodi        
        WHERE ss.id_status = (SELECT MAX(id_status) FROM surat_status WHERE id_surat=s.id)
        AND ss.id_status != 1
        $prodi
        ORDER BY s.id DESC      
        ");        
        return $result = $query->result_array();
    }
   
    public function get_detail_surat($id_surat)
    { 
        $query = $this->db->query("SELECT s.id, k.kategori_surat, k.klien, ss.id_status, st.status, st.badge, p.nama,p.nim, p.photo,  k.kat_keterangan_surat, pr.prodi FROM surat s
        LEFT JOIN profil p ON p.id_user = s.id_mahasiswa        
        LEFT JOIN surat_status ss ON ss.id_surat = s.id        
        LEFT JOIN status st ON st.id = ss.id_status
        LEFT JOIN kategori_surat k ON k.id = s.id_kategori_surat
        LEFT JOIN prodi pr ON pr.id = p.id_prodi
        WHERE s.id = '$id_surat' AND ss.id_status= (SELECT MAX(id_status) FROM surat_status WHERE id_surat ='$id_surat')");
        return $result = $query->row_array();
    }
    public function get_kategori_surat()
    {
        $query = $this->db->query("SELECT * FROM kategori_surat");
        return $result = $query->result_array();
    }
    public function get_kategori_surat_byid($id)
    {
        $query = $this->db->query("SELECT * FROM kategori_surat where id='$id'");
        return $result = $query->row_array();
    }
    public function edit_kategori_surat($data, $id)
    {
        return $this->db->update('kategori_surat', $data, array('id'=>$id));
    }
    public function tambah($data)
    {
        return $this->db->insert('surat', $data);
    }

    public function get_surat_status($id_surat)
    {
        return $this->db->select('ss.*, DATE_FORMAT(ss.date,"%d %M %Y") as date, st.status')
            ->from('surat_status ss')
            ->join('status st','ss.id_status=st.id','left')
            ->where(array('ss.id_surat'=>$id_surat,'ss.id_status !='=>'0','ss.id_status !='=>'1'))->get()->result_array();
    }

    //class Kategori
    public function get_kat_keterangan_surat() {
        return $this->db->get('kat_keterangan_surat')->result_array();
    }
}
