import {bugExists, getInputDirection} from "./input.js"
import {bugBody} from "./bug.js";


export const SNAKE_SPEED = 6
export const snakeBody = [
    {x:11, y:11},
    {x:11, y:12},
    {x:11, y:13},
    {x:11, y:14},
    {x:11, y:15}
]

let newSegments = 0


export function update() {
    addSegments()
    if(bugExists){
        reduceSegments()
    }
    const inputDirection = getInputDirection()
    for (let i = snakeBody.length - 2; i >= 0; i--){
        snakeBody[i + 1] = { ...snakeBody[i] }
    }
    snakeBody[0].x += inputDirection.x
    if(snakeBody[0].x <1) {snakeBody[0].x = 21}
    if(snakeBody[0].x >21) {snakeBody[0].x = 1}
    snakeBody[0].y += inputDirection.y
    if(snakeBody[0].y <1) {snakeBody[0].y = 21}
    if(snakeBody[0].y >21) {snakeBody[0].y = 1}
}


export function draw(gameBoard) {
    snakeBody.forEach(segment => {
        const snakeElement = document.createElement('div')
        snakeElement.style.gridRowStart = segment.y
        snakeElement.style.gridColumnStart = segment.x
        snakeElement.classList.add('snake')
        gameBoard.appendChild(snakeElement)
    })
}


export function expandSnake(amount) {
    newSegments += amount
}


export function onSnake(position, {ignoreHead= false} ={}) {
    return snakeBody.some((segment,index) => {
        if (ignoreHead && index === 0) return false
        return equalPositions(segment, position)
    })
}



export function getSnakeHead() {
    return snakeBody[0]
}


export function snakeIntersection() {
    return onSnake(snakeBody[0], {ignoreHead: true})
}


export function equalPositions(pos1, pos2) {
    return pos1.x === pos2.x && pos1.y === pos2.y
}


function addSegments() {
    for(let i = 0; i < newSegments; i++){
        snakeBody.push({...snakeBody[snakeBody.length - 1]})
    }
    newSegments = 0
}

function reduceSegments(){
    if (onSnake(bugBody)){
        snakeBody.pop()
        snakeBody.pop()
    }
}

export function snakeAteBug(){
    return equalPositions(getSnakeHead(), bugBody)
}