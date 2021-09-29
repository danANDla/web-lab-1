var x = document.getElementById("x-input");
var y = document.getElementById("y-input");
var r = document.getElementById("")

$( document ).ready(function() {
    console.log('ready!');
        $((document).getElementById('submit-btn')).on('click', function (event){
            alert('submitted');
            event.preventDefault();
        })
})

$( document ).ready(function() {
    $((document).getElementById('reset-btn')).on('click', function (event){
        alert('resetted');
        event.preventDefault();
    })
})
