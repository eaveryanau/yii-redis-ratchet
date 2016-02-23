/**
 * Created by smile on 2/23/16.
 */

var conn = new WebSocket('ws://localhost:35001');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};

$(document).ready(function(){
    $('#raise a').click(function(){
        conn.send('raise');
        // TODO develop not enough
    })
})