var storeddata = [];
var avgdata =[]
h = 100;
w = 480;
samplerate=4;

function setup() {
    createCanvas(w,h);
    frameRate(samplerate);
    background(255,0,255);
    
    for(var i=0;i<w;i++)
    {
        storeddata[i]=0;
    }
    
    for(var i=0;i<w;i++)
    {
        avgdata[i]=0;
    }
}

function draw() {
    
    //ellipse(200,200,50,50);
    loadStrings("systemmonitor.php", doText);
    
}


function doText(data) {
    for(var i=0;i<w;i++)
    {
        storeddata[i]=storeddata[i+1];
    }
    storeddata[w]=data;
    
    for(var i=0;i<w;i++)
    {
        avgdata[i]=avgdata[i+1];
    }
    //console.log(avgdata[w-1]/2);
   
    var d1 = int(avgdata[w-1]);
    var d2 = int(avgdata[w-2]);
    var d3 = int(data);
    //console.log(d1+d2+d3);
    var sum = int(d1)/3+int(d2)/3+int(d3)/3;
    console.log(sum);
    //console.log(sum);
    avgdata[w]=sum;
    
    
    
    background(255,0,255);
    textSize(32);
    text(data, 10,30);
    
    stroke(0,0,0);
    for(var i=0;i<w;i++)
    {
        line(i,h,i,h-storeddata[i]);
    }
    
    stroke(255,0,0);
    for(var i=0;i<w;i++)
    {
        line(i,h,i,h-avgdata[i]);
    }
    
   //var number = data*1;
   
    //ellipse(200-data,200-data,5,5);
}