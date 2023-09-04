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
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-center">Jadwal</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Pelayanan</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($getSlotBengkel as $sb) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sb['tanggal']; ?></td>
                            <td><?= $sb['waktu_mulai']; ?> - <?= $sb['waktu_selesai']; ?></td>
                            <?php if ($sb['is_ready'] == 0) : ?>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span class="badge badge-dark text-center text-light">
                                        Tidak Tersedia
                                    </span>
                                </td>
                            <?php elseif ($sb['is_ready'] == 1) : ?>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span class="badge badge-success text-center text-light">
                                        Tersedia
                                    </span>
                                </td>
                            <?php elseif ($sb['is_ready'] == 3) : ?>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span class="badge badge-primary text-center text-light">Selesai</span>
                                </td>
                            <?php else : ?>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span class="badge badge-danger text-center text-light">
                                        Sudah dipesan
                                    </span>
                                </td>
                            <?php endif; ?>
                            <td><?= $sb['jenis_pelayanan']; ?></td>
                            <?php if ($sb['is_ready'] == 2) : ?>
                                <?php $id = $this->session->userdata('id');
                                if ($id == $sb['user_id']) :
                                ?>
                                    <td>
                                        <center>
                                            <a href="" class="badge badge-warning text-dark" data-toggle="modal" data-target="#batalkanSlotModal<?= $sb['id']; ?>">Batalkan</a>
                                        </center>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <span class="badge badge-info ml-5">Jadwal sudah di booking</span>
                                    </td>
                                <?php endif; ?>
                            <?php elseif ($sb['is_ready'] == 3) : ?>
                                <td>
                                    <center>
                                        <a href="<?= base_url('user/history') ?>" class="badge badge-info text-light">History</a>
                                    </center>
                                </td>
                            <?php else : ?>
                                <td>
                                    <center>
                                        <a href="" class="badge badge-primary" data-toggle="modal" data-target="#newSlotModal<?= $sb['id']; ?>">Pesan</a>
                                    </center>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Jadwal</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Pelayanan</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </tfoot>
            </table>
            <?= $this->pagination->create_links(); ?>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Reservasi Slot Modal -->
<?php $no = 0;
foreach ($getSlotBengkel as $sb) : $no++; ?>
    <div class="modal fade" id="newSlotModal<?= $sb['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newSlotModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSlotModalTitle">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/pesanReservasi'); ?>" method="post">
                        <!-- </?= form_open_multipart('menu/editMenu'); ?> -->
                        <input type="hidden" name="id" value="<?= $sb['id']; ?>">
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $sb['tanggal'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="<?= $sb['waktu_mulai'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="<?= $sb['waktu_selesai'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan" value="<?= $sb['jenis_pelayanan'] ?>" readonly>
                        </div>
                        <!-- input tabel service_slot -->
                        <input type="hidden" class="form-control" id="is_ready" name="is_ready" value="2">
                        <!-- input tabel reservasi -->
                        <input type="hidden" class="form-control" id="slot_id" name="slot_id" value="<?= $sb['id']; ?>">
                        <input type="hidden" class="form-control" id="slot_id" name="slot_id" value="<?= $sb['id']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Pesan</button>
                    <!-- </?= form_close(); ?> -->
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Batalkan Reservasi Modal -->
<?php $no = 0;
foreach ($getSlotBengkel as $sb) : $no++; ?>
    <div class="modal fade" id="batalkanSlotModal<?= $sb['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="batalkanSlotModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batalkanSlotModalTitle">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/batalkanReservasi'); ?>" method="post">
                        <!-- </?= form_open_multipart('menu/editMenu'); ?> -->
                        <input type="hidden" name="id" value="<?= $sb['id']; ?>">
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $sb['tanggal'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="<?= $sb['waktu_mulai'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="<?= $sb['waktu_selesai'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan" value="<?= $sb['jenis_pelayanan'] ?>" readonly>
                        </div>
                        <input type="hidden" class="form-control" id="is_ready" name="is_ready" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah anda yakin?')">Batalkan</button>
                    <!-- </?= form_close(); ?> -->
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>