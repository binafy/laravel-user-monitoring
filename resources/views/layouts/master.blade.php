<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>@yield('title') - Laravel User Monitoring</title>

        @yield('style')
        <style>
            .checkbox:checked + .check-icon {
                display: flex;
            }

            /* Dark Mode */
            body.dark-mode {
                background-color: #222831;
            }

            body.dark-mode .title-bar {
                color: #fff;
            }

            body.dark-mode .tab-box {
                background-color: #222831;
            }

            body.dark-mode .tab-title {
                color: #fff;
            }

            body.dark-mode .tab-title:hover {
                color: #4338ca;
            }

            body.dark-mode :is(a, p, path) {
                color: #fff;
            }

            body.dark-mode .delete-btn {
                background-color: rgb(234, 56, 56);
            }

            body.dark-mode .bg-indigo-100 p {
                color: #000;
            }
        </style>
    </head>
    <body @class(['dark-mode' => config('user-monitoring.config.dark_mode', false)])>
        <div class="sm:px-6 w-full">
            <div class="px-4 md:px-10 py-4 md:py-7">
                <div class="flex items-center justify-between">
                    <p class="focus:outline-none text-base sm:text-lg md:text-xl lg:text-2xl font-bold leading-normal text-gray-800 title-bar" tabindex="0">
                        Laravel User Monitoring 📈
                    </p>
                </div>
            </div>
            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 tab-box">
                <div class="sm:flex items-center justify-between">
                    <div class="flex items-center">
                        <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800"
                           href="{{ route('user-monitoring.visits-monitoring') }}">
                            <div class="py-2 px-8 text-indigo-700 rounded-full hover:text-indigo-700 hover:bg-indigo-100
                                        {{ request()->routeIs('user-monitoring.visits-monitoring') ? 'bg-indigo-100' : '' }}">
                                <p class="tab-title">Visit Monitoring</p>
                            </div>
                        </a>
                        <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8"
                           href="{{ route('user-monitoring.actions-monitoring') }}">
                            <div class="py-2 px-8 text-indigo-700 rounded-full hover:text-indigo-700 hover:bg-indigo-100
                                        {{ request()->routeIs('user-monitoring.actions-monitoring') ? 'bg-indigo-100' : '' }}">
                                <p class="tab-title">Action Monitoring</p>
                            </div>
                        </a>
                        <a class="rounded-full focus:outline-none focus:ring-2 focus:bg-indigo-50 focus:ring-indigo-800 ml-4 sm:ml-8"
                           href="{{ route('user-monitoring.authentications-monitoring') }}">
                            <div class="py-2 px-8 text-indigo-700 rounded-full hover:text-indigo-700 hover:bg-indigo-100
                                        {{ request()->routeIs('user-monitoring.authentications-monitoring') ? 'bg-indigo-100' : '' }}">
                                <p class="tab-title">Authentication Monitoring</p>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="https://github.com/binafy/laravel-user-monitoring"
                           class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0
                                            inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600
                                            focus:outline-none rounded items-center">
                            <p class="text-sm font-medium leading-none text-white mr-2">
                                GitHub
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" style="fill:#FFFFFF;">
                                <path d="M10.9,2.1c-4.6,0.5-8.3,4.2-8.8,8.7c-0.5,4.7,2.2,8.9,6.3,10.5C8.7,21.4,9,21.2,9,20.8v-1.6c0,0-0.4,0.1-0.9,0.1 c-1.4,0-2-1.2-2.1-1.9c-0.1-0.4-0.3-0.7-0.6-1C5.1,16.3,5,16.3,5,16.2C5,16,5.3,16,5.4,16c0.6,0,1.1,0.7,1.3,1c0.5,0.8,1.1,1,1.4,1 c0.4,0,0.7-0.1,0.9-0.2c0.1-0.7,0.4-1.4,1-1.8c-2.3-0.5-4-1.8-4-4c0-1.1,0.5-2.2,1.2-3C7.1,8.8,7,8.3,7,7.6C7,7.2,7,6.6,7.3,6 c0,0,1.4,0,2.8,1.3C10.6,7.1,11.3,7,12,7s1.4,0.1,2,0.3C15.3,6,16.8,6,16.8,6C17,6.6,17,7.2,17,7.6c0,0.8-0.1,1.2-0.2,1.4 c0.7,0.8,1.2,1.8,1.2,3c0,2.2-1.7,3.5-4,4c0.6,0.5,1,1.4,1,2.3v2.6c0,0.3,0.3,0.6,0.7,0.5c3.7-1.5,6.3-5.1,6.3-9.3 C22,6.1,16.9,1.4,10.9,2.1z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                        </svg>
                        <p>{{ session()->get('message') }}</p>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </body>
</html>
