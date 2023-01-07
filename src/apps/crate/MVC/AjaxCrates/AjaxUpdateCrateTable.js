function updateValue(element, column, code)
{
    let value = element.innerText;
    $.ajax({
        type: 'POST',
        url: '/?App=updateCrateTable',
        data:{
            value: value,
            column: column,
            code: code
        },
    })
        .done(function () {
            console.log('probably')
        })
        .fail(function () {
            console.log("FEHLSCHLAG");
        })
}

function activate()
{
    console.log('activated')

}