<div breadcrumbs-mobile="">
    <a href="{{ route('home') }}" breadcrumbs-mobile-home-link="" js-breadcrumbs-mobile-home-link="">
        <span breadcrumbs-mobile-home-icon="">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.185 18">
                <path class="a"
                    d="M.7,37.072H2.341v6.576a.707.707,0,0,0,.7.7H7.861a.707.707,0,0,0,.7-.7V38.834H11.5v4.815a.707.707,0,0,0,.7.7h4.58a.707.707,0,0,0,.7-.7V37.072h2a.7.7,0,0,0,.493-1.2L10.8,26.562a.7.7,0,0,0-.986-.012L.216,35.863a.705.705,0,0,0-.164.775A.687.687,0,0,0,.7,37.072Zm9.583-9.019,7.516,7.61h-1.01a.707.707,0,0,0-.7.7v6.576H12.911V38.129a.707.707,0,0,0-.7-.7H7.861a.707.707,0,0,0-.7.7v4.815H3.751V36.368a.707.707,0,0,0-.7-.7H2.435Z"
                    transform="translate(0 -26.353)"></path>
            </svg>
        </span>
    </a>
    <ul breadcrumbs-mobile-list="" js-breadcrumbs-mobile-list="">
        @foreach ($list as $item)
            <li breadcrumbs-mobile-item="" js-breadcrumbs-item="">
                <a href="{{ $item[1] }}">{{ $item[0] }}</a>
            </li>
        @endforeach
        <li breadcrumbs-mobile-item="" js-breadcrumbs-item="">
            <a href="{{ url()->current() }}">{{ $pageName }}</a>
        </li>
    </ul>
</div>
