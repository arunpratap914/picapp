@extends('layouts.app')
@section('title')
    Groups
@endsection
@section('content')
<section id="features" class="features">
    <div class="container">
        <h1 class="text-white">Your image groups</h1>
        <div class="row">
            @forelse ($user->groups as $key => $group)
            <div class="col-md-6 p-3">
                <a href="{{route('group',$group->id)}}">
                    @forelse ($group->images as $key => $image)
                        @if($key == 0)
                            <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" style="max-width:100%">
                        @endif
                    @empty
                        <img src="/images/default_group.jpg" style="max-width:100%">
                    @endforelse
                    <h4 class="pb-5 pt-3 pl-3 text-white">{{$group->name}}</h4>
                </a>
            </div>
            @empty
            <div class="col-md-12 pt-5 pl-5">
                <p class="text-white">No Group added</p>
            </div>

            @endforelse
        </div>
    </div>
</section>
@endsection
