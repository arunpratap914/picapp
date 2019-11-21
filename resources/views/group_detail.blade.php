@extends('layouts.app')
@section('title')
    Group
@endsection
@section('styles')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"> --}}
<link rel="stylesheet" href="{{ asset('front/css/photobox.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<style type="text/css">
.row {
  margin: 15px;
}
.likebtn {
    cursor: pointer;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<section id="features" class="features">


    <div class="container">
        @php
            //var_dump(count($my_likes));
        @endphp
        <div class="contaier">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('user_groups')}}" class="btn btn-warning mb-3">Back</a>
                    <h1 class="text-white">{{$group->name}}</h1>
                </div>
            </div>
        </div>

        @if($show_likes)
            @php
                $img_array = json_encode($likes);
            @endphp
            <div class="text-right mb-5">
                <a href="{{route('download_images',$img_array)}}" class="btn btn-primary">Download Images</a>
                <a href="{{route('group',[$group->id])}}" class="btn btn-info">View all images</a>
            </div>

            <div class="row all_images" id='gallery'>
                @if(!count($my_likes))
                <p>No Image found</p>
                @endif
                @forelse ($group->images as $key => $image)
                    @if(in_array($image->id,$my_likes))
                        @php
                            if(in_array($image->id,$likes)){
                                $action = "unlike";
                            }
                            else{
                                $action = "like";
                            }
                        @endphp
                        <div class="col-md-3">
                            <a href="{{asset('storage/images')}}/{{$image->filename}}">
                                <div>
                                    <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" title="{{$image->title}}" class="w-100">
                                </div>
                            </a>
                            <p class="text-white p-2">{{$group->code}}-{{$image->id}}
                                <input type="hidden" id="inp_{{$image->id}}" value="{{$action}}">
                                <span id="like_btn{{$image->id}}" class='likebtn pl-3 @if($action =="unlike") text-success @else text-secondary @endif' onclick='return like({{$image->id}},{{$group->id}},{{Auth::user()->id}});' style="font-size:20px;"><i class="fas fa-thumbs-up"></i></span>
                            </p>
                        </div>
                    @endif
                @empty
                    <div class="col-md-12 pt-5 pl-5">
                        <p class="text-white">No Image Added</p>
                    </div>
                @endforelse
            </div>
        @else
            <div class="text-right mb-5">
                <a href="{{route('group',[$group->id,"my_likes"])}}" class="btn btn-info">View My Likes</a>
            </div>
            <div class="row all_images" id='gallery'>
                @forelse ($group->images as $key => $image)
                    @php
                        if(in_array($image->id,$likes)){
                            $action = "unlike";
                        }
                        else{
                            $action = "like";
                        }
                    @endphp
                    <div class="col-md-3">
                        <a href="{{asset('storage/images')}}/{{$image->filename}}">
                            <div>
                                <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" title="{{$image->title}}" class="w-100">
                            </div>
                        </a>
                        <p class="text-white p-2">{{$group->code}}-{{$image->id}}
                            <input type="hidden" id="inp_{{$image->id}}" value="{{$action}}">
                            <span id="like_btn{{$image->id}}" class='pl-3 likebtn @if($action =="unlike") text-success @else text-secondary @endif' onclick='return like({{$image->id}},{{$group->id}},{{Auth::user()->id}});' style="font-size:20px;"><i class="fas fa-thumbs-up"></i></span>
                        </p>
                    </div>
                @empty
                    <div class="col-md-12 pt-5 pl-5">
                        <p class="text-white">No Image Added</p>
                    </div>
                @endforelse
            </div>
        @endif
        {{-- <div class="row all_images" id='gallery'>
                @forelse ($group->images as $key => $image)
                    @if(count($my_likes) > 0)
                        @if(in_array($image->id,$my_likes))
                            @php
                                if(in_array($image->id,$likes)){
                                    $action = "unlike";
                                }
                                else{
                                    $action = "like";
                                }
                            @endphp
                            <div class="col-md-3">
                                <a href="{{asset('storage/images')}}/{{$image->filename}}">
                                    <div>
                                        <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" title="{{$image->title}}" class="w-100">
                                    </div>
                                </a>
                                <p class="text-white">{{$group->code}}-{{$image->id}}</p>

                                    <input type="hidden" id="inp_{{$image->id}}" value="{{$action}}">
                                    <span id="like_btn{{$image->id}}" class='likebtn display-4 @if($action =="unlike") text-success @else text-secondary @endif' onclick='return like({{$image->id}},{{$group->id}},{{Auth::user()->id}});'><i class="fas fa-thumbs-up"></i></span>
                            </div>
                        @endif
                    @else
                        @php
                            if(in_array($image->id,$likes)){
                                $action = "unlike";
                            }
                            else{
                                $action = "like";
                            }
                        @endphp
                        <div class="col-md-3">
                            <a href="{{asset('storage/images')}}/{{$image->filename}}">
                                <div>
                                    <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" title="{{$image->title}}" class="w-100">
                                </div>
                            </a>
                            <p class="text-white">{{$group->code}}-{{$image->id}}</p>

                                <input type="hidden" id="inp_{{$image->id}}" value="{{$action}}">
                                <span id="like_btn{{$image->id}}" class='likebtn display-4 @if($action =="unlike") text-success @else text-secondary @endif' onclick='return like({{$image->id}},{{$group->id}},{{Auth::user()->id}});'><i class="fas fa-thumbs-up"></i></span>
                        </div>
                    @endif
                @empty
                <div class="col-md-12 pt-5 pl-5">
                    <p class="text-white">No Image Added</p>
                </div>
                @endforelse
        </div> --}}

    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('front/js/jquery.photobox.js') }}"> </script>
<script type="text/javascript">
        function gallery_show(){
            function callback(a){
                console.log('loaded gallery 1', a);
            }
            function callback2(a){
                console.log('loaded gallery 2', a);
            }
            $('#gallery').photobox('div > a', { thumbs:true, history:false }, callback2);
            $('#gallery3').photobox('a', { thumbs:true, history:false, thumb:'+ img' });
            var imageLink = $('#gallery a:first');
            $('#addImage').on('click',function(){
                $('#gallery2 > div').append( imageLink.clone() );
            });
            $('#removeImage').on('click',function(){
                $('#gallery2 a:last').remove();
            });
        }
        gallery_show();

    function like(image_id,group_id,user_id){
        var action = $("#inp_"+image_id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:"{{route('like')}}",
            data:{image_id:image_id, group_id:group_id, user_id:user_id,action:action},
            success:function(data){
                //alert(data.success);
                if (data.action == "like") {
                    $("#like_btn"+image_id).addClass('text-success');
                    $("#inp_"+image_id).val('unlike');
                }else{
                    $("#like_btn"+image_id).addClass('text-secondary').removeClass('text-success');
                    $("#inp_"+image_id).val('like');
                }
            }
        });
    }

    function download(){

    }
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

@endsection
