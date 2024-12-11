@extends('layouts.app')

@section('content')
    <div id = "veille">
        <veille-technologique></veille-technologique>
    </div>
@endsection

@push('js')
<script>
        $(function(){
            new Vue({
                el: '#veille',
                props : {
                }
            });
        });


</script>
@endpush