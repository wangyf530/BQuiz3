<style>
.order-form {
    width: 500px !important;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #999;
    background: #eee;
}

.order-form td:nth-child(1) {
    width: 100px;
    text-align: center;
}

.order-form td:nth-child(2) {
    width: 300px;
    text-align: left;
}

.order-form td {
    border: 1px solid #ccc;
}

.order-form tr:nth-child(even) {
    background: #ccc;
}

#booking *{
    box-sizing:border-box;
}
</style>

<div id="order">
<h3 class='ct'>線上訂票</h3>
<form action="#">
    <table class="order-form">
        <tr>
            <td>電影：</td>
            <td>
                <select name="movie" id="movie" style="width:300px;"></select>
            </td>
        </tr>
        <tr>
            <td>日期：</td>
            <td>
                <select name="date" id="date" style="width:300px;"></select>
            </td>
        </tr>
        <tr>
            <td>場次：</td>
            <td>
                <select name="session" id="session" style="width:300px;"></select>
            </td>
        </tr>
        <tr>
            <td colspan='2' class='ct'>
                <input type="button" value="確定" onclick="booking()">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
</div>

<div id="booking" style="display:none;">
</div>


<script>
getMovies();
let id = new URLSearchParams(location.href).get('id');
// object
// console.log(id);

// 選擇的電影被更改的時候 再重新getDays()獲取可以看的日期
$("#movie").on("change", function() {
    getDays();
})

// 選擇的日期被更改的時候 再重新getSessions() 獲取可以看的時間
$("#date").on("change", function() {
    getSessions();
})

// 獲取上映三天內顯示的電影
function getMovies() {
    $.get("api/get_movies.php", function(movies) {
        console.log('movies', movies);
        $("#movie").html(movies);

        if (parseInt(id) > 0) {
            $(`#movie option[value='${id}']`).prop('selected', true);
        }
        getDays();
    })
}

// 獲取該電影能看的日期
function getDays() {
    $.get("api/get_days.php", {
        movie: $("#movie").val()
    }, function(days) {
        $("#date").html(days);
        getSessions();
    })
}

// 可以看的時間
function getSessions() {
    $.get("api/get_sessions.php", {
        movie: $("#movie").val(),
        date: $("#date").val()
    }, function(sessions) {
        $("#session").html(sessions);
    })
}

// type: object
let movie = {};

// 訂票
function booking(){
    // 拿到電影相關資訊
    movie = {
        id:$("#movie").val(),
        name:$("#movie option:selected").text(),
        date:$("#date").val(),
        session:$("#session").val()
    }

    // $("#booking").html(`${movie.id},${movie.date},${movie.name}, ${movie.session}, <button onclick="$('#order,#booking').toggle()">上一步</button>`);

    $.get("api/booking.php",movie, function(booking){
        $("#booking").html(booking);
        $("#booking, #order").toggle();
    })

    // $("#booking, #order").toggle();
}

</script>