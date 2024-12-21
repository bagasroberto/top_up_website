
    <!-- Fonts and icons -->
    <script src="{{ asset('assets-admin/js/plugin/webfont/webfont.min.js') }} "></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: [" {{ asset('assets-admin/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href=" {{ asset('assets-admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets-admin/css/plugins.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets-admin/css/kaiadmin.min.css') }}" />

