<body>
<div class="my-navbar">
    <div class="logo">
        <a href='/' > <img src="{{asset('icons/logo.png')}}" alt="logo not found"></a>
    </div>
    <div class="nav-links">
        <i class="fa fa-bars menuicon"></i>
        <div class="links ">
            <div class=''>
                <div><a href="/">Home</a></div>
                  @guest
                        <div><a href="{{ route('login') }}">Login</a></div>
                        @if (Route::has('register'))
                        <div><a href="{{ route('register') }}">Register</a></div>
                        @endif
                @else
                    <div >
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <div class="dropdown-item">
                                <a href="/dashboard">Dashboard</a>
                            </div>
                            <div class="dropdown-item">
                                <a href="/posts/create">Create Post</a>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>
</div>
@include('include.messages')
