<div class="col-md-3 white-box">
            <div class="card">
                <div class="card-header">
                    Administration Menu
                </div>

                <div class="card-body">
                    <ul class="nav flex-column" role="tablist">
                        @if($navigations)
                        @foreach($navigations as $menu)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ url($menu->url) }}">
                                    {{ $menu->name }}

                                </a>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <br/>
</div>


{{-- <div class="col-md-3">
    @foreach($laravelAdminMenus->menus as $section)
        @if($section->items)
            <div class="card">
                <div class="card-header">
                    {{ $section->section }}
                </div>

                <div class="card-body">
                    <ul class="nav flex-column" role="tablist">
                        @foreach($section->items as $menu)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ url($menu->url) }}">
                                    {{ $menu->title }}
                                    {{ $menu->url }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br/>
        @endif
    @endforeach
</div> --}}
