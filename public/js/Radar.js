class Radar extends D3{
    constructor(svg,sheet,column,start,end) {
        super(svg,sheet);
        this.column=column;
        this.start=start;
        this.end=end;
    }

    generateSVG(){
         this.svg.selectAll("*").remove();
        var activities = this.selectedActivities(this.start,this.end);
        var values = this.getDistinct(this.column,activities);
        var axes = [];
        $(activities).each((i,activity)=>{
            if(undefined==axes[activity[this.column]]){
                axes[activity[this.column]]={axis:activity[this.column],value:0};
            }
            axes[activity[this.column]].value+=activity[this.sheet.columnDuration];
        })
        if(axes[null]!=undefined) {
            axes[null].axis = 'empty';
        }
        console.log(axes);
        console.log(Object.values(axes));


        var margin = { top: 50, right: 80, bottom: 50, left: 80 },
            width = Math.min(700, window.innerWidth / 4) - margin.left - margin.right,
            height = Math.min(width, window.innerHeight - margin.top - margin.bottom);

        var data = [
            { name: sheet.cols[this.column],
                axes: Object.values(axes)
            },
        ];

//////////////////////////////////////////////////////////////
////// First example /////////////////////////////////////////
///// (not so much options) //////////////////////////////////
//////////////////////////////////////////////////////////////
        var radarChartOptions = {
            w: width,
            h: height,
            margin: margin,
            levels: 5,
            roundStrokes: true,
            color: d3.scaleOrdinal().range(["#26AF32", "#762712"]),
            format: '.0f'
        };

        RadarChart(this.svg, data, radarChartOptions);
    }

}
