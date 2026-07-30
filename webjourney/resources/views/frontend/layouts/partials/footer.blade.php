<!--footer -->
<footer class="main-footer">
    <div class="footer-bg">
    </div>
    <!--sub-footer-->
    <div class="sub-footer">
        <div class="container">
            <div class="copyright"> &#169; {{ __('WebJourney') }} @php echo date('Y') @endphp. {{ __('All rights reserved') }}.</div>
            <div class="subfooter-nav">
                <ul>
                    <li><a href="{{ route('terms.of.use') }}">{{ __('Terms of use') }}</a></li>
                    <li><a href="{{ route('privacy.policy') }}">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="{{ __(route('homepage')) }}">{{ __('Blog') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--sub-footer end -->
</footer>
<!--footer end -->
