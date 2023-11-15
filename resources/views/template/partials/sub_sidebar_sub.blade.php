
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
        @foreach($menu_vehicles as $key => $item)
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="/{{ $item['link'] }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{ $item['name'] }}</span>
            </a>
            <!--end:Menu link-->
        </div>
        @endforeach
    </div>
</div>
