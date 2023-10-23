<x-layout>
    @include('partials._hero')
    @include('partials._search')
    {{-- <h1>{{ $heading }}</h1> --}}
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        {{--
@php
    $test = 1;
@endphp
--}}
        {{-- {{ $test }} --}}
        @unless (count($listings) == 0)
            @foreach ($listings as $listing)
                <!-- Item -->
                <x-listing-card :listing="$listing" />
            @endforeach
        @else
            <p>No listings found</p>
        @endunless
    </div>
</x-layout>