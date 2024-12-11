@extends('layouts.app')

@section('content')
    <div id = "cv">
        <Curriculum-Vitae></Curriculum-Vitae>
    </div>
@endsection

@push('js')
<script>
        $(function(){
            new Vue({
                el: '#cv',
                props : {
                }
            });
        });


</script>
@endpush