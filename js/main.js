function saveY(y){
    document.getElementById('valueY').value = y.value;
    y.disabled= true;
    let butttons = document.getElementsByClassName("inputY");
    for(let i = 0; i<butttons.length; ++i){
        if(butttons[i] !== y){
            butttons[i].disabled=false;
        }
    }
}
function saveR(r){
    document.getElementById('valueR').value = r.value;
    r.disabled= true;
    let butttons = document.getElementsByClassName("inputR");
    for(let i = 0; i<butttons.length; ++i){
        if(butttons[i] !== r){
            butttons[i].disabled=false;
        }
    }
}

$(document).ready(function () {

    $('#submitButton').click(function (event) {
        event.preventDefault();

        let x = document.getElementById('inputX').value.replace(',', '.');
        let y = document.getElementById("valueY").value;
        let r = document.getElementById("valueR").value;

        console.log("x: " + x + ", y: " + y + ", r: " + r);

        let sending = true;

        if (x == null || x < -5 || x > 3) {
            document.getElementById("divX").classList.add('error');
            sending = false;
        } else {
            document.getElementById("divX").classList.remove('error');
        }

        if (!y) {
            document.getElementById("divY").classList.add('error');
            sending = false;
        } else {
            document.getElementById("divX").classList.remove('error');
        }

        if (!r) {
            document.getElementById("divR").classList.add('error');
            sending = false;
        } else {
            document.getElementById("divR").classList.remove('error');
        }

        if (sending) {
            $.ajax({
                url: './php/main.php',
                method: "POST",
                data: {
                    x: x,
                    y: y,
                    r: r,
                    timezone: new Date().getTimezoneOffset()
                },
                success: function (data) {
                    $("#res").append(data);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });
});