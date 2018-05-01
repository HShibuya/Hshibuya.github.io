var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var drawing = false;
var color1 = "black";
var color2 = "black";
var size = 10;
var brush = "square";
var firstClick = false;
var img = document.getElementById("spbob");
var initImg = document.getElementById("init");
img.style.display="none";
initImg.style.display="none";

context.drawImage(initImg, 0, 0, canvas.width, canvas.height);
context.fillStyle = "black";
context.strokeStyle = "black";

canvas.addEventListener("mousemove", mouseMove);
canvas.addEventListener("mousedown", mouseDown);
canvas.addEventListener("mouseup", mouseUp);

function mouseMove(event){
    if(drawing==true){
        draw(event);
    }
    if(firstClick==false){
        firstClick=true;
        clearScreen();
    }
}

function changeColor1(){
    color1 = document.getElementById("color1").value;
    context.fillStyle=color1;
}

function changeColor2(){
    color2 = document.getElementById("color2").value;
    context.strokeStyle=color2;
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

function draw(event){
    var x = event.pageX-canvas.offsetLeft;
    var y = event.pageY-canvas.offsetTop;
    if(brush=="square"){
        context.strokeStyle=color2;
        context.fillRect(x-size/2, y-size/2, size, size)
        context.strokeRect(x-size/2, y-size/2, size, size)
    }
    else if(brush=="circle"){
        context.strokeStyle=color2;
        context.beginPath();
        context.arc(x, y, size, 0, 2*Math.PI, false);
        context.fill();
        context.stroke();
    }
    else if(brush=="eraser"){
        context.clearRect(x-size/2,y-size/2, size, size);
    }
    else{
        context.drawImage(img, x-size/2, y-size/2, size, size*(393/470));
    }
}

function mouseDown(event){
    drawing = true;
    draw(event);
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

function clearScreen(){
    context.clearRect(0, 0, canvas.width, canvas.height);
    
}