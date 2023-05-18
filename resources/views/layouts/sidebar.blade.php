<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/power.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/ontime.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/power.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/ontime-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.home')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="las la-tachometer-alt"></i> <span>@lang('translation.dashboards')</span>
                    </a>
                    <!--<div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics" class="nav-link">@lang('translation.analytics')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm" class="nav-link">@lang('translation.crm')</a>
                            </li>
                            <li class="nav-item">
                                <a href="index" class="nav-link">@lang('translation.ecommerce')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto" class="nav-link">@lang('translation.crypto')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects" class="nav-link">@lang('translation.projects')</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft" class="nav-link" data-key="t-nft"> @lang('translation.nft') <span class="badge badge-pill bg-danger" data-key="t-new">@lang('translation.new')</span></a>
                            </li>
                        </ul>
                    </div>
                </li>--> <!-- end Dashboard Menu -->
                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.ficha')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/file/staff">
                        <i class="las la-user-tie"></i> <span>@lang('translation.staff')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/file/contracts">
                        <i class="lab la-buffer"></i> <span>@lang('translation.contracts')</span>
                    </a>
                </li>

                <!--<li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="las la-columns"></i> <span>@lang('translation.staff')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal" target="_blank" class="nav-link">@lang('translation.horizontal')</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached" target="_blank" class="nav-link">@lang('translation.detached')</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column" target="_blank" class="nav-link">@lang('translation.two-column')</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered" target="_blank" class="nav-link">@lang('translation.hovered')</a>
                            </li>
                        </ul>
                    </div>
                </li>--> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.form')</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-menu-add-line"></i> <span>@lang('translation.management')</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/form/areas" class="nav-link" role="button">@lang('translation.areas')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/form/charges" class="nav-link" role="button">@lang('translation.charges')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/payroll/tiposrol" class="nav-link" role="button">@lang('translation.role-types')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/payroll/assign-rubros" class="nav-link" role="button">@lang('translation.assign-rubros-role-types')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/form/rubros" class="nav-link" role="button">@lang('translation.rubros')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.payroll')</span></li>
                <!--<li class="nav-item">
                    <a class="nav-link menu-link" href="/payroll/tiposrol">
                        <i class="ri-t-box-line"></i> <span>@lang('translation.role-types')</span>
                    </a>
                </li>-->>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/form/periods">
                        <i class="ri-folders-fill"></i> <span>@lang('translation.periods')</span>
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link menu-link" href="widgets">
                        <i class="las la-comment-dollar"></i> <span>@lang('translation.fixed-rubros')</span>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/payroll/prestamos">
                        <i class="ri-hand-coin-fill"></i> <span>@lang('translation.prestamos')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/payroll/planilla">
                        <i class="las la-file-invoice"></i> <span>@lang('translation.planilla')</span>
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link menu-link" href="/payroll/rolpago">
                        <i class="las la-check-circle"></i> <span>@lang('translation.generate-payroll')</span>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRoles">
                        <i class="las la-check-circle"></i> <span>Roles</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRoles">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="/payroll/rolpago" class="nav-link" role="button">Generar Rol</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/payroll/nominas" class="nav-link" role="button">Roles</a>
                                </li>
                            </ul>
                    </div>
                </li>
                
                <!--<li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.process')</span></li>-->

                <!--<li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.reports')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets">
                        <i class="las la-flask"></i> <span>@lang('translation.payroll')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets">
                        <i class="las la-flask"></i> <span>@lang('translation.receipt-of-payment')</span>
                    </a>
                </li>-->

                <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.setting')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/setting/empresa">
                        <i class="ri-soundcloud-line"></i> <span>Compañia</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/setting/generalities">
                        <i class="las la-cog"></i> <span>@lang('translation.generalities')</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
