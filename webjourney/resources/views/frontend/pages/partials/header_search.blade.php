<style>
    /* Fix Header Close Icon when Search is Open */
    .show-search-button i.vis-head-search-close:before {
        content: "\f00d" !important;
        font-family: "Font Awesome 5 Pro" !important;
        font-weight: 400 !important;
    }

    /* Keep Search Box Inside Container (Not Full Page Width) with Light Background */
    .header-search {
        position: absolute !important;
        top: 50px !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        background: transparent !important;
        border-bottom: none !important;
        padding: 0 !important;
        pointer-events: none !important;
        z-index: 99 !important;
    }
    .header-search.vis-head-search {
        pointer-events: auto !important;
    }
    .header-search > .container {
        background: #f1f5f9 !important;
        border: 1px solid #cbd5e1 !important;
        border-top: none !important;
        border-radius: 0 0 12px 12px !important;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.18) !important;
        padding: 18px 24px 20px !important;
        position: relative !important;
        box-sizing: border-box !important;
    }
    .header-search .header-search-input-item label {
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #183c7d !important;
        letter-spacing: 0.4px !important;
        margin-bottom: 8px !important;
    }
    .header-search .header-search-input-item input[type="text"] {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        height: 44px !important;
        line-height: 44px !important;
        font-size: 14px !important;
        color: #1e293b !important;
        padding: 0 16px 0 38px !important;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04) !important;
    }
    .header-search .header-search-input-item input[type="text"]:focus {
        border-color: #183c7d !important;
        box-shadow: 0 0 0 3px rgba(24, 60, 125, 0.12) !important;
    }
    .header-search .header-search-input-item-icon {
        bottom: 14px !important;
        left: 14px !important;
        color: #F9B90F !important;
    }
    .header-search .header-search-button {
        height: 44px !important;
        line-height: 44px !important;
        top: 23px !important;
        border-radius: 8px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        box-shadow: 0 2px 6px rgba(249, 185, 15, 0.3) !important;
    }
    .header-search .close-header-search {
        bottom: -26px !important;
        background: #183c7d !important;
        box-shadow: 0 6px 14px rgba(15, 23, 42, 0.18) !important;
    }

    /* Live Search Results Dropdown Inside Container */
    #header_search_result {
        margin-top: 12px !important;
        max-height: 360px !important;
        overflow-y: auto !important;
    }
    .wj-live-search-list {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 10px !important;
        overflow: hidden !important;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06) !important;
    }
    .wj-live-search-item {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 9px 14px !important;
        border-bottom: 1px solid #e2e8f0 !important;
        text-decoration: none !important;
        color: #1e293b !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        text-align: left !important;
        transition: background 0.15s ease, color 0.15s ease !important;
    }
    .wj-live-search-item:last-child {
        border-bottom: none !important;
    }
    .wj-live-search-item:hover {
        background: #f8fafc !important;
        color: #183c7d !important;
    }
    .wj-live-search-item img {
        width: 56px !important;
        height: 34px !important;
        object-fit: cover !important;
        border-radius: 5px !important;
        border: 1px solid #e2e8f0 !important;
        flex-shrink: 0 !important;
        margin: 0 !important;
    }
    .wj-live-search-empty {
        display: block !important;
        padding: 12px 16px !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        color: #dc2626 !important;
        font-size: 13px !important;
        font-weight: 600 !important;
    }
</style>

<div class="header-search vis-search">
    <div class="container">
        <div class="row">
            <form action="{{ route('header.click.search') }}" method="GET">
                <!-- header-search-input-item -->
                <div class="col-sm-10">
                    <div class="header-search-input-item fl-wrap location autocomplete-container">
                        <label for="header_search">{{ __('What are you looking for ?') }}</label>
                        <span class="header-search-input-item-icon"><i class="fal fa-search"></i></span>
                        <input type="text" placeholder="Search tutorials, topics, or code guides..." class="autocomplete-input" name="search_string" id="header_search" autocomplete="off" />
                    </div>
                </div>
                <!-- header-search-input-item end -->
                <!-- header-search-button-item -->
                <div class="col-sm-2">
                    <div class="header-search-input-item fl-wrap">
                        <button type="submit" class="header-search-button">Search <i class="far fa-search"></i></button>
                    </div>
                </div>
                <!-- header-search-button-item end -->

                <!-- header-search-result -->
                <div class="col-sm-12" style="display:none; text-align:left;" id="header_search_result">
                </div>
                <!-- header-search-result end -->

            </form>
        </div>
        <div class="close-header-search"><i class="fal fa-angle-double-up"></i></div>
    </div>
</div>
