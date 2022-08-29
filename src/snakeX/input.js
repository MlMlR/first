
let inputDirection = {x:0, y:-1}
let lastInputDirection = {x:0, y:0}
let bugInputDirection = {x:1, y:0}
let lastBugDirection = {x:0, y:0}
export let bugExists = false

window.addEventListener('keydown', e =>{
    switch (e.key){
        case "w":
            if (lastInputDirection.y !==0) break
            inputDirection = {x:0, y:-1}
            break
        case 's':
            if (lastInputDirection.y !==0) break
            inputDirection = {x:0, y:+1}
            break
        case 'a':
            if (lastInputDirection.x !==0) break
            inputDirection = {x:-1, y:0}
            break
        case 'd':
            if (lastInputDirection.x !==0) break
            inputDirection = {x:1, y:0}
            break
        case "ArrowUp":
            bugExists = true
            if (lastBugDirection.y  < 0)
            {
                bugInputDirection = {x:0, y:-2}
                break
            }
            bugInputDirection = {x: 0, y: -1}
            break

        case 'ArrowDown':
            if (lastBugDirection.y > 0)
            {
                bugInputDirection = {x:0, y:+2}
                break
            }
            bugInputDirection = {x:0, y:+1}
            break
        case 'ArrowLeft':
            if (lastBugDirection.x < 0)
            {
                bugInputDirection = {x:-2, y:0}
                break
            }
            bugInputDirection = {x:-1, y:0}
            break
        case 'ArrowRight':
            if (lastBugDirection.x > 0)
            {
                bugInputDirection = {x:2, y:0}
                break
            }
            bugInputDirection = {x:1, y:0}
            break
    }
})

export function getInputDirection(){
    lastInputDirection = inputDirection
    return inputDirection
}



export function getBugDirection(){
    lastBugDirection = bugInputDirection
    return bugInputDirection
}