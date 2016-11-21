@extends('admin.layout')
@section('content')


        {{--<form method="post" action="/photos" enctype="multipart/form-data">--}}
            {{--<input type="file" id="f2" name="photo">--}}
            {{--{{ csrf_field() }}--}}
            {{--<input type="submit" name="submit">--}}
        {{--</form>--}}



            {{--<form id="uploadForm" enctype="multipart/form-data">--}}
                {{--<input id="file" type="file" name="photo"/>{{ csrf_field() }}--}}
                {{--<button id="upload" type="button">upload</button>--}}
            {{--</form>--}}

    {{--<script>--}}

        {{--$("#upload").click(function() {--}}
            {{--$.ajax({--}}
                {{--url: '/photos',--}}
                {{--type: 'POST',--}}
                {{--cache: false,--}}
                {{--data: new FormData($('#uploadForm')[0]),--}}
                {{--processData: false,--}}
                {{--contentType: false,--}}
                {{--success:function(data){--}}
                    {{--console.log(data);--}}
                {{--}--}}
            {{--})--}}
{{--//                    .done(function(res) {--}}
{{--//            }).fail(function(res) {--}}
{{--//                console.log(res)--}}
{{--//            });--}}
        {{--});--}}


    {{--</script>--}}


    @endsection