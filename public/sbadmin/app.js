// var datas = [
// 	{
// 		text: "valeur1",
// 		activities:[
// 			{start:0,end:15,color:"red",name:"01.A"},
// 			{start:20,end:30,color:"red",name:"01.B"},
// 			{start:30,end:55,color:"red",name:"01.C"}
// 		]
// 	},
// 	{
// 		text: "valeur2",
// 		activities:[
// 			{start:15,end:20,color:"blue",name:"02.A"}
// 		]
// 	},
// 	{
// 		text: "valeur3",
// 		activities:[
// 			{start:55,end:75,color:"green",name:"03.A"},
// 			{start:75,end:80,color:"green",name:"03.B"},
// 		]
// 	}
// ]

console.log(sheet);

var width = $('#timeline').width();
var heightLine= 50;
var height = heightLine*datas.length;
var  svg = d3.select('#timeline').append('svg')
			.attr('width',width)
			.attr('height',height)
			//.style('background-color','lightgrey');
			.style('border','thin black solid');


var marginLeft=5;
var marginTop=5;
var startLine=marginLeft+width/20;
var lengthLine = width-2*marginLeft-startLine;
var maxEnd = 0;
for(var i in sheet.selectedActivities()){
	for(var j in datas[i].activities){
		maxEnd = Math.max(maxEnd,datas[i].activities[j].end);
	}
}
var lengthOneUnit = lengthLine/maxEnd;
var colors=['#4E79A7','#F28E2B','#E15759'];
console.log(lengthLine,maxEnd);
for(var i in datas){
	i = parseInt(i);
	console.log(datas[i]);
	datas[i].group = svg.append('g');
	datas[i].group.attr('width',width).attr('height',heightLine)
				.attr('y',heightLine*i).attr('x',0);
	datas[i].y=heightLine*(i+1)-heightLine/2+marginTop;
	//title
	datas[i].group.append('text')
		.attr('y',datas[i].y).attr('x',marginLeft)
		.attr('width',width/10)
		.attr('text-anchor','start')
		.attr('border','thin dashed')
		.text(datas[i].text);



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
			.attr('width',(activity.end-activity.start)*lengthOneUnit-3)
			.attr('height',heightLine-(2*marginTop))
			.attr('rx',3)
			.attr('ry',3)
		datas[i].group.append('text')
			.attr('text-anchor','start')
			.attr('x',startLine+activity.start*lengthOneUnit+marginLeft)
			.attr('y',datas[i].y+heightLine/2-10-marginTop)
			.text(i+'.'+j)
	}
}

Activity = function(act){

}
