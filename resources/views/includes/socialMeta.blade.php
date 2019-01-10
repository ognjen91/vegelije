@php
  $title = 'Vegelije: najsveobuhvatnija vege pretraga i provera proizvoda i grupa proizvoda na Balkanu';
  $description = "Najsveobuhvatnije pretraga veganskih i vegetarijanskih proizvoda na Balkanu. Uverite se i sami!";
  $image = "http://vegelije.com/images/assets/vegelije.png";
  $image2 = "assets/vegelije.jpg";

@endphp

<!-- Twitter Card data -->
<meta name=”twitter:card” content=”summary_large_image” />
<meta name=”twitter:url” content="{{config('app.url')}}@yield('socialUrl')" />
<meta name="twitter:title" content="@yield('socialTitle', 'Vegelije')" />
<meta name="twitter:description" content="@yield('socialDescription', $description)" />
<meta name="twitter:creator" content="OgnjenK" />
<meta name="twitter:image:src" content="{{config('app.url')}}/images/@yield('socialImage', $image2)" />

<!-- Open Graph data -->

<meta property="og:title" content="@yield('socialTitle', 'Vegelije')" />
<meta property="og:type" content="@yield('ogType', 'webiste')" />
<meta property="og:url" content="{{config('app.url')}}@yield('socialUrl')" />
<meta property="og:image" content="{{config('app.url')}}/images/@yield('socialImage', $image2)" />
<meta property="og:description" content="@yield('socialDescription', $description)" />
<meta property="og:site_name" content="Vegelije.com" />
