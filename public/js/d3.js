class D3{
    constructor(id,sheet,width,columnDescription) {
        this.container=$(id);
        this.svg=$(id).append('<svg></svg>');
        this.svg.attr('width',width);
        this.sheet = sheet;
        this.width=width;
        this.columnDescription = columnDescription;
    }
    getDistinct(column,activities){
        var values = [];
        for(var i in activities){
            var activity = activities[i];
            if (activity[this.sheet.columnDuration]>0 && values.indexOf(activity[column])==-1) {
                values.push(activity[column]);
            }
        };

        return values;
    }

    selectedActivities(start,end){
        return Object.values(this.sheet.activities).filter(activity=> {
            return activity[0]>=start && activity[0]<=end;
        });
    }

}
