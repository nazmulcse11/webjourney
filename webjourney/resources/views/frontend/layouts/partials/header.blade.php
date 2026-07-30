<!-- header-->
<header class="main-header">
    <!-- header-inner-->
    <div class="header-inner fl-wrap">
        <div class="container">

            <div class="show-search-button"><span>{{ __('Search') }}</span> <i class="fas fa-search"></i> </div>
             
             @if(Auth::check())
                <div class="wishlist-link"><i class="fal fa-heart"></i>
                    <span class="wl_counter favourite_counter">
                        {{ Auth::guard('web')->user()->favourites->count() }}
                    </span>
                </div>
            @endif

            <!-- my-account-wrap-->
            @include('frontend.pages.partials.my_account')
            <!-- my-account-wrap-->

            <div class="home-btn"><a href="{{ route('homepage') }}"><i class="fas fa-home"></i></a></div>
            <!-- nav-button-wrap-->
            <div class="nav-button-wrap color-bg">
                <div class="nav-button">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <!-- nav-button-wrap end-->

            <!--  navigation -->
            @include('frontend.pages.partials.navigation')
            <!-- navigation  end -->

            <!-- wishlist-wrap-->
            @include('frontend.pages.partials.wishlist')
            <!-- wishlist-wrap end-->

        </div>
    </div>
    <!-- header-inner end-->

    <!-- header-search -->
    @include('frontend.pages.partials.header_search')
    <!-- header-search  end -->
</header>
<!--  header end -->
