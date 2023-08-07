@extends('LaravelUserMonitoring::layouts.master')

@section('content')
    <div class="mt-7 overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <tbody>
                @foreach ($visits as $visit)
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td>
                            <div class="flex items-center pl-5">
                                <a href="{{ $visit->page }}" class="text-base font-medium leading-none text-gray-700 mr-2">
                                    {{ $visit->page }}
                                </a>
                            </div>
                        </td>
                        <td class="pl-24">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-sm leading-none text-gray-600 ml-2">
                                    {{ $visit->user->name ?? 'Guest User' }}
                                </p>
                            </div>
                        </td>
                        <td class="pl-5">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-6 h-6" stroke-width="1.5" viewBox="0 0 50 50">
                                    <path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 32.987976 4 39.925645 8.44503 43.476562 15 L 25 15 A 1.0001 1.0001 0 0 0 24.886719 15.005859 C 19.738868 15.064094 15.511666 19.035373 15.046875 24.078125 L 8.0351562 12.650391 C 11.851593 7.4136918 18.014806 4 25 4 z M 6.8242188 14.501953 L 16.476562 30.230469 A 1.0001 1.0001 0 0 0 16.591797 30.388672 A 1.0001 1.0001 0 0 0 16.59375 30.392578 C 18.3752 33.158533 21.474925 35 25 35 C 26.413063 35 27.756327 34.701734 28.976562 34.169922 L 22.320312 45.824219 C 11.979967 44.509804 4 35.701108 4 25 C 4 21.169738 5.0375742 17.591533 6.8242188 14.501953 z M 25 17 C 29.430123 17 33 20.569877 33 25 C 33 26.42117 32.629678 27.751591 31.984375 28.90625 A 1.0001 1.0001 0 0 0 31.982422 28.908203 A 1.0001 1.0001 0 0 0 31.947266 28.966797 C 30.57172 31.37734 27.983486 33 25 33 C 20.569877 33 17 29.430123 17 25 C 17 20.569877 20.569877 17 25 17 z M 30.972656 17 L 44.421875 17 C 45.43679 19.465341 46 22.165771 46 25 C 46 36.609824 36.609824 46 25 46 C 24.842174 46 24.686285 45.991734 24.529297 45.988281 L 33.683594 29.958984 A 1.0001 1.0001 0 0 0 33.742188 29.841797 C 34.541266 28.405674 35 26.755664 35 25 C 35 21.728612 33.411062 18.825934 30.972656 17 z"></path>
                                </svg>
                                <p class="text-sm leading-none text-gray-600 ml-2">
                                    {{ $visit->browser_name }}
                                </p>
                            </div>
                        </td>
                        <td class="pl-5">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                <p class="text-sm leading-none text-gray-600 ml-2">
                                    {{ $visit->ip }}
                                </p>
                            </div>
                        </td>
                        <td class="pl-5">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 50 50">
                                    <path d="M 46 4.867188 L 4 10.117188 L 4 39.882813 L 46 45.132813 Z M 44 7.132813 L 44 24 L 25 24 L 25 9.507813 Z M 23 9.757813 L 23 24 L 6 24 L 6 11.882813 Z M 6 26 L 23 26 L 23 40.242188 L 6 38.117188 Z M 25 26 L 44 26 L 44 42.867188 L 25 40.492188 Z"></path>
                                </svg>
                                <p class="text-sm leading-none text-gray-600 ml-2">
                                    {{ $visit->platform }}
                                </p>
                            </div>
                        </td>
                        <td class="pl-5">
                            <button class="py-3 px-3 text-sm focus:outline-none leading-none text-blue-700 bg-blue-100 rounded">
                                {{ $visit->created_at->format('Y-m-d H:i') }}
                            </button>
                        </td>
                        <td class="pl-4">
                            <form method="post" action="{{ route('user-monitoring.visits-monitoring-delete', $visit->id) }}">
                                @csrf
                                @method('DELETE')

                                <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $visits->links() }}
    </div>
@endsection
