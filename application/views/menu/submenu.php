<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"><i class="fa fa-plus"></i> Tambah Submenu</a>

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama submenu</th>
                        <th scope="col" class="text-center">Nama menu</th>
                        <th scope="col" class="text-center">Url</th>
                        <th scope="col" class="text-center">Icon</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $sm['title']; ?></td>
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($sm['menu_id'] == $m['id']) : ?>
                                    <td><?= $m['menu']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <?php if ($sm['is_active'] == 1) : ?>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span class="badge badge-success text-center text-light">
                                        Aktif
                                    </span>
                                </td>
                            <?php else : ?>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span class="badge badge-danger text-center text-light">
                                        Tidak Aktif
                                    </span>
                                </td>
                            <?php endif; ?>
                            <td>
                                <center>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>menu/hapusSubMenu/<?= $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
                                </center>
                            </td>
                        </tr>
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

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalTitle">Tambah Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama submenu">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                            <label for="is_active" class="form-check-label">
                                Apakah menu nya Aktif?
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

<!--Edit Modal -->
<?php $no = 0;
foreach ($subMenu as $sm) : $no++; ?>
    <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubMenuModalTitle">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('menu/editsubmenu'); ?>" method="post">
                        <!-- </?= form_open_multipart('menu/editMenu'); ?> -->
                        <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nama judul" value="<?= $sm['title'] ?>">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m == $menu['id']) : ?>
                                        <!-- <option value=""></?= $m['menu'] ?></option> -->
                                        <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Url" value="<?= $sm['url'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" value="<?= $sm['icon'] ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                                <label for="is_active" class="form-check-label">
                                    Apakah menu nya Aktif?
                                </label>
                            </div>
                        </div>
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