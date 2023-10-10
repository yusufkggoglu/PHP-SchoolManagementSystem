<?php

include('../elements/header.php');
include('../elements/sidebar.php');
include('../../database/count.class.php');
$count = new Count();
if ((isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin')) {
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="card-header">
            <h3 class="card-title">Hoşgeldiniz...</h3>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $count->countStudentForAdmin() ?></h3>

                            <p>Öğrenci</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $count->countTeacher() ?></h3>

                            <p>Sorumlu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $count->countClassForAdmin() ?></h3>
                            <p>Sınıf</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php }
if ((isset($_SESSION["role"]) && $_SESSION["role"] == 'Teacher')) {
?>
    ?>
    <div class="content-wrapper">
        <div class="card-header">
            <h3 class="card-title">Hoşgeldiniz...</h3>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $count->countStudentForTeacher($_SESSION['id']) ?></h3>

                            <p>Öğrenci</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $count->averageOfClass($_SESSION['id']) ?></h3>
                            <p>Sınıf Başarı Ortalaması</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php }
if ((isset($_SESSION["role"]) && $_SESSION["role"] == 'Student')) {
?>
    ?>
    <div class="content-wrapper">
        <div class="card-header">
            <h3 class="card-title">Hoşgeldiniz...</h3>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $count->countExam($_SESSION['id']) ?></h3>

                            <p>Sınav Sayısı</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $count->getAvgScoreByStudentId($_SESSION['id']) ?></h3>
                            <p>Genel Başarı Ortalaması</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } ?>
</div>

<?php include('../elements/footer.php'); ?>