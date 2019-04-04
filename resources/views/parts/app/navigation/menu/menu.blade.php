<div class="sidebar-heading">{{ $key }}</div>
<ul class="sidebar-menu">
    @foreach($menu as $items)

        @foreach($items as $item)
            @include('parts.app.navigation.menu.item', $item)
        @endforeach

    @endforeach
</ul>
