@extends('layouts.app')
@section('content')
<div id = "portfolio">
    <portfolio></portfolio>
</div>

@endsection
@push('js')
<script>
        $(function(){
            new Vue({
                el: '#portfolio',
                props: {
                }
            });
        });


</script>
@endpush
