<x-blank :data="$data" :next="$next" :sheet="$sheet">
    <x-dashboard :data="$data" :sheet="$sheet"></x-dashboard>
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
</script>
