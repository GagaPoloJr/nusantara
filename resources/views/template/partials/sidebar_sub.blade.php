@forelse ($subMenus as $subMenu)
    {{-- @can('read '.$subMenu->url) --}}
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a href="{{ $subMenu->url }}" class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{$subMenu->sub_menu_name}}</span>
                {{-- <span class="menu-arrow"></span> --}}
            </a>
            <!--end:Menu link-->

            {{-- <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                @include('template.partials.sidebar_sub',['subMenus' => $subMenu->subMenus])
            </div>
            <!--end:Menu sub--> --}}
        </div>
        <!--end:Menu item-->
    {{-- @endcan --}}
@empty
  
@endforelse
