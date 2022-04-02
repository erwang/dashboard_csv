<x-blank :data="$data" :next="$next" :sheet="$sheet" :readonly="$readonly ?? false">
    <x-dashboard :data="$data" :sheet="$sheet" :readonly="$readonly ?? false"></x-dashboard>
</x-blank>

<script>
    function resizeSVG(){
        $('svg').each(function(i,svg) {
            $(svg).width($(svg).parent().width()-10);
        });
    }

    $(window).resize(function() {
        resizeSVG();
    });
    resizeSVG();

    $(document).ready(function() {
        $('.select2').select2({
            width:'100%'
        });
    });
</script>
