function makeSlug(){
    return btoa(JSON.stringify(data));
}

function init() {
    $('.panel').hide();
    $('a.menu').click(function (event) {
        $('li.menu.active').removeClass('active');
        $('.menu-panel:visible').hide();
        $($(event.currentTarget).data('target')).show();
        $(event.currentTarget).parent('li').addClass('active');
    });
    if (typeof next !== 'undefined') {
        $('[data-target="#' + next + '"]').click();
    }
    if (typeof data !== 'undefined') {
        window.history.pushState(null, null, makeSlug());
        $('input').each(function (i, item) {
            if (data[$(item).attr('name')] !== undefined) {
                $(item).val(data[$(item).attr('name')])
            }
        })
        $('form').attr('action', document.location);
        //start and end
        data.start = data.start == undefined ? refs[0] : data.start;
        data.end = data.end == undefined ? refs[refs.length - 1] : data.end;

        populateSelectColumn();
    }
}
function populateSelectColumn(){
    $('select.cols').append($(sheet.cols).map((i,item)=>{
        return '<option value="'+i+'">'+item+'</option>';
    }).toArray().join(''));
    $('select.cols').each(function(i,item){
       $(item).val(data[$(item).attr('name')]);
    });
    $('select.refs').append($(refs).map((i,item)=>{
        return '<option value="'+item+'">'+item+'</option>';
    }).toArray().join(''));
    $('select.refs').each(function(i,item){
        $(item).val(data[$(item).attr('name')]);
    });
}

function refreshTimeline(timeline){
    t1.sheet.column1 = $('#column1').val();
    t1.generateSVG();
}

if(typeof sheet!="undefined") {
    // var t1 = new Timeline(sheet, column1, column2, column3);
    $('svg').each(function (i, svg) {
        $(svg).width($(svg).parent().width());
        $(svg).data('width', $(svg).parent().width())
    })
// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//     return new bootstrap.Tooltip(tooltipTriggerEl)
// })
}
init();
