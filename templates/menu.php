<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">

        <li>
            <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#patients"><i class="fa fa-fw fa-users"></i> Patients <i class="fa fa-fw fa-caret-down pull-right"></i></a>
            <ul id="patients" class="collapse">
                <li>
                    <a href="<?=asset('/patient_list.php')?>">List Patients</a>
                </li>
                <li>
                    <a href="<?= asset('/patient_add.php')?>">Add Patient</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#doctors"><i class="fa fa-fw fa-stethoscope"></i> Doctors <i class="fa fa-fw fa-caret-down pull-right"></i></a>
            <ul id="doctors" class="collapse">
                <li>
                    <a href="<?=asset('/doctor_list.php')?>">List Doctors</a>
                </li>
                <li>
                    <a href="<?= asset('/doctor_add.php')?>">Add Doctor</a>
                </li>
            </ul>
        </li>

<!--        <li>-->
<!--            <a href="javascript:;" data-toggle="collapse" data-target="#appointments"><i class="fa fa-fw fa-calendar"></i> Appointments <i class="fa fa-fw fa-caret-down pull-right"></i></a>-->
<!--            <ul id="appointments" class="collapse">-->
<!--                <li>-->
<!--                    <a href="--><?//=asset('/appointment_list.php')?><!--">List Appointments</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="--><?//= asset('/appointment_add.php')?><!--">Add Appointment</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->

        <li>
            <a href="appointments.php"><i class="fa fa-fw fa-calendar"></i> Appointments</a>
        </li>


    </ul>
</div>
<!-- /.navbar-collapse -->
</nav>