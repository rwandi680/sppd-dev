<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CetakModel extends Model
{

    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function getUsulanSubKeg($id)
    {
        $query = $this->db->query("SELECT
                uraian,
                progumum,
                kegumum,
                subkegumum,
                `level`,
                id
            FROM
                (
                SELECT
                    refprog.nama_program AS uraian,
                    refprog.is_umum AS progumum,
                    0 AS kegumum,
                    0 AS subkegumum,
                    1 AS `level`,
                    sub.id_usulan as id
                FROM
                    tbl_usulan_sub_kegiatan AS sub
                    LEFT JOIN tbl_ref_program AS refprog ON refprog.id_program = sub.id_program
                    
                UNION
                    
                SELECT
                    refkeg.nama_kegiatan AS uraian,
                    0 AS progumum,
                    refkeg.is_umum AS kegumum,
                    0 AS subkegumum,
                    2 AS `level`,
                    sub.id_usulan as id
                FROM
                    tbl_usulan_sub_kegiatan AS sub
                    LEFT JOIN tbl_ref_kegiatan AS refkeg ON refkeg.id_kegiatan = sub.id_kegiatan
                
                UNION
                
                SELECT
                    refsubkeg.nama_sub_kegiatan AS uraian,
                    0 AS progumum,
                    0 AS kegumum,
                    refsubkeg.is_umum AS subkegumum,
                    3 AS `level`,
                    sub.id_usulan as id
                FROM
                    tbl_usulan_sub_kegiatan AS sub
                    LEFT JOIN tbl_ref_sub_kegiatan AS refsubkeg ON refsubkeg.id_sub_kegiatan = sub.id_sub_kegiatan
                ) AS a 
            WHERE
                id = '$id'
            
            GROUP BY
                uraian
            ORDER BY 
                uraian
            ");
        return $query->getResult();
    }

    public function detilRincian($thn, $idUsulan, $idSkpd, $idSubUnit, $idSubKeg)
    {
        $query = $this->db->query(
            "SELECT 
                tingkat,
                kode_akun_1,
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5,
                nama_akun,
                pagu
            FROM (
            SELECT
                    1 AS tingkat,
                    a2.kode_akun AS kode_akun_1,
                    NULL AS kode_akun_2,
                    NULL AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    SUM(r.nominal_rincian) AS pagu 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 3 ) 
                WHERE
                    r.tahun = $thn 
                    AND r.id_usulan = $idUsulan 
                    AND r.id_skpd = $idSkpd 
                    AND r.id_sub_unit = $idSubUnit 
                    AND r.id_usulan_sub_kegiatan = $idSubKeg 
                GROUP BY kode_akun_1
                
                UNION ALL
                
                SELECT
                    2 AS tingkat,
                    SUBSTRING(a2.kode_akun, 1, 3) AS kode_akun_1,
                    a2.kode_akun AS kode_akun_2,
                    NULL AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    SUM(r.nominal_rincian) AS pagu 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 6 ) 
                WHERE
                    r.tahun = $thn 
                    AND r.id_usulan = $idUsulan 
                    AND r.id_skpd = $idSkpd 
                    AND r.id_sub_unit = $idSubUnit 
                    AND r.id_usulan_sub_kegiatan = $idSubKeg 
                GROUP BY kode_akun_1, kode_akun_2
                
                UNION ALL
                
                SELECT
                    3 AS tingkat,
                    SUBSTRING(a2.kode_akun, 1, 3) AS kode_akun_1,
                    SUBSTRING(a2.kode_akun, 1, 6) AS kode_akun_2,
                    a2.kode_akun AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    SUM(r.nominal_rincian) AS pagu 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 9 ) 
                WHERE
                    r.tahun = $thn 
                    AND r.id_usulan = $idUsulan 
                    AND r.id_skpd = $idSkpd 
                    AND r.id_sub_unit = $idSubUnit 
                    AND r.id_usulan_sub_kegiatan = $idSubKeg 
                GROUP BY kode_akun_1, kode_akun_2, kode_akun_3
                
                UNION ALL
                
                SELECT
                    4 AS tingkat,
                    SUBSTRING(a2.kode_akun, 1, 3) AS kode_akun_1,
                    SUBSTRING(a2.kode_akun, 1, 6) AS kode_akun_2,
                    SUBSTRING(a2.kode_akun, 1, 9) AS kode_akun_3,
                    a2.kode_akun AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    SUM(r.nominal_rincian) AS pagu 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 12 ) 
                WHERE
                    r.tahun = $thn 
                    AND r.id_usulan = $idUsulan 
                    AND r.id_skpd = $idSkpd 
                    AND r.id_sub_unit = $idSubUnit 
                    AND r.id_usulan_sub_kegiatan = $idSubKeg 
                GROUP BY kode_akun_1, kode_akun_2, kode_akun_3, kode_akun_4
                
                UNION ALL
                
                SELECT
                    5 AS tingkat,
                    SUBSTRING(a2.kode_akun, 1, 3) AS kode_akun_1,
                    SUBSTRING(a2.kode_akun, 1, 6) AS kode_akun_2,
                    SUBSTRING(a2.kode_akun, 1, 9) AS kode_akun_3,
                    SUBSTRING(a2.kode_akun, 1, 12) AS kode_akun_4,
                    a2.kode_akun AS kode_akun_5,
                    a2.nama_akun,
                    SUM(r.nominal_rincian) AS pagu 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = a1.kode_akun 
                WHERE
                    r.tahun = $thn 
                    AND r.id_usulan = $idUsulan 
                    AND r.id_skpd = $idSkpd 
                    AND r.id_sub_unit = $idSubUnit 
                    AND r.id_usulan_sub_kegiatan = $idSubKeg  
                GROUP BY kode_akun_1, kode_akun_2, kode_akun_3, kode_akun_4, kode_akun_5
                
                
            ) AS A
                
            ORDER BY kode_akun_1, kode_akun_2, kode_akun_3, kode_akun_4, kode_akun_5, tingkat
            "
        );

        return $query->getResult();
    }

    public function detilRincianRubah($thn, $idUsulan, $idSkpd, $idSubUnit, $idSubKeg, $idRefSubKeg)
    {
        $query = $this->db->query(
            "SELECT
            tingkat,
            kode_akun_1,
            kode_akun_2,
            kode_akun_3,
            kode_akun_4,
            kode_akun_5,
            nama_akun,
            pagu_murni,
            pagu_rubah 
        FROM
            (
            SELECT
                1 AS tingkat,
                kode_akun_1,
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5,
                nama_akun,
                SUM( pagu_murni ) AS pagu_murni,
                SUM( pagu_rubah ) AS pagu_rubah 
            FROM
                (
                SELECT
                    1 AS tingkat,
                    a2.kode_akun AS kode_akun_1,
                    NULL AS kode_akun_2,
                    NULL AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    SUM( m.nominal_rincian ) AS pagu_murni,
                    0 AS pagu_rubah 
                FROM
                    tbl_rincian_belanja_murni AS m
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = m.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 3 ) 
                WHERE
                    m.tahun = $thn 
                    AND m.id_skpd = $idSkpd 
                    AND m.id_sub_unit = $idSubUnit 
                    AND m.id_sub_kegiatan = $idRefSubKeg
                UNION ALL
                SELECT
                    1 AS tingkat,
                    a2.kode_akun AS kode_akun_1,
                    NULL AS kode_akun_2,
                    NULL AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    0 AS pagu_murni,
                    SUM( r.nominal_rincian ) AS pagu_rubah 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 3 ) 
                WHERE
                    r.tahun = $thn 
                    AND r.id_usulan = $idUsulan 
                    AND r.id_skpd = $idSkpd 
                    AND r.id_sub_unit = $idSubUnit 
                    AND r.id_usulan_sub_kegiatan = $idSubKeg 
                ) AS A 
            GROUP BY
                kode_akun_1 
            UNION ALL
            SELECT
                2 AS tingkat,
                kode_akun_1,
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5,
                nama_akun,
                SUM(pagu_murni),
                SUM(pagu_rubah) 
            FROM
                (
                SELECT
                    2 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    a2.kode_akun AS kode_akun_2,
                    NULL AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    m.nominal_rincian AS pagu_murni,
                    0 AS pagu_rubah 
                FROM
                    tbl_rincian_belanja_murni AS m
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = m.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 6 ) 
                WHERE
                    m.tahun = $thn 
                    AND m.id_skpd = $idSkpd 
                    AND m.id_sub_unit = $idSubUnit 
                    AND m.id_sub_kegiatan = $idRefSubKeg
                UNION ALL
                SELECT
                    2 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    a2.kode_akun AS kode_akun_2,
                    NULL AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    0 AS pagu_murni,
                    r.nominal_rincian AS pagu_rubah 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 6 ) 
                WHERE
                    r.tahun = 2021 
                    AND r.id_usulan = 3 
                    AND r.id_skpd = 1 
                    AND r.id_sub_unit = 1 
                    AND r.id_usulan_sub_kegiatan = 12 
                ) AS A 
            GROUP BY
                kode_akun_1, 
                kode_akun_2 
            UNION ALL
            SELECT
                3 AS tingkat,
                kode_akun_1,
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5,
                nama_akun,
                SUM(pagu_murni),
                SUM(pagu_rubah) 
            FROM
                (
                SELECT
                    3 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    SUBSTRING( a2.kode_akun, 1, 6 ) AS kode_akun_2,
                    a2.kode_akun AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    m.nominal_rincian AS pagu_murni,
                    0 AS pagu_rubah 
                FROM
                    tbl_rincian_belanja_murni AS m
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = m.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 9 ) 
                WHERE
                    m.tahun = $thn 
                    AND m.id_skpd = $idSkpd 
                    AND m.id_sub_unit = $idSubUnit 
                    AND m.id_sub_kegiatan = $idRefSubKeg
                UNION ALL
                SELECT
                    3 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    SUBSTRING( a2.kode_akun, 1, 6 ) AS kode_akun_2,
                    a2.kode_akun AS kode_akun_3,
                    NULL AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    0 AS pagu_murni,
                    r.nominal_rincian AS pagu_rubah 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 9 ) 
                WHERE
                    r.tahun = 2021 
                    AND r.id_usulan = 3 
                    AND r.id_skpd = 1 
                    AND r.id_sub_unit = 1 
                    AND r.id_usulan_sub_kegiatan = 12 
                ) AS A 
            GROUP BY
                kode_akun_1, 
                kode_akun_2,
                kode_akun_3
            UNION ALL
            SELECT
                4 AS tingkat,
                kode_akun_1,
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5,
                nama_akun,
                SUM(pagu_murni),
                SUM(pagu_rubah) 
            FROM
                (
                SELECT
                    4 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    SUBSTRING( a2.kode_akun, 1, 6 ) AS kode_akun_2,
                    SUBSTRING( a2.kode_akun, 1, 9 ) AS kode_akun_3,
                    a2.kode_akun AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    m.nominal_rincian AS pagu_murni,
                    0 AS pagu_rubah 
                FROM
                    tbl_rincian_belanja_murni AS m
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = m.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 12 ) 
                WHERE
                    m.tahun = $thn 
                    AND m.id_skpd = $idSkpd 
                    AND m.id_sub_unit = $idSubUnit 
                    AND m.id_sub_kegiatan = $idRefSubKeg
                UNION ALL
                SELECT
                    4 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    SUBSTRING( a2.kode_akun, 1, 6 ) AS kode_akun_2,
                    SUBSTRING( a2.kode_akun, 1, 9 ) AS kode_akun_3,
                    a2.kode_akun AS kode_akun_4,
                    NULL AS kode_akun_5,
                    a2.nama_akun,
                    0 AS pagu_murni,
                    r.nominal_rincian AS pagu_rubah 
                FROM
                    tbl_usulan_rincian_belanja AS r
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = SUBSTRING( a1.kode_akun, 1, 12 ) 
                WHERE
                    r.tahun = 2021 
                    AND r.id_usulan = 3 
                    AND r.id_skpd = 1 
                    AND r.id_sub_unit = 1 
                    AND r.id_usulan_sub_kegiatan = 12 
                ) AS A 
            GROUP BY
                kode_akun_1, 
                kode_akun_2,
                kode_akun_3,
                kode_akun_4
                
                UNION ALL
                
                SELECT
                5 AS tingkat,
                kode_akun_1,
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5,
                nama_akun,
                SUM(pagu_murni),
                SUM(pagu_rubah) 
            FROM
                (
                SELECT
                    5 AS tingkat,
                    SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                    SUBSTRING( a2.kode_akun, 1, 6 ) AS kode_akun_2,
                    SUBSTRING( a2.kode_akun, 1, 9 ) AS kode_akun_3,
                    SUBSTRING( a2.kode_akun, 1, 12 ) AS kode_akun_4,
                    a2.kode_akun AS kode_akun_5,
                    a2.nama_akun,
                    m.nominal_rincian AS pagu_murni,
                    0 AS pagu_rubah 
                FROM
                    tbl_rincian_belanja_murni AS m
                    LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = m.id_ref_akun
                    LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = a1.kode_akun
                WHERE
                    m.tahun = $thn 
                    AND m.id_skpd = $idSkpd 
                    AND m.id_sub_unit = $idSubUnit 
                    AND m.id_sub_kegiatan = $idRefSubKeg
                UNION ALL
                SELECT
                4 AS tingkat,
                SUBSTRING( a2.kode_akun, 1, 3 ) AS kode_akun_1,
                SUBSTRING( a2.kode_akun, 1, 6 ) AS kode_akun_2,
                SUBSTRING( a2.kode_akun, 1, 9 ) AS kode_akun_3,
                SUBSTRING( a2.kode_akun, 1, 12 ) AS kode_akun_4,
                a2.kode_akun AS kode_akun_5,
                a2.nama_akun,
                0 AS pagu_murni,
                r.nominal_rincian AS pagu_rubah 
            FROM
                tbl_usulan_rincian_belanja AS r
                LEFT JOIN tbl_ref_akun AS a1 ON a1.id_ref_akun = r.id_ref_akun
                LEFT JOIN tbl_ref_akun AS a2 ON a2.kode_akun = a1.kode_akun 
                WHERE
                    r.tahun = 2021 
                    AND r.id_usulan = 3 
                    AND r.id_skpd = 1 
                    AND r.id_sub_unit = 1 
                    AND r.id_usulan_sub_kegiatan = 12 
                ) AS A 
            GROUP BY
                kode_akun_1, 
                kode_akun_2,
                kode_akun_3,
                kode_akun_4,
                kode_akun_5 
                
            ) AS C
            ORDER BY
            kode_akun_1,
            kode_akun_2,
            kode_akun_3,
            kode_akun_4,
            kode_akun_5,
            tingkat
            "
        );

        return $query->getResult();
    }
}
