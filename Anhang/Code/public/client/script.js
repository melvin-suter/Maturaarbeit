$(document).ready(function(){

    /*** 
     * Define Tests
     ***/

    function consoleTest(){
        var temp = [];
        for(var i = 0; i < 1000; i++)
        {
            console.log(i);
        }
    };

    function loopTest(){
        var temp = [];
        for(var i = 0; i < 100000; i++)
        {
            temp.push(i+10);
        }

        for(key in temp)
        {
            temp.slice(key,key);
        }
    };

    function reqresCallTest(){
        var result = $.ajax({
            url: "https://reqres.in/api/users/1",
            type: 'GET',
            async: false
        });
    };
    
    function selfCallTest(){
        for(var i = 0; i < 10; i++)
        {
            var result = $.ajax({
                url: window.location.href+"test.txt",
                type: 'GET',
                async: false
            });
        }
    };

    function domTest(){
        for(var i = 0; i < 1000; i++)
        {
            $('#hidden-dom').append('<div class="test item">'+i+'</div>')
        }
    };

    /*** 
     * Define Variables & Constants
     ***/
    var results = [];
    var averages = [];
    var averageTotal = 0;
    const tests = [
        {'name': 'Loop Test', 'callback' : loopTest},
        {'name': 'Console Test', 'callback' : consoleTest},
        {'name': 'reqres Call Test', 'callback' : reqresCallTest},
        {'name': 'Self Call Test', 'callback' : selfCallTest},
        {'name': 'DOM Test', 'callback' : domTest},
    ];
    const serieTotalNr = 100;


    /*** 
     * Define Stopwatch
     ***/
    var stopwatch = function(callback){
        var start = new Date();
        callback();
        var end = new Date();
        return (end-start);
    };


    /*** 
     * Running Test Seties
     ***/

    $('#results').append('<tr id="head-row"></tr>');
    $('#results').append('<tr id="average-row"></tr>');
    $('#head-row').append('<th>Nr</th>')
    $('#average-row').append('<td>Average</td>')

    for(var serieNr = 0; serieNr <= serieTotalNr; serieNr++)
    {
        if(serieNr == 0)
        {
            var headrow = [];
            headrow.push("Nr");

            for(testID in tests)
            {
                var test = tests[testID];
                averages[testID] = 0;
                headrow.push(test.name);
                $('#head-row').append('<th>'+test.name+'</th>')                
            }

            headrow.push("Total");
            results.push(headrow);

            $('#head-row').append('<th>Total</th>')
        }
        else
        {
            var dataSet = [serieNr,0];
            var currentRow = $('<tr></tr>');
            currentRow.append('<td>'+serieNr+'</td>')

            for(testID in tests)
            {
                var test = tests[testID];
                var result = stopwatch(test.callback);
                dataSet.push(result);
                dataSet[1] += result;

                currentRow.append('<td>'+result+' ms</td>')

                averages[testID] = (averages[testID] * (serieNr - 1) + result) / serieNr;
            }
            
            averageTotal =  (averageTotal * (serieNr - 1) + dataSet[1]) / serieNr;
            currentRow.append('<td>'+dataSet[1]+' ms</td>')


            $('#results').append(currentRow);
            results.push(dataSet);
        }
    }

    for(testID in averages)
    {
        $('#average-row').append('<td id="'+testID+'">'+averages[testID]+' ms</td>');
    }
    $('#average-row').append('<td>'+averageTotal+' ms</td>');

    var averageRes = ['Average',averageTotal].concat(averages);
    results.splice(1,0,averageRes);

    $('#json-output').html(JSON.stringify(results));

});