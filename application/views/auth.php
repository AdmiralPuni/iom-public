            <tr>
                <td class="content">
                    <?php 
                        if($_SESSION['error_code'] == '001'){
                            echo 'Wrong username or password.';
                        }
                    ?>
                    <form method="post" action="<?= site_url('auth'); ?>">
                        <table class="login">
                            <tr>
                                <td>Login</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="nmuser" name="nmuser" placeholder="Username"></td>
                            </tr>
                            <tr>
                                <td><input type="password" id="password" name="password" placeholder="Password"></td>
                            </tr>
                            <tr>
                                <td><input type="submit"></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
<?php include_once("components/footer.php") ?>