            <tr>
                <td class="content">
                    <h1>DATA KARYAWAN</h1>
                    <hr>
                    <table class="description">
                        <tr>
                            <td>Username</td>
                            <td><?= $user['nmuser']; ?></td>
                        </tr>
                        <tr>
                            <td>Kode Pengguna</td>
                            <td><?= $user['kduser']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pengguna</td>
                            <td><?= $user['nmuser']; ?></td>
                        </tr>
                        <tr>
                            <td>Departemen</td>
                            <td><?= $user['nmdept']; ?></td>
                        </tr>
                    </table>
                    <?php if ($_SESSION['nmdept'] == 'admin') : ?>
                            <h1>TAMBAH USER</h1>
                            <hr>
                            <?php
                                if ($_SESSION['error_code'] == '001') {
                                    echo 'Inputan Salah. Masukkan Data Lengkap dan Benar.';
                                }
                                else if ($_SESSION['error_code'] == '002') {
                                    echo 'User berhasil ditambahkan.';
                                }

                                $_SESSION['error_code'] = 0;
                            ?>
                        <form method="post" action="<?= site_url('auth/registration'); ?>">
                            <table class="login">
                                <tr>
                                    <td>Register a new user.</td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="kduser" name="kduser" placeholder="NIK"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="nmuser" name="nmuser" placeholder="Username"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="nmdept" name="nmdept" placeholder="Nama Departemen"></td>
                                </tr>
                                <tr>
                                    <td><input type="number" id="stsappr" name="stsappr" placeholder="Approval"></td>
                                </tr>
                                <tr>
                                    <td><input type="password" id="password1" name="password1" placeholder="Password"></td>
                                </tr>
                                <tr>
                                    <td><input type="password" id="password2" name="password2" placeholder="Repeat Password"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit"></td>
                                </tr>
                            </table>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>