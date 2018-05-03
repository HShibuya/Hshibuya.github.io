var canvas = document.getElementById("canvas");
var canvasCursor = document.getElementById("cursor");
var context = canvas.getContext("2d");
var contextCursor = canvasCursor.getContext("2d");
var drawing = false;
var color1 = "black";
var color2 = "black";
var size = 10;
var brush = "square";
var firstClick = false;
var img = document.getElementById("turd");
var initImg = document.getElementById("init");
img.style.display="none";
initImg.style.display="none";

contextCursor.drawImage(initImg, 0, 0, canvasCursor.width, canvasCursor.height);
context.fillStyle = "black";
context.strokeStyle = "black";
contextCursor.fillStyle = "black";
contextCursor.strokeStyle = "black";

canvas.addEventListener("mousemove", mouseMove);
canvas.addEventListener("mousedown", mouseDown);
canvas.addEventListener("mouseup", mouseUp);
canvasCursor.addEventListener("mousemove", mouseMove);
canvasCursor.addEventListener("mousedown", mouseDown);
canvasCursor.addEventListener("mouseup", mouseUp);


function mouseMove(event){
    clearScreen(contextCursor)
    if(drawing==true){
        draw(context,event);
    }
    draw(contextCursor,event)
}

function changeColor1(){
    color1 = document.getElementById("color1").value;
    context.fillStyle=color1;
    contextCursor.fillStyle=color1;
}

function changeColor2(){
    color2 = document.getElementById("color2").value;
    context.strokeStyle=color2;
    contextCursor.strokeStyle=color2;
}

function changeSize(){
    var newSize = prompt("What is your new size")
    size = parseInt(newSize)
    if(size%2==1){
        size-=1
    }
}

function changeBrush(){
    brush = document.getElementById("brush").value;
}

function mouseUp(event){
    drawing = false;
}

function draw(ctx, event){
    var x = event.layerX-canvas.offsetLeft-7;
    var y = event.layerY-canvas.offsetTop-7;
    if(brush=="square"){
        ctx.fillRect(x-size/2, y-size/2, size, size)
        ctx.strokeRect(x-size/2, y-size/2, size, size)
    }
    else if(brush=="circle"){
        ctx.beginPath();
        ctx.arc(x, y, size, 0, 2*Math.PI, false);
        ctx.fill();
        ctx.stroke();
    }
    else if(brush=="eraser"){
        ctx.clearRect(x-size/2,y-size/2, size, size);
    }
    else{
        ctx.drawImage(img, x-size/2, y-size/2, size, size*(393/470));
    }
}

function mouseDown(event){
    drawing = true;
    draw(context,event);
}

function downloadImage(){
    var image = canvas.toDataURL();
    var element = document.createElement('a');
    element.setAttribute('href', image);
    element.setAttribute('download', 'image.png');
    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}

function clearScreen(ctx){
    ctx.clearRect(0, 0, canvas.width, canvas.height); 
}


var form = document.getElementById("sendForm");

var close = document.getElementById("close")

function sendImage(){
    form.style.display = "block";
    var imageURL = canvas.toDataURL();
    var saveImage = document.getElementById("saveImage");
    saveImage.setAttribute("src",imageURL);
}
