<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <?= $this->session->flashdata('message'); ?>

            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"><i class="fa fa-plus"></i> Tambah Submenu</a> -->

            <!-- <form method="GET" action="">
                <label for="tanggal">Tanggal : </label>
                <input type="date" name="tanggal" id="tanggal">
                <button class="btn btn-secondary text-center text-light mb-2" type="submit">Cek Jadwal</button>
            </form> -->

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Jadwal</th>
                        <th scope="col" class="text-center">Pelayanan</th>
                        <th scope="col" class="text-center">Deskripsi Motor</th>
                        <th scope="col" class="text-center">Biaya</th>
                        <th scope="col" class="text-center">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($getHistoryPerbaikan as $hp) : ?>
                        <tr>
                            <th class="text-center" scope="row"><?= $i; ?></th>
                            <td class="text-center"><?= $hp['tanggal']; ?></td>
                            <td class="text-center"><?= $hp['waktu_mulai']; ?> - <?= $hp['waktu_selesai']; ?></td>
                            <td class="text-center"><?= $hp['jenis_pelayanan']; ?></td>
                            <td class="text-center"><?= $hp['deskripsi_motor']; ?></td>
                            <td class="text-center">Rp.<?= number_format($hp['biaya'], 0, ',', '.'); ?></td>
                            <td>
                                <center>
                                    <a href="" class="badge badge-info" data-toggle="modal" data-target="#catatanPerbaikanModal<?= $hp['id']; ?>">Lihat</a>
                                </center>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Catatan -->
<?php $no = 0;
foreach ($getHistoryPerbaikan as $hp) : $no++; ?>
    <div class="modal fade" id="catatanPerbaikanModal<?= $hp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="catatanPerbaikanModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catatanPerbaikanModalTitle">Catatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea type="text" class="form-control" readonly><?= $hp['catatan']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>