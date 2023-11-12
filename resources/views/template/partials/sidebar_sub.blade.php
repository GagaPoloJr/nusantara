@forelse ($subMenus as $index => $subMenu)
    @can('read '.$subMenu->url)

        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ $subMenu->url }}" class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{$subMenu->sub_menu_name}}</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        @endcan

    @empty

@endforelse
<div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show">
    <!--begin:Menu link-->
    <span href="vehicles" class="menu-link">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title">Master</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->

    <div class="menu-sub menu-sub-accordion">
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="vehicles">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
            <span class="menu-title">Registrasi Kendaraan</span>
        </a>
        <!--end:Menu link-->
    </div>
    </div>
</div>


