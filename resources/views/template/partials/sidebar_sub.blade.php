@foreach ($subMenus as $subMenu)
    @if (count($subMenu->subMenus))
        @can('read '.$subMenu->url)
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
            </span>
            <span class="menu-title">{{$subMenu->menu_name}}</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->

        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @include('template.partials.sidebar_sub',['subMenus' => $subMenu->subMenus])
        </div>
        <!--end:Menu sub-->

    </div>
    <!--end:Menu item-->
        @endcan
    @else
        @can('read '.$subMenu->url)
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="{{ url($subMenu->url) }}">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
            <span class="menu-title">{{$subMenu->menu_name}}</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
        @endcan
    @endif
@endforeach
