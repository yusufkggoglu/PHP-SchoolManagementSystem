        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link">
                <img src="../assets/dist/img/yavuzlar.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Siber Vatan</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['username'] ?></a>
                        <a href="#" class="d-block"><?php echo $_SESSION['role'] ?></a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin') || $_SESSION["role"] == 'Teacher') { ?>
                            <li class="nav-item">
                            <li class="nav-item">
                                <a href="/yetkinlik_merkezi/views/login/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Anasayfa</p>
                                </a>
                            </li>
                            </li>
                            <li class="nav-item">
                            <li class="nav-item">
                                <a href="/yetkinlik_merkezi/views/student/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Öğrenci Sayfası</p>
                                </a>
                            </li>
                            </li>
                            <li class="nav-item">
                            <li class="nav-item">
                                <a href="/yetkinlik_merkezi/views/lesson/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ders Sayfası</p>
                                </a>
                            </li>
                            </li>
                        <?php } ?>
                        <?php if ((isset($_SESSION["role"]) &&  $_SESSION["role"] == 'Admin')) { ?>
                            <li class="nav-item">
                            <li class="nav-item">
                                <a href="/yetkinlik_merkezi/views/teacher/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sorumlu Sayfası</p>
                                </a>
                            </li>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="/yetkinlik_merkezi/views/class/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sınıf Sayfası</p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="/yetkinlik_merkezi/views/exam/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sınav Sayfası</p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="/yetkinlik_merkezi/views/login/profile.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="/yetkinlik_merkezi/views/logout.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Çıkış</p>
                            </a>
                        </li>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>