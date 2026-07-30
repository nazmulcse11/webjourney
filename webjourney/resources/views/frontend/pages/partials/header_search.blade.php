<div class="header-search vis-search">
    <div class="container">
        <div class="row">
            <form action="{{ route('header.click.search') }}" method="GET">
                @csrf
                <!-- header-search-input-item -->
                <div class="col-sm-10">
                    <div class="header-search-input-item fl-wrap location autocomplete-container">
                        <label>{{ __('What are you looking for ?') }}</label>
                        <span class="header-search-input-item-icon"><i class="fal fa-search"></i></span>
                        <input type="text" placeholder="Search Here ..." class="autocomplete-input" name="search_string" id="header_search" />
                        <a href="#"><i class="fal fa-dot-circle"></i></a>
                    </div>
                </div>
                <!-- header-search-input-item end -->
                <!-- header-search-button-item -->
                <div class="col-sm-2">
                    <div class="header-search-input-item fl-wrap">
                        <button class="header-search-button" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
                    </div>
                </div>
                <!-- header-search-button-item end -->

                <!-- header-search-result -->
                <div class="col-sm-10" style="display:none; text-align:left;" id="header_search_result">
                </div>
                <!-- header-search-result end -->

            </form>
        </div>
    </div>
    <div class="close-header-search"><i class="fal fa-angle-double-up"></i></div>
</div>
