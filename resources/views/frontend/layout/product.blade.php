<!DOCTYPE html>
<html dir="ltr" lang="en-US" @yield('htmlschema')>
<head>
  @yield('seo')
  @yield('jsonschema')
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="{!! url('favicon.ico') !!}">
  @yield('goodrelations')
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/bootstrap.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/style.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/swiper.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/dark.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/font-awesome.min.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/font-icons.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/animate.css') !!}" type="text/css" />
  <link rel="stylesheet" href="{!! asset('/frontend/css/magnific-popup.css') !!}" type="text/css" />
  <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
  @yield('header_styles')
  <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
  <link rel="stylesheet" href="{!! asset('/frontend/css/responsive.css') !!}" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--[if lt IE 9]>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->
  @yield('scripts')
  @yield('ppscripts')
  <!-- Document Title
    ============================================= -->
  <title>@yield('title', 'Shop | The Grace Company')</title>
  @yield('inline-ga-func')
</head>
<body class=" @yield('bodytag') stretched" @yield('bodyschema')>
<div id="wrapper" class="clearfix">
  <!-- Top Bar
    ============================================= -->
  @include('frontend.shop.partials.layout.shoptop')
  <!--  Header
    ============================================= -->
  @include('frontend.layout.partials.header.header')
  @yield('slider')
  @yield('intro')
  @yield('page-title')
  @yield('sidebar')
  <section id="content">
    <div class="content-wrap">
      <div class="container clearfix">
        @yield('content')
      </div>
    </div>
  </section>
  {{--  #content end --}}
  <footer id="footer" class="dark">
    <div class="container">
      @include('frontend.layout.partials.footer.footer-widgets')
    </div>
    <div id="copyrights">
      @include('frontend.layout.partials.footer.copyr')
    </div>
    {{--  #copyrights end --}}
  </footer>
  {{--  #footer end --}}
</div>
{{--  #wrapper end --}}
<div id="gotoTop" class="icon-angle-up"></div>
<!-- External JavaScripts
  ============================================= -->
<script type="text/javascript" src="{!! asset('/frontend/js/jquery.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/frontend/js/plugins.js') !!}"></script>
<script type="text/javascript" src="{!! asset('/frontend/js/functions.js') !!}"></script>
@yield('footer_scripts')
@yield('pp_footer_scripts')
@yield('inlinejs')
</body>
</html>
