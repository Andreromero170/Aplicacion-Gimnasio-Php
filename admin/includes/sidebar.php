<div id="sidebar">
  <a href="#" class="visible-phone"><i class="fas fa-home"></i> Panel de Control</a>
  <ul>
    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Panel de Control</span></a> </li>
   
    <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span>Gestionar Usuarios</span> <span class="label label-important"><?php include 'dashboard-usercount2.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='users'){ echo 'active'; }?>"><a href="list-users.php"><i class="fas fa-arrow-right"></i> Listar Todos los Usuarios</a></li>
        <li class="<?php if($page=='users-entry'){ echo 'active'; }?>"><a href="user-entry.php"><i class="fas fa-arrow-right"></i> Formulario de Entrada de Usuarios</a></li>
        <li class="<?php if($page=='users-rols'){ echo 'active'; }?>"><a href="user-rols.php"><i class="fas fa-arrow-right"></i> Asignar Permisos o Roles</a></li>
      </ul>
    </li>
   
    <li class="submenu"> <a href="#"><i class="fas fa-users"></i> <span>Gestionar Miembros</span> <span class="label label-important"><?php include 'dashboard-usercount.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='members'){ echo 'active'; }?>"><a href="members.php"><i class="fas fa-arrow-right"></i> Listar Todos los Miembros</a></li>
        <li class="<?php if($page=='members-entry'){ echo 'active'; }?>"><a href="member-entry.php"><i class="fas fa-arrow-right"></i> Formulario de Entrada de Miembros</a></li>
        <li class="<?php if($page=='members-documents'){ echo 'active'; }?>"><a href="archive-member.php"><i class="fas fa-archive"></i> Añadir Archivos</a></li>
        <li class="<?php if($page=='members-list-documents'){ echo 'active'; }?>"><a href="files.php"><i class="fas fa-archive"></i> Listar Archivos</a></li>
     
        <li class="<?php if($page=='members-remove'){ echo 'active'; }?>"><a href="member-group-remove.php"><i class="fas fa-arrow-right"></i> Eliminar Grupos y Servicios</a></li>
        <li class="<?php if($page=='members-update'){ echo 'active'; }?>"><a href="member-group.php"><i class="fas fa-arrow-right"></i>Lista de Miembros por Grupos</a></li>
        <li class="<?php if($page=='members-attendence'){ echo 'active'; }?>"><a href="members-attendence.php"><i class="fas fa-arrow-right"></i> Listado de Asistencia</a></li>
        <li class="<?php if($page=='members-details'){ echo 'active'; }?>"><a href="detalles_miembros.php"><i class="fas fa-arrow-right"></i> Listado de Pagos Miembros</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="fa fa-user-plus"></i> <span>Ges. Grupos y Servicios</span> <span class="label label-important"><?php include 'dashboard-usercount.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='groups'){ echo 'active'; }?>"><a href="groups.php"><i class="fas fa-arrow-right"></i> Listar Todos los Grupos</a></li>
        <li class="<?php if($page=='tarifa'){ echo 'active'; }?>"><a href="services.php"><i class="fas fa-arrow-right"></i> Listar Todos los Servicios</a></li>
        <li class="<?php if($page=='group-service-entry'){ echo 'active'; }?>"><a href="group_service.php"><i class="fas fa-arrow-right"></i> Formulario de Entrada</a></li>
      </ul>
    </li>



 
    <li class="<?php if($page=='attendance'){ echo 'submenu active'; } else { echo 'submenu';}?>"> <a href="#"><i class="fas fa-calendar-alt"></i> <span>Gestionar Eventos</span></a>
      <ul>
        <li class="<?php if($page=='attendance'){ echo 'active'; }?>"><a href="event.php"><i class="fas fa-arrow-right"></i> Registro de Entrada</a></li>
        <li class="<?php if($page=='view-attendance'){ echo 'active'; }?>"><a href="events.php"><i class="fas fa-arrow-right"></i> Ver Eventos</a></li>
        <li class="<?php if($page=='view-attendance'){ echo 'active'; }?>"><a href="persons.php"><i class="fas fa-arrow-right"></i> Ver Personas</a></li>
        <li class="<?php if($page=='view-attendance'){ echo 'active'; }?>"><a href="inscripciones.php"><i class="fas fa-arrow-right"></i> Entrada Inscripciones</a></li>
        <li class="<?php if($page=='view-attendance'){ echo 'active'; }?>"><a href="inscripciones-list.php"><i class="fas fa-arrow-right"></i> Listado Eventos</a></li>
      </ul>
    </li>




    
    <li class="<?php if($page=='attendance'){ echo 'submenu active'; } else { echo 'submenu';}?>"> <a href="#"><i class="fas fa-credit-card"></i> <span>Gestionar Ventas</span></a>
      <ul>
        <li class="<?php if($page=='shop'){ echo 'active'; }?>"><a href="shop.php"><i class="fas fa-arrow-right"></i> Registro de Entrada</a></li>
        <li class="<?php if($page=='view-shop'){ echo 'active'; }?>"><a href="shops.php"><i class="fas fa-arrow-right"></i> Ver Ventas</a></li>
        <li class="<?php if($page=='view-shop'){ echo 'active'; }?>"><a href="products.php"><i class="fas fa-arrow-right"></i> Ver Productos</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="fas fa-money-bill-wave"></i> <span>Gestionar Ganancias</span> <span class="label label-important"><?php include 'dashboard-usercount2.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='egreso'){ echo 'active'; }?>"><a href="egreso-entry.php"><i class="fas fa-arrow-right"></i> Entrada de Egresos</a></li>
        <li class="<?php if($page=='ingreso'){ echo 'active'; }?>"><a href="list-egreso.php"><i class="fas fa-arrow-right"></i> Lista de Egresos</a></li>
      </ul>
    </li>

</div>
