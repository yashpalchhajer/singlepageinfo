$(document).ready(function(){
    loadGraphData();
    // inItGraph(daysOfMonth);
});

function loadGraphData(){
    let monthDay = [];
    $.ajax({
        method: 'GET',
        url: baseUrl + '/getGraphData',
        data: {},
        success : function(response,textStatus,xhr){
            if(xhr.status == 200){
                response = JSON.parse(response);
                // console.log(typeof response);
                var days = response.data.daysOfMonth;
                monthDay = Object.keys(days).map(function (key) {return days[key]; });

                if(response.data){
                    fillTabsData(response.data);
                }

                inItGraph(monthDay); // intialize graph

            }else{
                return false;
            }
        },
        error: function(jqXHR,textStatus,errorThrown){
            console.log(jqXHR + ' ' + errorThrown);
        }        
    });
    
}

function inItGraph(daysOfMonth){
    console.log(typeof daysOfMonth);
    Highcharts.chart('enquiryGraph', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Enquiry and Response'
        },
        xAxis: {
            categories: daysOfMonth,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Days'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Enquiries',
            data: [49, 71, 71, 10, 106, 12, 129, 14, 144, 17, 176, 13, 135, 14, 148, 21, 216, 19, 194, 95, 95, 54, 54,65,85,106, 129, 144, 176, 135, 148, 216, 194]
    
        }, {
            name: 'Replies',
            data: [83, 78, 98, 93, 106, 84, 105, 104, 91, 83, 106, 92,60,82, 106, 129, 144, 176, 135, 148, 216, 194]
    
        }]
    });
}



function fillTabsData(data){
    document.getElementById('totalVisitors').innerText = data.totalVisitors;
    document.getElementById('totalSubscribers').innerText = data.totalSubs;
    document.getElementById('totalEnquiries').innerText = data.totalEnquiries;
    document.getElementById('totalReplies').innerText = data.totalReplies;
}