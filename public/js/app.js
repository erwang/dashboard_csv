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
function init() {
    $('svg').after('<button class="btn btn-default" onclick="saveSvg($(this).prev())">Save</button>');
}
init();
