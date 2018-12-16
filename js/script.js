var baseUrl = 'http://vinayak-admin/api/';
var basePath = 'http://vinayak-admin/uploads/toppers/';
$(document).ready(function(){
    
    getDynamics();

    $('#subEnquery').on('click',function(){
        if(validateEnquery()){
            submitEnquery();
        }
    });

    $('#subSubmit').on('click',function(){
        if(validateSubs()){
            subscribe();
        }
    })
});



function getDynamics(){
    $.ajax({
        method: 'GET', // Type of response and matches what we said in the route
        url: baseUrl + 'news', // This is the url we gave in the route
        data: {}, // a JSON object to send back
        success: function(response,textStatus, xhr){ // What to do if we succeed
            if(xhr.status == 200){
                response = JSON.parse(response);
                if('news' in response){
                    fillNews(response['news']);
                }else{
                    $('#section-news').hide();
                }
                if('toppers' in response){
                    fillToppers(response['toppers']);
                }else{
                    $('#toppersSection').hide();
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
            
            console.log(jqXHR + ' => ' + errorThrown);
        }
    });
}


function fillNews(news){
    dataTabs = '';
    $.each(news,function(key,val){
        dataTabs += '<p class="card-text">' + val.description +'</p>';
    });
    $('#news-div').append(dataTabs);
}

function fillToppers(toppers){
    dataRows = '';
    $.each(toppers,function(key,val){
        dataRows += '<div class="col-lg-4 col-md-12 mb-4">'
                +    '<div class="view overlay z-depth-1-half">'
                    +   '<img src="'+basePath + val.img_path +'" class="img-fluid" alt="">' 
                        +    '<div class="mask rgba-white-slight"></div>'
                    +'</div>'
        
                    +'<h4 class="my-4 font-weight-bold">'+ val.name +' </h4>'
                    +'<span class="my-5"> '+ val.course +' </span>';
        if(val.description != null)
        {
            dataRows += '<p class="grey-text">'+ val.description +'</p>';
        }
        dataRows +=  '</div>';
    });
    $('#toppersRow').append(dataRows);
}

function submitEnquery(){
    
    $.ajax({
        url : baseUrl + 'enquiry',
        type : 'POST',
        data : {
            'name' : $('#enqName').val(),
            'email' : $('#enqEmail').val(),
            'mobile' : $('#enqMobile').val(),
            'title' : $('#enqSub').val(),
            'enquiry' : $('#enqText').val()
        },
        success : function(response,textStatus, xhr){
            response = JSON.parse(response);
            if(xhr.status == 200){
                alert(response.message);
            }else{
                alert(response.message);
            }
        },
        error : function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
            alert('An unexpected error occured.');
        }
    });
    clearEnq();
}

function clearEnq(){
    $('#enqName').val('');
    $('#enqEmail').val('');
    $('#enqMobile').val('');
    $('#enqSub').val('');
    $('#enqText').val('');
}

function validateEnquery(){
    if($('#enqName').val() == ''){
        alert('Fill name');
        return false;
    }
    if($('#enqEmail').val() == ''){
        alert('Fill E-mail');
        return false;
    }
    if($('#enqSub').val() == ''){
        alert('Select subject of enquery');
        return false;
    }
    if($('#enqText').val() == ''){
        alert('Please put your message regarding enquiry');
        return false;
    }
    return true;
}

function validateSubs(){
    if($('#subName').val() == ''){
        alert('Fill name to subscribe');
        return false;
    }
    if($('#subEmail').val() == ''){
        alert('Fill email to subscribe');
        return false;
    }
    if($('#subMobile').val() == ''){
        alert('Fill mobile number to subscribe');
        return false;
    }
    return true;
}

function subscribe(){
    $.ajax({
        url : baseUrl + 'subscribe',
        type : 'POST',
        data : {
            'name' : $('#subName').val(),
            'email' : $('#subEmail').val(),
            'mobile' : $('#subMobile').val()
        },
        success : function(response,textStatus, xhr){
            response = JSON.parse(response);
            if(xhr.status == 200){
                alert(response.message);
            }else{
                alert('Some error occured on server white updatng data.');
            }
        },
        error : function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
            alert('An unexpected error occured.');
        }
    });
    clearSubForm();
}

function clearSubForm(){
    $('#subName').val('');
    $('#subEmail').val('');
    $('#subMobile').val('');
}
