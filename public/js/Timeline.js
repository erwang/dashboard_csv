class Timeline extends D3{
    constructor($container,sheet,width,columnDescription,column1,column2,column3) {
        super($container,sheet,width,columnDescription);
        this.column1=column1;
        this.column2=column2;
        this.column3=column3;
        console.log(sheet);

        var time = 0;
        for(var i in this.sheet.activities){
            //console.log(this.sheets.activities[i]);
            this.sheet.activities[i].start=time;
            time+=this.sheet.activities[i][this.sheet.columnDuration];
            this.sheet.activities[i].end=time;
        }
    }

    generateSVG(){
        var datas=[];
        var column1 = this.column1;
        //define chart header
        this.container.parents('.card:first').find('.card-title').html(this.sheet.cols[this.column1]);

        var activities = this.selectedActivities(this.start,this.end);
        console.log(activities);
        var values = this.getDistinct(this.column1,activities);
        $(values).each(function(i,value){
            datas.push({
                text:value??'undefined',
                activities:
                        $(activities).filter(function(i,activity) {
                            return activity[column1] === value;
                }).toArray()
            })
        })
        console.log(datas);



        var width = this.width;

        var heightLine= 50;
        var svg = this.svg;
        var marginLeft=5;
        var marginTop=5;
        var startLine=marginLeft+width/20;
        var maxEnd = 0;
        for(var i in datas){
            for(var j in datas[i].activities){
                maxEnd = Math.max(maxEnd,datas[i].activities[j].end);
            }
        }
        var height = heightLine*datas.length;
        this.svg.attr('height',height)

        var colors=['#4E79A7','#F28E2B','#E15759','#76B7B2'];
        var k=0;
        for(var i in datas) {
            datas[i].group = svg.append('g');
            datas[i].group.attr('width', width).attr('height', heightLine)
                .attr('y', heightLine * k).attr('x', 0);
            datas[i].y = heightLine * (k + 1) - heightLine / 2 + marginTop;
            //title
            var text = datas[i].group.append('text')
                .attr('y', datas[i].y).attr('x', marginLeft)
                .attr('width', width / 10)
                .attr('text-anchor', 'start')
                .attr('border', 'thin dashed')
                .text(datas[i].text)
            ;
            startLine = Math.max(marginLeft*2+text._groups[0][0].getBBox().width, startLine);
            k++;
        }
        var lengthLine=width-marginLeft*2-startLine;
        var lengthOneUnit = lengthLine/maxEnd;

        for(var i in datas){
            //line
            datas[i].group.append('line')
                .style('stroke','#888')
                .style('stroke-width',1)
                .attr('x1',startLine)
                .attr('y1',datas[i].y)
                .attr('x2',width-marginLeft)
                .attr('y2',datas[i].y)

            //activities
            for(var j in datas[i].activities){
                var activity = datas[i].activities[j]
                datas[i].group.append('rect')
                    .style('fill',colors[i])
                    .style('stroke-width',0)
                    .style('font-size','10px')
                    .attr('x',startLine+marginLeft+activity.start*lengthOneUnit)
                    .attr('y',datas[i].y-heightLine/2)
                    .attr('width',Math.max(5,(activity.end-activity.start)*lengthOneUnit-3))
                    .attr('height',heightLine-(2*marginTop))
                    .attr('rx',3)
                    .attr('ry',3)
                    .attr('data-bs-toggle','tooltip')
                    .attr('data-bs-placement','top')
                    .attr('title',activity[1])
                datas[i].group.append('text')
                    .attr('text-anchor','start')
                    .attr('x',startLine+activity.start*lengthOneUnit+marginLeft*3)
                    .attr('y',datas[i].y+heightLine/2-10-marginTop*2)
                    .text(activity[0])
            }
        }

    }

}
