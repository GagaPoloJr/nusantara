@foreach ($subMenus as $index => $subMenu)

@can('read '.$subMenu->url)
<!--begin:Menu item-->
<div class="menu-item">
    <!--begin:Menu link-->
    <a href="/{{ $subMenu->url }}" class="menu-link">
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title">{{$subMenu->sub_menu_name}}</span>
    </a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->
@endcan
@endforeach

