@if (env('TAWK_TOKEN'))
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/{{ env('TAWK_TOKEN') }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endif

<!-- Scripts for all templates -->
<script>
    // EVENT - Check for country local storage, set if not already set
    async function saveUserCountryToLocalStorage() {
        let userCountry = localStorage.getItem("country");
        if (userCountry === null) {
            userCountry = await setUserCountry();
        }
    }

    // set user country in local storage
    async function setUserCountry() {
        try {
            let response = await fetch("https://ipinfo.io/json?token=32d8daa92e84c3");
            let data = await response.json();
            let userCountry = data.country || "unknown";
            localStorage.setItem("country", userCountry);
            return userCountry;
        } catch (err) {
            console.error("Failed to fetch user country.", err);
            return "unknown"; // Return a default value in case of an error
        }
    }
</script>

<!-- Greensock for scroll triggers -->
<script defer src="/cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min18c4.js?ckcachebust=744313577"></script>
<script defer src="/cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min18c4.js?ckcachebust=744313577"></script>

<!-- Scripts for this template -->
@if (Route::currentRouteName() == 'home')
    <script type="module" src="{{ asset('assets/js/homepage-video.js') }}"></script>
    <!-- Hammer JS use only for the homepage slider -->
    <script defer src="/cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min18c4.js?ckcachebust=744313577"></script>
@elseif (Route::currentRouteName() == 'faqs')
    <script type="module" src="/templates/subpage-faq/scriptb824.js?ckcachebust=F74EAF8EC00BFF6A5FD86EDE7AD876FF"></script>
@elseif (in_array(Route::currentRouteName(), ['our-trips', 'regions']))
    <script type="module" src="/templates/search-results/script3784.js?ckcachebust=F74EAF8EC00BFF6A5FD86EDE7AD876FF">
    </script>
@elseif (Route::currentRouteName() == 'trip')
    <script type="module" src="{{ asset('/assets/js/trip/' . request()->route('trip_section') . '.js') }}"></script>
    @if (request()->route('trip_section') == 'reviews')
        <script src="{{ asset('assets/js/trip/trip-reviews.js') }}"></script>
        <script src="{{ asset('assets/js/trip/trip-reviews2.js') }}"></script>
    @endif
@else
    {{-- <script type="module" src="/templates/subpage/scripta691.js?ckcachebust=F74EAF8EC00BFF6A5FD86EDE7AD876FF"></script> --}}
@endif


<!-- Typekit : Everyones favorite font from 2018 -->
<link rel="stylesheet" href="/use.typekit.net/fsj6bst18c4.css?ckcachebust=744313577" />
<script defer src="/use.typekit.com/fsj6bst18c4.js?ckcachebust=744313577"></script>

<!-- Cookies js probably can be refactored away -->
<script src="/cdn.jsdelivr.net/npm/js-cookie%403.0.1/dist/js.cookie.min18c4.js?ckcachebust=744313577"></script>


<!-- Form Validation -->
<script defer
    src="/cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min18c4.js?ckcachebust=744313577">
</script>

@if (Route::currentRouteName() == 'home')
@endif


<!-- SCRIPTS ONLY BELOW  -->

<!-- Resize images-->
{{-- <script defer src="{{ asset('assets') }}/js/resize-imgff2d.js?ckcachebust=8D4AE4FC3CF064EE8EE153DA686D2540"></script> --}}

<!-- OptinMonster -->
{{-- <script>
    (function(d, u, ac) {
        var s = d.createElement("script");
        s.type = "text/javascript";
        s.src = "/a.omappapi.com/app/js/api.min.js";
        s.async = true;
        s.dataset.user = u;
        s.dataset.account = ac;
        d.getElementsByTagName("head")[0].appendChild(s);
    })(document, 123366, 135614);
</script> --}}
