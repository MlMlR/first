import {expandSnake, onSnake, snakeBody} from "./snake.js";
import {getBugDirection} from "./input.js";
import {randomGridPosition} from "./grid.js";


export const bugBody = randomGridPosition()
export const BUG_SPEED = 6



export function updateBug() {

    const bugDirection = getBugDirection()

    bugBody.x += bugDirection.x
    if(bugBody.x <1) {bugBody.x = 21}
    if(bugBody.x >21) {bugBody.x = 1}
    bugBody.y += bugDirection.y
    if(bugBody.y <1) {bugBody.y = 21}
    if(bugBody.y >21) {bugBody.y = 1}
}


export function drawBug(gameBoard) {

    const bugElement = document.createElement('div')
    bugElement.style.gridRowStart = bugBody.y
    bugElement.style.gridColumnStart = bugBody.x
    bugElement.classList.add('bug')
    gameBoard.appendChild(bugElement)

}


