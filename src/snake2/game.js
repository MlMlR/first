
//import Snake from "./snake.js"
//import {draw as drawFood, update as updateFood} from "./food.js"
//import {outsideGrid, randomGridPosition} from "./grid.js";
//import Input from "./input";


const GRID_SIZE = 21
let gameOver = false
let lastRenderTime = 0
const gameBoard = document.getElementById('game-board')





class Snake {
    constructor(snakeBody, newSegments) {
        this.snakeBody = snakeBody;
        this.newSegments = newSegments;
    }




    update() {
        this.addSegments()
        const inputDirection = this.getInputDirection()
        for (let i = this.snakeBody.length - 2; i >= 0; i--) {
            this.snakeBody[i + 1] = {...this.snakeBody[i]}
        }
        this.snakeBody[0].x += inputDirection.x
        if (this.snakeBody[0].x < 1) {
            this.snakeBody[0].x = 21
        }
        if (this.snakeBody[0].x > 21) {
            this.snakeBody[0].x = 1
        }
        this.snakeBody[0].y += inputDirection.y
        if (this.snakeBody[0].y < 1) {
            this.snakeBody[0].y = 21
        }
        if (this.snakeBody[0].y > 21) {
            this.snakeBody[0].y = 1
        }
    }


    draw(gameBoard) {
        this.snakeBody.forEach(segment => {
            const snakeElement = document.createElement('div')
            snakeElement.style.gridRowStart = segment.y
            snakeElement.style.gridColumnStart = segment.x
            snakeElement.classList.add('snake')
            gameBoard.appendChild(snakeElement)
        })

    }


    expandSnake(amount) {
        this.newSegments += amount
    }


    onSnake(position, {ignoreHead = false} = {}) {
        return snakeBody.some((segment, index) => {
            if (ignoreHead && index === 0) return false
            return this.equalPositions(segment, position)
        })
    }


    getSnakeHead() {
        return this.snakeBody[0]
    }


    snakeIntersection() {
        return this.onSnake(this.snakeBody[0], {ignoreHead: true})
    }


    equalPositions(pos1, pos2) {
        return pos1.x === pos2.x && pos1.y === pos2.y
    }


    addSegments() {
        for (let i = 0; i < this.newSegments; i++) {
            this.snakeBody.push({...this.snakeBody[this.snakeBody.length - 1]})
        }
        this.newSegments = 0
    }

    inputDirection = {x: 0, y: 0};
    lastInputDirection = {x: 0, y: 0};


    getInputDirection() {

        window.addEventListener('keydown', e => {
            switch (e.key) {
                case "w":
                    if (this.lastInputDirection.y !== 0) break
                    this.inputDirection = {x: 0, y: -1}
                    break
                case 's':
                    if (this.lastInputDirection.y !== 0) break
                    this.inputDirection = {x: 0, y: +1}
                    break
                case 'a':
                    if (this.lastInputDirection.x !== 0) break
                    this.inputDirection = {x: -1, y: 0}
                    break
                case 'd':
                    if (this.lastInputDirection.x !== 0) break
                    this.inputDirection = {x: 1, y: 0}
                    break


            }


        })
        this.lastInputDirection = this.inputDirection;
        return this.inputDirection;

    }
}
let Player1 = new Snake(6,[{x: 6, y: 6}],0);






function checkDeath(gameOver){
    gameOver = outsideGrid(Snake.getSnakeHead()) || Snake.snakeIntersection()
}







let food = getRandomFoodPosition()
const EXPANSION_RATE = 5

function updateFood(){
    if (Snake.onSnake(food)){
        Snake.expandSnake(EXPANSION_RATE)
        food = getRandomFoodPosition()
    }
}


function drawFood(gameBoard){
    const foodElement =document.createElement('div')
    foodElement.style.gridRowStart = food.y
    foodElement.style.gridColumnStart = food.x
    foodElement.classList.add('food')
    gameBoard.appendChild(foodElement)
}

function getRandomFoodPosition(){
    let newFoodPosition
    while (newFoodPosition == null || Player1.onSnake(newFoodPosition)){
        newFoodPosition = randomGridPosition()
    }
    console.log(newFoodPosition)
    return newFoodPosition
}




function randomGridPosition() {
    return {
        x: Math.floor(Math.random() * GRID_SIZE) + 1,
        y: Math.floor(Math.random() * GRID_SIZE) + 1
    }
}


function outsideGrid(position){
    return (
        position.x < 1 || position.x > GRID_SIZE ||
        position.y < 1 || position.y > GRID_SIZE
    )
}





function main(currentTime){
    checkDeath()

    if(gameOver){
        if (confirm("GAME OVER")){
            window.location = "/src/snake2"
        }
        return
    }

    window.requestAnimationFrame(main)

    const secondsSinceLastRender = (currentTime - lastRenderTime) / 1000

    if (secondsSinceLastRender < 1 / 6) return

    lastRenderTime = currentTime

    Player1.update()
    Player1.draw(gameboard)
    gameBoard.innerHTML = ''

    updateFood()
    drawFood(gameBoard)

}

window.requestAnimationFrame(main)




