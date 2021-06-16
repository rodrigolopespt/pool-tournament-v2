$(document).ready(function() {
    getTournament();
    buildRankingTable();
    buildGamesTable();
});

function getTournament(){
    $.ajax({
        type: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Access-Control-Allow-Origin': '*'
        },
        url: '/api/tournaments/1',
        dataType: 'json',
        success: function(result) {
            localStorage.setItem('friends',JSON.stringify(result.data.friends));
            localStorage.setItem('games',JSON.stringify(result.data.games));
        },
        error: function(err) {
            Swal.fire({
                title: 'Error!',
                text: err,
                icon: 'error',
                confirmButtonText: 'Okay'
            })
        }
    });
}

function buildRankingTable(){
    var friends = JSON.parse(localStorage.getItem("friends"));
    var rankingTable = $('#rankingTable tbody');
    rankingTable.empty();
    var len = friends.length;
    for(var i=0;i<len;i++) {
        console.log(friends[i]);
        var rank=friends[i].tournaments.current_rank;
        var name=friends[i].name;
        var points=friends[i].tournaments.points;
        var balls_left=friends[i].tournaments.balls_left;
        rankingTable.append('<tr><td class="text-center">'+rank+'</td><td>'+
            name+'</td><td class="text-center">'+points+'</td><td class="text-center diff">'+balls_left+
            '</td></tr>');
    }
}

function buildGamesTable(){
    var games = JSON.parse(localStorage.getItem("games"));
    var gamesTable = $('#gamesTable tbody');
    gamesTable.empty();
    var len = games.length;
    for(var i=0;i<len;i++) {
        var id=games[i].id;
        var date=games[i].date;
        var friend1=games[i].friends[0];
        var friend2=games[i].friends[1];
        var winner=games[i].winner_id;
        var no_show=games[i].no_show;
        var balls_left=games[i].balls_left;
        gamesTable.append(
            '<tr>'
                +'<td class="text-center">'+date+'</td>'
                +'<td class="text-center friend-td">'
                    +'<a href="/friends/'+friend1.id+'">'+friend1.name+'</a>'
                    +(winner==friend1.id ? '<img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Trophy_Flat_Icon.svg" style="max-height:30px;">' : (no_show == 1 ? '<br><small>(Absence)</small>' : '<br><small>('+balls_left+' Balls Left)</small>'))
                +'</td>'
                +'<td class="text-center">vs</td>'
                +'<td class="text-center friend-td">'
                    +'<a href="/friends/'+friend2.id+'">'+friend2.name+'</a>'
                    +(winner==friend2.id ? '<img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Trophy_Flat_Icon.svg" style="max-height:30px;">' : (no_show == 1 ? '<br><small>(Absence)</small>' : '<br><small>('+balls_left+' Balls Left)</small>'))
                +'</td>'
                +'<td class="text-center"><a href="/games/'+id+'"class="btn btn-sm btn-outline-primary">Details</a></td>'
            +'</tr>'
        );
    }
}

/* $(document).ready(function() {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox=$('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if(this.checked) {
            checkbox.each(function() {
                this.checked=true;
            });
        } else {
            checkbox.each(function() {
                this.checked=false;
            });
        }
    });
    checkbox.click(function() {
        if(!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
}); */