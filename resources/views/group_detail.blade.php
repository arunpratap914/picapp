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


@media (min-width: 576px){
    .modal-xl {
        max-width: 500px;
    }
}
@media (min-width: 992px){
    .modal-xl {
        max-width: 800px;
    }
}
@media (min-width: 1200px){
    .modal-xl {
        max-width: 1140px;
    }
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('location')
<br><span class="text-uppercase" style="font-size: 20px;"><span style="color:#8a8a8a;">Locations For :</span> <span style="color:#b7b7b7;">{{$group->location}}</span></span>
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
                    @if($show_likes)
                        <a href="{{route('group',[$group->id])}}" class="btn btn-warning mb-3 blue"><i class="fas fa-long-arrow-alt-left"></i> &nbsp; Back</a><br><br>
                    @else
                        <a href="{{route('user_groups')}}" class="btn btn-warning mb-3 blue"><i class="fas fa-long-arrow-alt-left"></i> &nbsp; Back</a><br><br>
                    @endif
                </div>
                <div class="col-md-7 my-auto">
                    <h2 class="text-white mb-5">{{$group->name}}</h2>
                </div>
                <div class="col-md-1"><br></div>
                <div class="col-md-4">
                    @if($show_likes)
                    @php
                        $img_array = json_encode($likes);
                    @endphp
                        <div class="mb-5">
                            <a href="{{route('group',[$group->id])}}" class="btn btn-info blue d-block mb-3 w-100">View all images</a>
                            <button type="button" class="btn btn-primary blue d-block w-100 mb-3" data-toggle="modal" data-target="#myModal">View As Slideshow</button>
                            <a href="{{route('download_images',$img_array)}}" class="btn btn-primary red d-block w-100">Download Selection</a>

                        </div>
                    @else
                        <div class="mb-5">
                            <a href="{{route('group',[$group->id,"my_likes"])}}" class="btn btn-info blue d-block w-100">View Selection</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if($show_likes)
            @php
                $img_array = json_encode($likes);
            @endphp


            <div class="row all_images" id='gallery'>
                @if(!count($my_likes))
                <p>No Image found</p>
                @endif
                @php
                    $lk_img = "";
                    $counter = 0;
                @endphp
                @forelse ($group->images as $key => $image)

                    @if(in_array($image->id,$my_likes))
                        @php
                            if(in_array($image->id,$likes)){
                                $action = "unlike";
                            }
                            else{
                                $action = "like";
                            }
                            if($counter == 0){
                                $clss = "active";
                            }else{
                                $clss = "no-active";
                            }
                            $lk_img .= '<div class="carousel-item '.$clss.'">'.'<img src="'.asset('storage/images').'/'.$image->filename.'" alt="" class="w-100">'.'</div>';

                        @endphp
                        <div class="col-md-3">
                            <a href="{{asset('storage/images')}}/{{$image->filename}}">
                                <div class="aded">
                                    <img src="{{asset('storage/images/thumbnail')}}/{{$image->large}}" title="{{$image->title}}" class="w-100">
                                </div>
                            </a>
                            <p class="text-white p-2"><span style="width: 50%;display: inline-block;white-space: nowrap;overflow: hidden;cursor: pointer;font-size:14px;" data-toggle="tooltip" data-placement="bottom" title="Click To Copy" class="image-id-class">{{$group->code}}-{{$image->id}}</span>
                                <span style="display: inline-block;vertical-align: top;width: 48%;text-align: right;">
                                    <input type="hidden" id="inp_{{$image->id}}" value="{{$action}}">
                                    <span id="like_btn{{$image->id}}" class='pl-3 likebtn @if($action =="unlike") text-success @else text-secondary @endif' onclick='return like({{$image->id}},{{$group->id}},{{Auth::user()->id}});' style="font-size:14px;">
                                    @php
                                        if($action =="unlike") echo "UNSELECT"; else echo "SELECT";
                                    @endphp</span>
                                </span>
                            </p>
                        </div>
                        @php
                            $counter = $counter+1;
                        @endphp

                    @endif
                @empty
                    <div class="col-md-12 pt-5 pl-5">
                        <p class="text-white">No Image Added</p>
                    </div>
                @endforelse

            </div>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                            <button type="button" class="btn btn-primary close red" data-dismiss="modal" style="font-size: 24px!important;line-height: 24px;">&times;</button>
                            <div class="modal-dialog modal-xl w-100 bg-dark" style="background:#333;">
                            <div class="modal-content bg-dark">

                                <!-- Modal body -->
                                <div class="modal-body p-3">

                                    <div id="demo" class="carousel slide" data-ride="carousel" data-interval="4000">

                                    <!-- The slideshow -->
                                    <div class="carousel-inner">

                                        {!!$lk_img!!}
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>
                                    </div>

                                </div>

                            </div>
                            </div>
                        </div>
        @else
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
                        <p class="text-white p-2"><span style="width: 50%;display: inline-block;white-space: nowrap;overflow: hidden;cursor: pointer;font-size:14px;" title="Click To Copy" data-toggle="tooltip" data-placement="bottom" class="image-id-class">{{$group->code}}-{{$image->id}}</span>
                            <span style="display: inline-block;vertical-align: top;width: 48%;text-align: right;">
                                <input type="hidden" id="inp_{{$image->id}}" value="{{$action}}">
                                <span id="like_btn{{$image->id}}" class='pl-3 likebtn @if($action =="unlike") text-success @else text-secondary @endif' onclick='return like({{$image->id}},{{$group->id}},{{Auth::user()->id}});' style="font-size:14px;">
                                @php
                                    if($action =="unlike") echo "UNSELECT"; else echo "SELECT";
                                @endphp</span>
                            </span>
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
                    $("#like_btn"+image_id).html("UNSELECT");
                }else{
                    $("#like_btn"+image_id).addClass('text-secondary').removeClass('text-success');
                    $("#inp_"+image_id).val('like');
                    $("#like_btn"+image_id).html("SELECT");
                }
            }
        });
    }

    function download(){

    }

    $(".image-id-class").click(function(){
        varcopy = $(this).html();
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(varcopy).select();
        document.execCommand("copy");
        $temp.remove();
        $(this).tooltip('hide')
          .attr('data-original-title', 'Copied!')
          .tooltip('show');
        app = this;
        function change_it(){
            console.log('hello')
            $(app).tooltip('hide')
            .attr('data-original-title', 'Click To Copy');
        }
        setTimeout(change_it, 2000)

          //.tooltip({delay: 500})
          //.tooltip('hide')
    });
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

@endsection
