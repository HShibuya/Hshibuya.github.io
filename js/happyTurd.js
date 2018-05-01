var space = new Raster("images/spaceBackground.png", [150,300]);
var bird = new Object({
    skin: new Raster({
        source: "images/turd.png", 
        position: [200,300],
        size: new Size(50,47)
    }),
    speed: 0,
    accel: 1
});
bird.checkRot = function(){
    if(bird.speed<-5){
        bird.skin.rotation = -30
    }
    else if(bird.speed<5){
        bird.skin.rotation = bird.speed*6
    }
    else{
        bird.skin.rotation = 30
    }
}

var start = false;
var gameOver = false;
var score = 0;

var titleText = new PointText(new Point(250, 200));
titleText.content = "Happy Turd"
titleText.style = {
    fontFamily: 'Impact',
    fontSize: 60,
    fillColor: 'yellow',
    justification: 'center'
};

var startText = new PointText(new Point(250, 450));
startText.content = "Press Space to Start Y'all"
startText.style = {
    fontFamily: 'Impact',
    fontSize: 40,
    fillColor: 'yellow',
    justification: 'center'
};


var pipeSpeed = -3
var pipe1 = new Object({
    skin: new Raster({
        source:"images/pipe.png",
        position: [535,745],
        size: new Size(70,600),
        rotation: 0
    }),
    speed: pipeSpeed
});  
var pipe2 = new Object({
    skin: new Raster({
        source:"images/pipe.png",
        position: [535,-45],
        size: new Size(70,600),
        rotation: 180
    }),
    speed: pipeSpeed
});  
var pipe3 = new Object({
    skin: new Raster({
        source:"images/pipe.png",
        position: [935,745],
        size: new Size(70,600),
        rotation: 0
    }),
    speed: pipeSpeed
});  
var pipe4 = new Object({
    skin: new Raster({
        source:"images/pipe.png",
        position: [935,-45],
        size: new Size(70,600),
        rotation: 180
    }),
    speed: pipeSpeed
});  

var pipe12Dif;
var pipe34Dif;

var endText = new PointText(new Point(250, 270));
endText.style = {
    fontFamily: 'Impact',
    fontSize: 60,
    fillColor: 'red',
    justification: 'center'
};
var endScoreText = new PointText(new Point(250, 350));
endScoreText.style = {
    fontFamily: 'Impact',
    fontSize: 40,
    fillColor: 'red',
    justification: 'center'
};
var restartText = new PointText(new Point(250, 450));
restartText.style = {
    fontFamily: 'Impact',
    fontSize: 60,
    fillColor: 'yellow',
    justification: 'center'
}
restartText.onClick = function(event) {
    gameOver=false;
    startGame();
}


//Functions:

pipe1.skin.onFrame = function(event){
    if(start){
        if(pipe1.skin.position.x <= -35){
            pipe1.skin.position.x = 800;
            pipe12Dif = Math.ceil(Math.random()*500-250);
            console.log(pipe12Dif);
            pipe1.skin.position.y = 745+pipe12Dif;
        }
        pipe1.skin.position.x += pipe1.speed;
    };
}
pipe2.skin.onFrame = function(event){
    if(start){
        if(pipe2.skin.position.x <= -35){
            pipe2.skin.position.x = 800;
            pipe2.skin.position.y = pipe12Dif-45;
        }
        pipe2.skin.position.x += pipe2.speed;
    };
}
pipe3.skin.onFrame = function(event){
    if(start){
        if(pipe3.skin.position.x <= -35){
            pipe3.skin.position.x = 800;
            pipe34Dif = Math.ceil(Math.random()*500-250);
            pipe3.skin.position.y = 745+pipe34Dif;
        }
        pipe3.skin.position.x += pipe3.speed;
    };
}
pipe4.skin.onFrame = function(event){
    if(start){
        if(pipe4.skin.position.x <= -35){
            pipe4.skin.position.x = 800;
            pipe4 .skin.position.y = pipe34Dif-45;
        }
        pipe4.skin.position.x += pipe4.speed;
    };
}

var scoreText = new PointText(new Point(50, 50));
scoreText.fillColor = "White";
scoreText.content = "Score: " + score;

function collisionCheck(){
    if(bird.skin.position.y >= 676||bird.skin.bounds.intersects(pipe1.skin.bounds)||bird.skin.bounds.intersects(pipe2.skin.bounds)||bird.skin.bounds.intersects(pipe3.skin.bounds)||bird.skin.bounds.intersects(pipe4.skin.bounds)){
        gameOver = true;
        start = false;
    }
}

function scoreCheck(){
    if((pipe1.skin.position.x<=bird.skin.position.x+1.5 && pipe1.skin.position.x>bird.skin.position.x-1.5)||(pipe3.skin.position.x<=bird.skin.position.x+1.5 && pipe3.skin.position.x>bird.skin.position.x-1.5)){
        score += 1;
        scoreText.content= "Score: " + score;
    }
}

function goTime(){
    collisionCheck();
    scoreCheck();
    if(Key.isDown('space')){
        bird.speed = -9;
    }
    bird.checkRot();
    bird.speed += bird.accel;
    bird.skin.position.y += bird.speed;
}
function setUp(){
    bird.skin.position = [200,300];
    bird.skin.size= new Size(50,47);
    pipe1.skin.position = [535,745];
    pipe2.skin.position = [535,-45];
    pipe3.skin.position = [935,745];
    pipe4.skin.position = [935,-45];
    pipe1.skin.size = pipe2.skin.size = pipe3.skin.size = pipe4.skin.size = new Size(70,600);
}
function startGame(){
    setUp();
    bird.speed = -9;
    start = true;
    titleText.visible = false;
    startText.visible = false;
    endText.content="";
    endScoreText.content="";
    restartText.visible = false;
    score = 0;
    scoreText.content = "Score: " + score;
    scoreText.visible = true;
}

function onFrame(event){
    if(start){
        goTime();
    }
    else if(gameOver){
        endText.content = "GAME OVER";
        endScoreText.content = score;
        restartText.visible=true;
        restartText.content = "Restart";
        scoreText.visible = false;
        
    }
    else{
        titleText.visible = true;
        startText.visible = true;
        scoreText.visible = false;
        setUp()
        if(Key.isDown('space')){
            startGame();
        }
    }
}