@if(isset($title))

<div class="alert alert-{{ $style }}">

    <h4>{{$title}}</h4>
    {{$slot}}
</div>
@endif


@if (Session('success'))
    <p class="text-success">{{ Session('success') }}</p>
@endif
