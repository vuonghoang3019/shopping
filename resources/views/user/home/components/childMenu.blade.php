@if($categoryParent->categoryChild->count())
    <ul role="menu" class="sub-menu">
        @foreach($categoryParent->categoryChild as $categoryChild)
            <li>
                <a href="shop.html">{{ $categoryChild->name }}</a>
                @if($categoryChild->count())
                    @include('user.home.components.childMenu',['categoryParent' => $categoryChild])
                @endif
            </li>
        @endforeach
    </ul>
@endif
