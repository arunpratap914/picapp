@extends('layouts.app')
@section('title')
    Groups
@endsection
@section('content')
<section id="features" class="features">
    <div class="container">
        <h1>Your image groups</h1>
        <div class="row">
            @forelse ($user->groups as $key => $group)
                <a href="{{route('group',$group->id)}}">
                    <div class="col-md-6">
                        @forelse ($group->images as $key => $image)
                            @if($key == 0)
                                <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}">
                            @endif
                        @empty
                            <img src="front/img/Macbook.png">
                        @endforelse
                    </div>
                    <h4 class="pb-5 pl-3">{{$group->name}}</h4>
                </a>
            @empty
                No Group added
            @endforelse
        </div>
    </div>
</section>
@endsection
