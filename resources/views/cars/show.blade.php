@extends('cars\layouts.app')

@section('content')
<div class="m-auto w-4/5 py-24">
    <div class="text-center">
        <h1 class="text-5xl uppercase bold">
            {{ $car->name }}
        </h1>
        <img  src="{{ asset('images/' . $car->img_path) }}" class="w-2/6 mb-8 shadow-xl center" alt="">
</div>


<div class="py = 10 text-center" >

<span class="uppercase text-blue-500 font-bold text-xs italic">
    Founded : {{ $car->founded }}
</span>

<p class="text-lg text-gray-700">
  {{ $car->description }}
</p>

<ul>
    <p class="text-lg text-gray-750 py-3">
        Model:
    </p>
    @forelse ($car->carModels as $model)
        <li class="text-gray-500 px-1 py-5 inline italic">
             {{ $model['models_name'] }}
        </li>
    @empty
        <p>
            No model found!
        </p>
    @endforelse
</ul>
    <table class="table-auto">
        <tr class="bg-blue-100">
            <th class="w-1/4 border-4 border-gray-500">
                    Model
            </th>
            <th class="w-1/4 border-4 border-gray-500">
                    Engines
        </th>
        <th class="w-1/4 border-4 border-gray-500">
            Date
</th>
        </tr>
        @forelse ($car->carModels as $model)
        <tr>
            <td class="border-4 border-gray-500">
                {{ $model->models_name }}
            </td>
            <td class="border-4 border-gray-500">
                @foreach ($car->engines as $engine)
                        @if ($model->id == $engine->model_id)
                            {{ $engine->engine_name }}

                        @endif

                @endforeach
            </td>
            <td class="border-4 border-gray-500">
                {{ date('d-m-y', strtotime($car->productionDate->created_at)) }}
            </td>
        </tr>

        @empty

        @endforelse
    </table>
    <p class="text-left">
        Product Type:
            @forelse ($car->products as $product)
                {{ $product->name }}
            @empty
                No product name found!
            @endforelse

    </p>
<hr class="mt-4 mb-8">
</div>
</div>
@endsection
