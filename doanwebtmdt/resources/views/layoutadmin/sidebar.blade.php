<?php
$list_menu = config('menu-admin');
//dd($list_menu['blade']);
$mod_active=session('mod_active');
?>

<div id="sidebar" class="bg-white">
    <ul id="sidebar-menu">
        @if(!empty($list_menu))
        @foreach($list_menu['blade'] as $k=>$item)
        <li class="nav-link {{$mod_active==$item['module']?'active':''}}">
            <a href="{{route($item['route'])}}">
                <div class="nav-link-icon d-inline-flex">
                    <i class="{{$item['icon']}}"></i>
                </div>
                {{$item['name']}}
            </a>            
            @if(isset($item['items']))   
            <i class="arrow fas fa-angle-right"></i>        
            <ul class="sub-menu">
                @foreach($item['items'] as $subitem)
                <li>
                    <a href="{{route($subitem['route'])}}">                    
                    {{$subitem['name']}}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
        @endif
    </ul>
</div>