<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="index.html" class="app-brand-link">
             <span class="app-brand-logo demo">
                 <span class="text-primary">

                 </span>
             </span>
             <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
             <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
         </a>
     </div>

     <div class="menu-divider mt-0"></div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboards -->
         <li class="menu-item">
             <a href="{{ route('laradmin.dashboard') }}" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-home-smile"></i>
                 <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
             </a>
             <a href="{{ route('laradmin.roles.index') }}" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-home-smile"></i>
                 <div class="text-truncate" data-i18n="Roles">Roles</div>
             </a>
             <a href="{{ route('laradmin.users.index') }}" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-home-smile"></i>
                 <div class="text-truncate" data-i18n="Users">Users</div>
             </a>
             <ul class="menu-sub">
                 {{-- <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <div class="text-truncate" data-i18n="Analytics">Analytics</div>
                    </a>
                </li> --}}
             </ul>
         </li>
     </ul>
 </aside>
