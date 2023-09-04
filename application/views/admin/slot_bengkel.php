<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSlotModal"><i class="fa fa-plus"></i> Tambah Slot Bengkel</a>

            <!-- <form method="GET" action="">
                <label for="tanggal">Tanggal : </label>
                <input type="date" name="tanggal" id="tanggal">
                <button class="btn btn-secondary text-center text-light mb-2" type="submit">Cek Jadwal</button>
            </form> -->

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-center">Tanggal</th>
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
                            <td>
                                <center>
                                    <?php if ($sb['is_ready'] == 2) : ?>
                                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#selesaiModal<?= $sb['id']; ?>">Selesai</a>
                                    <?php endif; ?>
                                    <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editSubMenuModal<?= $sb['id']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>user/hapusSlotBengkel/<?= $sb['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                </center>
                            </td>
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

<!-- Modal Add Data -->
<div class="modal fade" id="newSlotModal" tabindex="-1" role="dialog" aria-labelledby="newSlotModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSlotModalTitle">Tambah Ketersediaan Slot Bengkel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/slot_bengkel'); ?>" method="post">
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <input type="time" id="waktu_mulai" name="waktu_mulai"> - <input type="time" id="waktu_selesai" name="waktu_selesai">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan" placeholder="Jenis pelayanan">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" name="is_ready" id="is_ready" checked>
                            <label for="is_active" class="form-check-label">
                                Apakah tersedia?
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<?php $no = 0;
foreach ($getSlotBengkel as $sb) : $no++; ?>
    <div class="modal fade" id="editSubMenuModal<?= $sb['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubMenuModalTitle">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/editslotbengkel'); ?>" method="post">
                        <!-- </?= form_open_multipart('menu/editMenu'); ?> -->
                        <input type="hidden" name="id" value="<?= $sb['id']; ?>">
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $sb['tanggal'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" value="<?= $sb['waktu_mulai'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" value="<?= $sb['waktu_selesai'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan" value="<?= $sb['jenis_pelayanan'] ?>">
                        </div>
                        <?php if ($sb['is_ready'] == 1) : ?>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="1" name="is_ready" id="is_ready" checked>
                                    <label for="is_active" class="form-check-label">
                                        Apakah tersedia?
                                    </label>
                                </div>
                            </div>
                        <?php elseif ($sb['is_ready'] == 2) : ?>
                            <input type="hidden" name="is_ready" value="2">
                        <?php elseif ($sb['is_ready'] == 3) : ?>
                            <input type="hidden" name="is_ready" value="3">
                        <?php else : ?>
                            <input type="hidden" name="is_ready" value="0">
                        <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <!-- </?= form_close(); ?> -->
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Selesai Modal -->
<?php $no = 0;
foreach ($getSlotBengkel as $sb) : $no++; ?>
    <div class="modal fade" id="selesaiModal<?= $sb['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="selesaiModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selesaiModalTitle">Perbaikan selesai?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('user/selesaiPerbaikan'); ?>" method="post">
                        <input type="hidden" name="id" value="<?= $sb['id']; ?>">
                        <input type="hidden" name="reservasi_id" value="<?= $sb['reservasi_id']; ?>">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="tanggal" name="tanggal" value="<?= $sb['tanggal'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="waktu_mulai" name="waktu_mulai" value="<?= $sb['waktu_mulai'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="waktu_selesai" name="waktu_selesai" value="<?= $sb['waktu_selesai'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="jenis_pelayanan" name="jenis_pelayanan" value="<?= $sb['jenis_pelayanan'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="deskripsi_motor" name="deskripsi_motor" placeholder="Deskripsi Motor">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="biaya" name="biaya" placeholder="Biaya">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-check-input" value="3" name="is_ready" id="is_ready">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Selesai</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    // Dapatkan tanggal hari ini dalam format "YYYY-MM-DD"
    var today = new Date().toISOString().split('T')[0];

    // Daoatkan waktu sekarang dalam format "HH:MM" dengan waktu indonesia
    // var now = new Date().toLocaleString('en-US', {
    //     timeZone: 'Asia/Jakarta',
    //     hour12: false
    // }).slice(11, 16);

    // Dapatkan waktu sekarang dalam format "HH:MM dengan waktu Indonesia
    // var end = new Date();
    // end.setHours(end.getHours() + 2); // Tambahkan 2 jam
    // var endTime = end.toLocaleTimeString('en-US', {
    //     timeZone: 'Asia/Jakarta',
    //     hour12: false
    // }).slice(11, 16);

    // Set nilai awal input waktu dengan waktu sekarang di waktu Indonesia
    // document.getElementById("slot_end").value = endTime;

    // Dapatkan waktu sekarang dalam format "YYYY-MM-DDTHH:MM"
    // var now = new Date().toISOString.slice(0, 16);

    // Set nilaiawal input tanggal dengan tanggal hari ini
    document.getElementById("tanggal").value = today;

    // Set nilai awal input waktu dengan waktu sekarang di waktu Indonesia
    // document.getElementById("slot_start").value = now;
</script>