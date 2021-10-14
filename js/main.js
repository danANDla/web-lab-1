var x = document.getElementById("x-input");
var y = document.getElementById("y-input");

//-----------------------------validation--------------------------------
function validation(){
    console.log('validation func');
    let r = $("input[name='r-input']:checked").val();
    if (typeof r == 'undefined') {
        r = '';
    }
    console.log(x.value);
    console.log(y.value);
    console.log(r);

    let x_flag = true;
    let y_flag = true;
    let r_flag = true;

    if (x.value === ''){
        x_flag = false;
        document.getElementById("x-invite").style.color = "#AC2205";
        document.getElementById("x-invite").style.fontWeight = "normal";
    }
    else{
        document.getElementById("x-invite").style.color = "white";
        document.getElementById("x-invite").style.fontWeight = "lighter";
    }
    if (y.value === '' || y.value>3 || y.value<-3 || isNaN(y.value)){
        y_flag = false;
        if(y.value === ''){
            document.getElementById("y-invite").style.color = "#AC2205";
            document.getElementById("y-invite").style.fontWeight = "normal";
            document.getElementById("y-err").innerHTML = "";
        }
        else{
            document.getElementById("y-invite").style.color = "white";
            document.getElementById("y-invite").style.fontWeight = "lighter";
            document.getElementById("y-err").innerHTML = "(value should be a number from (-3;3)";
        }
    }
    else{
        document.getElementById("y-invite").style.color = "white";
        document.getElementById("y-invite").style.fontWeight = "lighter";
        document.getElementById("y-err").innerHTML = "";
    }
    if (r === ''){
        r_flag = false;
        document.getElementById("r-invite").style.color = "#AC2205";
        document.getElementById("r-invite").style.fontWeight = "normal";
    }
    else{
        document.getElementById("r-invite").style.color = "white";
        document.getElementById("r-invite").style.fontWeight = "lighter";
    }
    return(x_flag && y_flag && r_flag);
}

//-----------------------------HTTP-request--------------------------------
function phpreq(){
    console.log("phpreq");
    let r = $("input[name='r-input']:checked").val();
    if (typeof r == 'undefined') {
        r = '';
    }
    $.ajax({
        url: "ser.php",
        type: "GET",
        data: {
            "x-val": x.value,
            "y-val": y.value,
            "r-val": r
        },
        cache: false,
        success: function (response){
            console.log('success');
            let msg = "";
            $('#post').html(msg);
            let table = document.getElementById("result-table-body");
            if(response === "invalid values"){
                document.getElementById("x-invite").style.color = "#AC2205";
                document.getElementById("x-invite").style.fontWeight = "normal";

                document.getElementById("y-invite").style.color = "#AC2205";
                document.getElementById("y-invite").style.fontWeight = "normal";

                document.getElementById("r-invite").style.color = "#AC2205";
                document.getElementById("r-invite").style.fontWeight = "normal";
            }
            else{
                table.insertAdjacentHTML('beforeend', response);
            }
        },
        error: function (jqXHR, exception) {
            let msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            $('#post').html(msg);
        },
    })
}

function submit(){
    if(validation()) phpreq();
}

function reset(){
    $("input[name='r-input']:checked").prop('checked', false);
    x.value = '';
    y.value = '';

    document.getElementById("x-invite").style.color = "white";
    document.getElementById("x-invite").style.fontWeight = "lighter";
    document.getElementById("y-invite").style.color = "white";
    document.getElementById("y-invite").style.fontWeight = "lighter";
    document.getElementById("y-err").innerHTML = "";
    document.getElementById("r-invite").style.color = "white";
    document.getElementById("r-invite").style.fontWeight = "lighter";

}

function clear(){
    document.getElementById("result-table-body").innerHTML="";
    $.ajax({
        url: "clear.php",
        type: "GET",
        cache: false,
        success: function (response){
            console.log('success');
            let msg = "";
            $('#post').html(msg);
        },
        error: function (jqXHR, exception) {
            let msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            $('#post').html(msg);
        },
    })
}

function restore(){
    $.ajax({
        url: "restore.php",
        async: true,
        type: "GET",
        success: function (response){
            let table = document.getElementById("result-table-body");
            table.insertAdjacentHTML('beforeend', response);
        }
    })
}

//-----------------------------submit--------------------------------
$( document ).ready(function() {
    $((document).getElementById('submit-btn')).on('click', function (event){
        event.preventDefault();
        submit();
        console.log('submitted');
    })
})

$(document).ready(function() {
    $('form input[type="text"]').keydown(function(event){
        if(event.keyCode === 13) {
            event.preventDefault();
            submit();
            console.log('submitted');
        }
    });
});


//-----------------------------reset--------------------------------
$( document ).ready(function() {
    $((document).getElementById('reset-btn')).on('click', function (event){
        event.preventDefault();
        reset();
        console.log('resetted');
    })
})

//-----------------------------clear table--------------------------------
$( document ).ready(function() {
    $((document).getElementById('clear-btn')).on('click', function (event){
        event.preventDefault();
        clear();
        console.log('cleared');
    })
})

//-----------------------------restore table--------------------------------
$(document).ready(function () {
    restore();
    console.log('restored');
})