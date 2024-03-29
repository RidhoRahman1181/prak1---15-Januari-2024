<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<head>
    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>
<div class="col-sm-12">
    <div class="page-content-wrapper">


        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <ul class="list-inline float-left mb-0">
                            <h4 class="mt-e header-title">Data User</h4>
                        </ul>
                        <ul class="list-inline float-right mb-0">
                            <!-- Jam -->
                            <h6>
                                <?php
                                date_default_timezone_set("Asia/Bangkok");
                                ?>

                                <script type="text/javascript">
                                    function date_time(id) {
                                        date = new Date;
                                        year = date.getFullYear();
                                        month = date.getMonth();
                                        months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                        d = date.getDate();
                                        day = date.getDay();
                                        days = new Array('Ahad', 'Senen', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                                        h = date.getHours();
                                        if (h < 10) {
                                            h = "0" + h;
                                        }
                                        m = date.getMinutes();
                                        if (m < 10) {
                                            m = "0" + m;
                                        }
                                        s = date.getSeconds();
                                        if (s < 10) {
                                            s = "0" + s;
                                        }
                                        result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
                                        document.getElementById(id).innerHTML = result;
                                        setTimeout('date_time("' + id + '");', '1000');
                                        return true;
                                    }
                                </script>

                                <span id="date_time"></span>
                                <script type="text/javascript">
                                    window.onload = date_time('date_time');
                                </script>
                                <!-- Batas jam -->
                            </h6>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <div class="page-content-wrapper">


                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-header">
                                            <h4 class="mt-e header-title">Data User</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-sm btn-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                                            </div>
                                            <br>
                                            <div id="datatable_wrapper" class="dataTables repper container-fluid dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-sm table-striped " id="datapengurus">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th>NO</th>
                                                                    <th>ID</th>
                                                                    <th>Nama USER</th>
                                                                    <th>EMAIL</th>
                                                                    <th>LEVEL</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $no = 0;
                                                                foreach ($user as $val) {
                                                                    if ($val['level'] == '1') {
                                                                        $role = 'Admin';
                                                                    } else if ($val['level'] == '2') {
                                                                        $role = 'Donatur';
                                                                    } else if ($val['level'] == '3') {
                                                                        $role = 'Bendahara';
                                                                    } else if ($val['level'] == '4') {
                                                                        $role = 'Pimpinan';
                                                                    }
                                                                    $no++; ?>
                                                                    <tr role="row" class="odd">
                                                                        <td><?= $no; ?></td>
                                                                        <td><?= $val['id_user'] ?></td>
                                                                        <td><?= $val['nama_user'] ?></td>
                                                                        <td><?= $val['email'] ?></td>
                                                                        <td><?= $role ?></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-info btn-sm btn-edit" data-id_user="<?= $val['id_user']; ?>" data-nama="<?= $val['nama_user']; ?>" data-email="<?= $val['email']; ?>" data-password="<?= $val['password']; ?>" data-level="<?= $val['level']; ?>">
                                                                                <i class=" fa fa-tags"></i>
                                                                            </button>
                                                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id_user="<?= $val['id_user']; ?>">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete -->

                    <form action="/user/delete" method="post">
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus USER</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Apakah Yakin Menghapus Data Ini? </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Form Edit -->
                    <form action="/user/update" method="post">
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Data User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <label>ID</label>
                                            <input type="text" class="form-control id" name="id">
                                        </div>
                                        <div class="col-md-12">
                                            <label><b>Nama Usesr</b></label>
                                            <input type="text" class="form-control namauser" name="nama">
                                        </div>
                                        <div class="col-md-12">
                                            <label><b>Email</b></label>
                                            <input type="text" class="form-control email" name="email">
                                        </div>
                                        <div class="col-md-12">
                                            <label><b>Password</b></label>
                                            <input type="password" class="form-control password" name="pass">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <select name="level" class="form-control">
                                                    <Option value>Pilih Hak Akses</Option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Donatur</option>
                                                    <option value="3">Bendahara</option>
                                                    <option value="4">Pimpinan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Form Tambah -->

                    <form action="/user/save" method="post">
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h4>Periksa Entrian Form</h4>
                                </hr />
                                <?php echo session()->getFlashdata('error'); ?>
                                <button type="button" id="addModal" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">USER</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <label>ID</label>
                                            <input type="text" class="form-control" name="id_user">
                                        </div>
                                        <div class="col-md-12">
                                            <label>NAMA USER</label>
                                            <input type="text" class="form-control" name="nama_user">
                                        </div>
                                        <div class="col-md-12">
                                            <label>EMAIL</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                        <div class="col-md-12">
                                            <label>PASSWORD</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <select name="level" class="form-control">
                                                    <Option value>Pilih Hak Akses</Option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Donatur</option>
                                                    <option value="3">Bendahara</option>
                                                    <option value="4">Pimpinan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        //script delete
                        $('.btn-delete').on('click', function() {
                            const id = $(this).data('id_user');
                            $('.id').val(id);
                            $('#deleteModal').modal('show');
                        });

                        $('.btn-edit').on('click', function() {
                            const id = $(this).data('id_user');
                            const namauser = $(this).data('nama');
                            const email = $(this).data('email');
                            const password = $(this).data('password');
                            const level = $(this).data('level');

                            $('.id').val(id);
                            $('.namauser').val(namauser);
                            $('.email').val(email);
                            $('.password').val(password);
                            $('.level').val(level).trigger('change');
                            $('#updateModal').modal('show');
                        });

                        $(document).ready(function() {
                            $('#datapengurus').DataTable();
                        });
                    </script>
                    <?= $this->endSection('') ?>