
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">{{ __('Navigation')}}</div>
        <ul class="pcoded-item pcoded-left-item">

            <!--Dahboard menu link-->
            <li class="{{Request::is('admin') ? 'active ' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" >{{ __('Dashboard')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <!--Industry and jobs menu link-->
            <li class="{{Request::is('admin.industryJobs') ? 'active ' : '' }}">
                <a href="{{ route('admin.industryJobs') }}">
                    <span class="pcoded-micon"><i class="ti-package"></i><b>I</b></span>
                    <span class="pcoded-mtext" >{{ __('Industry & jobs')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <!--Questions menu link-->
            <li class="">
                <a href="{{route('admin.question')}}">
                    <span class="pcoded-micon"><i class="ti-help"></i><b>D</b></span>
                    <span class="pcoded-mtext" >{{__('Questions')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <!--Users menu link-->
            <li class="">
                <a href="index.html">
                    <span class="pcoded-micon"><i class="ti-user"></i><b>D</b></span>
                    <span class="pcoded-mtext" >{{ __('Users')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <!-- CMS menu link-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-plug"></i><b>{{ __('CMS')}}</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.extra-components.main">{{ __('CMS')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('admin.cms.pages')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" >{{ __('Pages')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="session-idle-timeout.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.extra-components.session-idle-timeout">{{ __('In the media')}}</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!--Education menu link-->
            <li class="">
                <a href="index.html">
                    <span class="pcoded-micon"><i class="ti-book"></i><b>D</b></span>
                    <span class="pcoded-mtext" >{{ __('Education')}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul>
    </div>
</nav>