<?php
include 'sidebar.php';
?>
<h1 class="h3 mb-0">
    Permohonan Pengambilan Akta
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Akta</th>
            <th>Nama Pemilik</th>
            <th>Nama Pemohon</th>
            <th>Status</th>
            <th>Modif By</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_riwayat = mysqli_query($conn, "
      SELECT rp.id_riwayat, rp.nomor_akta, rp.id_pemohon, rp.status, u.nik, 

             COALESCE(a.nama_pemilik, b.nama_pemilik, c.nama_pemilik, d.nama_pemilik) AS nama_pemilik,

             p.nama_pemohon

      FROM riwayat_pengambilan rp

      LEFT JOIN akta_b a ON rp.nomor_akta = a.nomor_akta

      LEFT JOIN akta_cu b ON rp.nomor_akta = b.nomor_akta

      LEFT JOIN akta_pn c ON rp.nomor_akta = c.nomor_akta

      LEFT JOIN akta_terbit d ON rp.nomor_akta = d.nomor_akta

      JOIN pemohon p ON rp.id_pemohon = p.id_pemohon

      JOIN user u ON rp.id_user = u.id_user

      WHERE p.nama_pemohon = '$nama_lengkap'

      ORDER BY rp.id_riwayat ASC
    ");

        while ($d = mysqli_fetch_array($data_riwayat)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nomor_akta']; ?></td>
                <td><?php echo $d['nama_pemilik']; ?></td>
                <td><?php echo $d['nama_pemohon']; ?></td>
                <td>

                    <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditStatus<?php echo $d['id_riwayat']; ?>">
                        <i class="fas fa-pencil-alt fa-xs mr-1"></i><?php echo $d['status']; ?>
                    </button>
                </td>
                <td><?php echo $d['nik']; ?></td>
            </tr>
        <?php
        };
        ?>
    </tbody>
</table>
<?php
include 'footer.php';
?>