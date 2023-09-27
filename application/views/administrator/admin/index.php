<style>
.table1 {
    font-family: sans-serif;
    color: #444;
    border-collapse: collapse;
    width: 50%;
    border: 1px solid #f2f5f7;
}

.table1 tr th {
    background: #35A9DB;
    color: #fff;
    font-weight: normal;
}


.table1,
th,
td {
    padding: 8px 20px;
    text-align: center;
}

.table1 tr:hover {
    background-color: #f5f5f5;
}

.table1 tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>


<div class="content-wrapper">
    <section class="content">

        <div class="row">
            <div class="container">
                <h3 class="text-center" id="jam"></h3>

            </div>

            <div class="container">
                <h3 class="text-center"> Welcome !!</h3>

            </div>
        </div>

</div>

<script>
window.onload = function() {
    jam();
}

function jam() {
    var e = document.getElementById('jam'),
        d = new Date(),
        h, m, s;
    h = d.getHours();
    m = set(d.getMinutes());
    s = set(d.getSeconds());

    e.innerHTML = h + ':' + m + ':' + s;

    setTimeout('jam()', 1000);
}

function set(e) {
    e = e < 10 ? '0' + e : e;
    return e;
}
</script>