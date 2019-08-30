<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <title>{{ config('app.title', 'Eolh') }}</title>
    </head>
    <body>
        <div class="container container--align-column welcome-title">
            <div>
                <svg width="100%"  viewBox="0 0 370 315" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <g transform="matrix(1,0,0,1,-67,-71)">
                        <g transform="matrix(1,0,0,1,-388.277,-104.079)">
                            <g transform="matrix(1,0,0,1,-363.988,122)">
                                <g transform="matrix(0.823124,0.844964,-0.73795,0.718875,284.501,-746.709)">
                                    <rect x="901" y="53.521" width="97" height="24.479" style="fill:rgb(0,184,148);"/>
                                </g>
                                <g transform="matrix(0.830133,-0.838079,0.753301,0.746158,251.559,849.547)">
                                    <rect x="901" y="53.521" width="97" height="24.479" style="fill:rgb(0,184,148);"/>
                                </g>
                                <g transform="matrix(0.455055,0,0,0.852777,577.753,-21.6301)">
                                    <rect x="1015.42" y="90" width="58.577" height="366" style="fill:rgb(0,184,148);"/>
                                </g>
                            </g>
                            <g transform="matrix(320.143,0,0,320.143,440.551,466.351)">
                                <path d="M0.281,-0.02L0.046,-0.02L0.069,-0.71L0.272,-0.71L0.272,-0.632L0.129,-0.632L0.129,-0.426L0.238,-0.426L0.238,-0.376L0.134,-0.358L0.134,-0.103L0.269,-0.121L0.281,-0.02Z" style="fill:rgb(45,52,54);fill-rule:nonzero;"/>
                            </g>
                            <g transform="matrix(320.143,0,0,320.143,541.716,466.351)">
                                <path d="M0.122,0C0.095,0 0.076,-0.004 0.065,-0.013C0.054,-0.022 0.049,-0.036 0.049,-0.056L0.049,-0.686C0.064,-0.694 0.083,-0.7 0.107,-0.704C0.13,-0.708 0.162,-0.71 0.201,-0.71C0.219,-0.71 0.234,-0.705 0.245,-0.697C0.256,-0.688 0.262,-0.676 0.262,-0.662L0.255,0L0.122,0ZM0.184,-0.057L0.193,-0.066L0.199,-0.637C0.199,-0.64 0.196,-0.642 0.19,-0.643L0.128,-0.646L0.119,-0.64L0.113,-0.063L0.184,-0.057Z" style="fill:rgb(45,52,54);fill-rule:nonzero;"/>
                            </g>
                            <g transform="matrix(320.143,0,0,320.143,733.482,466.351)">
                                <path d="M0.199,-0.326L0.119,-0.317L0.13,0L0.06,0L0.037,-0.71L0.118,-0.71L0.118,-0.385L0.192,-0.4L0.192,-0.69L0.279,-0.69L0.279,-0.648L0.264,-0.624L0.285,0.02L0.22,0.02L0.199,-0.326Z" style="fill:rgb(45,52,54);fill-rule:nonzero;"/>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="container welcome-cta">
                <a class="button button__cta button__cta--primary" href={{route('register')}}>Sign Up</a>
                <a class="button button__cta button__cta--secondary" href={{route('login')}}>Log In</a>
            </div>
        </div>
    </body>
</html>
