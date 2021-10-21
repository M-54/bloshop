<x-bootstrap-layout>
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="{{ route('cart') }}">Cart</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="#">{{ env('APP_NAME') }}</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img"
                             viewBox="0 0 24 24"><title>Search</title>
                            <circle cx="10.5" cy="10.5" r="7.5"/>
                            <path d="M21 21l-5.2-5.2"/>
                        </svg>
                    </a>
                    @auth
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                @foreach ($categories as $category)
                    <a class="p-2 link-secondary" href="#">{{ $category->title }}</a>
                @endforeach
            </nav>
        </div>
    </div>

    <main class="container">

        <table class="table">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Variation</th>
                <th>Count</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>

            @foreach($my_cart as $key => $value)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $value['variation']['product']['title'] }}</td>
                    <td>{{ $value['variation']['name'] }}</td>
                    <td>{{ $value['count'] }}</td>
                    <td>{{ $value['variation']['price'] }}</td>
                    <td>{{ $value['total_price'] }}</td>
                </tr>
            @endforeach
        </table>

    </main>

    <footer class="blog-footer">
        <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a
                href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>
</x-bootstrap-layout>
