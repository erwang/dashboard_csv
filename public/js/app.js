function saveSvg(svgEl) {
    var name=svgEl.attr('title')+'.svg';
    svgEl.attr("xmlns", "http://www.w3.org/2000/svg");
    var svgData = svgEl.prop('outerHTML');
    console.log(svgData);
    var preface = '<?xml version="1.0" standalone="no"?>\r\n';
    var svgBlob = new Blob([preface, svgData], {type:"image/svg+xml;charset=utf-8"});
    var svgUrl = URL.createObjectURL(svgBlob);
    var downloadLink = document.createElement("a");
    downloadLink.href = svgUrl;
    downloadLink.download = name;
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
function saveCanva(canvas)
{
    let downloadLink = document.createElement('a');
    downloadLink.setAttribute('download', 'CanvasAsImage.png');
    canvas[0].toBlob(function(blob) {
        let url = URL.createObjectURL(blob);
        downloadLink.setAttribute('href', url);
        downloadLink.click();
    });
}


function init() {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl,{
            trigger:'hover'
        })
    })
    $('.copy').each(function(item){
        console.log($(item).href);
    });

    $('svg').after('<button class="btn btn-default" onclick="saveSvg($(this).prev())"><i class="fas fa-download"></i></button>');
    $('canvas').after('<button class="btn btn-default" onclick="saveCanva($(this).prev())"><i class="fas fa-download"></i></button>');
}
init();
