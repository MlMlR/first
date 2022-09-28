import {drawBug, updateBug, BUG_SPEED} from "./bug.js";
import {SNAKE_SPEED, draw as drawSnake, update as updateSnake, snakeIntersection, getSnakeHead, snakeAteBug, snakeBody } from "./snake.js"
import {draw as drawFood, update as updateFood} from "./food.js"
import {outsideGrid} from "./grid.js";
import {bugExists} from "./input.js";


let lastRenderTime = 0
let gameOverMessage = "GAME OVER"
let gameOver = false
const gameBoard = document.getElementById('game-board')


function main(currentTime){
    if (gameOver){
        if (confirm(gameOverMessage)){
            window.location = ""
        }
        return
    }

    window.requestAnimationFrame(main)
    const secondsSinceLastRender = (currentTime - lastRenderTime) / 1000
    if (secondsSinceLastRender < 1 / SNAKE_SPEED) return

    lastRenderTime = currentTime

    update()
    draw()
}

window.requestAnimationFrame(main)

function update(){
    updateSnake()
    updateFood()
    if(bugExists){
        updateBug()
    }
    checkDeath()
}

function draw(){
    gameBoard.innerHTML = ''
    drawSnake(gameBoard)
    if(bugExists){
        drawBug(gameBoard)
    }
    drawFood(gameBoard)
}


function checkDeath(){

    if(outsideGrid(getSnakeHead())){
        gameOverMessage = "YOU LOST SNAKE"
        gameOver = true
    }

    if(!bugExists && snakeIntersection()){
        gameOverMessage = "YOU LOST SNAKE"
        gameOver = true
    }

    if(bugExists){
        if (snakeAteBug()){
            gameOverMessage = "YOU LOST BUG THE SNAKE ATE YOU"
            gameOver = true
        }
        if (snakeBody.length < 4){
            gameOverMessage = "YOU LOST SNAKE THE BUG ATE YOU"
            gameOver = true
        }
    }
}
