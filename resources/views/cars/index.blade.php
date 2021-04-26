@extends('cars\layouts.app')


@section('content')



      <div class="m-auto w-4/5 py-24">
          <div class="text-center">
              <h1 class="text-5xl uppercase bold">
                  Nmk Cars
              </h1>
      </div>
      @if (Auth::user())
          <div class="pt-10">
          <a href="cars/create"
          class="border-b-2 pb-3 border-dotted italic text-black-500">
          Add new car here! &rarr;
          </a>
          @else
          <p class="py-8 bold">
              Please login to add car!
          </p>
      @endif



      </div>

      <div class="w-5/6 py-10">
          @foreach ($cars as $car)
          <div class="m-auto">
              @if (isset(Auth::user()->id) && Auth::user()->id == $car->id)
<div class="float-right">
            <a
                class="border-b-2 pb-3 border-dotted italic text-cyan-500"
                href="cars/{{ $car->id }}/edit">
                Edit &rarr;
            </a>
            <form action="/cars/{{ $car->id }}" method="POST" class="pt-4">
                @csrf
                @method('Delete')
                <button class="border-b-2 pb-3 border-dotted italic text-red-600">
                    Delete &rarr;
                </button>
            </form>

            </div>
            @endif
            <div class="px-20">
            <span class="uppercase text-blue-500 font-bold text-xs italic">
                  Founded : {{ $car->founded }}
            </span>
            <h2 class="text-gray-500 text-5xl">
                <a href="/cars/{{ $car->id }}">
                {{ $car->name }}
            </h2>
            <p class="text-lg text-gray-700">
                {{ $car->description }}
            </p>
            <hr class="mt-4 mb-8">
        </div>

          @endforeach
      </div>
    </div>
</div>
@endsection
