var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
context.canvas.width = window.innerWidth;
context.canvas.height = window.innerHeight;
var drawing = false;
var color = "black";
var size = 5;
var brush = "square";
var img = document.getElementById("spbob");
img.style.display="none";

function drawCanvas(x, y, sizeX, sizeY){
    context.globalAlpha = 0.2;
    context.fillStyle = "white";
    context.fillRect(x, y, sizeX, sizeY);
    context.globalAlpha = 1.0;
}
drawCanvas(0, 0, canvas.width, canvas.height);
context.fillStyle = "black";

canvas.addEventListener("mousemove", mouseMove);
canvas.addEventListener("mousedown", mouseDown);
canvas.addEventListener("mouseup", mouseUp);

function mouseMove(event){
    if(drawing==true){
        draw(event);
    }
}

function changeColor(){
    color = document.getElementById("color").value;
    context.fillStyle=color;
}

function changeSize(){
    var newSize = prompt("What is your new size")
    size = parseInt(newSize)
}

function changeBrush(){
    brush = document.getElementById("brush").value;
}

function mouseUp(event){
    drawing = false;
}

function draw(event){
    var x = event.pageX-canvas.offsetLeft;
    var y = event.pageY-canvas.offsetTop;
    if(brush=="square"){
        context.fillRect(x-size/2, y-size/2, size, size)
    }
    else if(brush=="circle"){
        context.strokeStyle=color;
        context.beginPath();
        context.arc(x, y, size, 0, 2*Math.PI, false);
        context.fill();
        context.stroke();
    }
    else if(brush=="slinky"){
        context.strokeStyle="black";
        context.beginPath();
        context.arc(x, y, size, 0, 2*Math.PI, false);
        context.fill();
        context.stroke();
    }
    else if(brush=="eraser"){
        context.clearRect(x-size/2,y-size/2, size, size);
        drawCanvas(x-size/2,y-size/2,size, size);
    }
    else{
        context.drawImage(img, x-size/2, y-size/2, size, size*(393/470));
    }
}

function mouseDown(event){
    drawing = true;
    draw(event);
}

function saveImage(){
    var image = canvas.toDataURL();
    window.location.href=image;
}

function clearScreen(){
    context.clearRect(0, 0, canvas.width, canvas.height);
    drawCanvas(0,0,canvas.width,canvas.height);
}