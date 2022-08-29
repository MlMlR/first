
import {onSnake, expandSnake ,equalPositions} from "./snake.js";
import {randomGridPosition} from "./grid.js";
import {bugBody} from "./bug.js";
import {bugExists} from "./input.js";


let food = [
    getRandomFoodPosition(),
    getRandomFoodPosition()
]
const EXPANSION_RATE = 5

export function update(){

    for (let i=0; i< food.length; i++){
        if (onSnake(food[i])){
            food.splice(i,1);
            expandSnake(EXPANSION_RATE)
            food.push(getRandomFoodPosition())
        }
        if (equalPositions(bugBody, food[i])){
            food.splice(i,1)
            food.push(getRandomFoodPosition())

        }
    }
    if(bugExists && food.length < 11){
        food.push(getRandomFoodPosition())
    }
}


export function draw(gameBoard){
    food.forEach(segment => {
        const foodElement = document.createElement('div')
        foodElement.style.gridRowStart = segment.y
        foodElement.style.gridColumnStart = segment.x
        foodElement.classList.add('food')
        gameBoard.appendChild(foodElement)
    })
}

function getRandomFoodPosition(){
    let newFoodPosition
    while (newFoodPosition == null || onSnake(newFoodPosition)){
        newFoodPosition = randomGridPosition()
    }
    console.log(newFoodPosition)
    return newFoodPosition
}

