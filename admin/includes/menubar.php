<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE</li>
        
        <li><a href="attendance.php"><i class="fa fa-calendar"></i> <span>Attendance</span></a></li>
        <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'MANAGER'): ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Employees</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="holiday.php"><i class="fa fa-circle-o"></i> Holiday</a></li>
              <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'MANAGER'): ?>
                <li><a href="employee.php"><i class="fa fa-circle-o"></i> Emp List</a></li>
              <?php endif; ?>
              <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Overtime</a></li>
              <li><a href="undertime.php"><i class="fa fa-circle-o"></i> Undertime</a></li>
              <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'PAYROLL'): ?>
                <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Mandatory Deductions</a></li>
              <?php endif; ?>
              <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'MANAGER'): ?>
                <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Schedules</a></li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>
          <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'PAYROLL'): ?>
          <!-- <li><a href="deduction.php"><i class="fa fa-file-text"></i> <span> Other Deductions</span></a></li> -->
          <!-- <li><a href="allowance.php"><i class="fa fa-file-text"></i> <span> Allowances</span></a></li> -->
          <?php endif; ?>
          <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'MANAGER'): ?>
          <li><a href="position.php"><i class="fa fa-suitcase"></i> <span>Employee Roles</span></a></li>
          <?php endif; ?>

        <?php if ($user['useraccess'] == 'ADMIN' || $user['useraccess'] == 'MANAGER' || $user['useraccess'] == 'PAYROLL'): ?>
          <li class="header">PRINTABLES</li>
          <!-- <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payroll</span></a></li> -->
          <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Schedule</span></a></li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

