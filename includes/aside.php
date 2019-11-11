    <aside>

    <?php 
        $usuario = $_SESSION['usuario'];
        if(!empty($usuario)): ?>
                <section class="logged">
                    <h2>Bienvenido, <?= $usuario['email'] ?></h2>
                    <a href="" class="add-buy logged-button">Realizar compra</a>
                    <?php if($usuario['rol'] == 'Admin'): ?>
                        <a href="list_users.php" class="logged-button">Usuarios</a>
                        <a href="" class="logged-button">Productos</a>
                        <a href="" class="logged-button">Vendedores</a>
                    <?php endif; ?>
                    <a href="logout.php" class="logged-button">Cerrar sesión</a>
                </section>
        <?php endif; ?>

        <?php if(empty($usuario)): ?>
                <section class="login">
                    <h2>Conectarse</h2>
                    <form action="login.php" method="post" class="form-login">
                        <label>Nombre de usuario: <input name="username" type="email" ></label>

                        <?php
                            if(!empty($_SESSION['errores'])) {
                                echo showErrors($_SESSION['errores'], 'username');
                            }
                        ?>

                        <label>Contraseña: <input name="password" type="password"  ></label>

                        <?php
                            if(!empty($_SESSION['errores'])) {
                                echo showErrors($_SESSION['errores'], 'password');
                                echo showErrors($_SESSION['errores'], 'usuario');
                            } 
                            
                        ?>

                        <input type="submit" class="login-button" value="Entrar">
                    </form>
                </section>
        <?php endif; ?>

        

        <!-- <section class="register">
            <h2>Conectarse</h2>
            <form action="" method="post">
                <label>Nombre de usuario: <input type="text"></label>
                <label>Contraseña: <input type="text"></label>
                <input type="submit" value="Entrar">
            </form>
        </section> -->

    </aside>
</div>