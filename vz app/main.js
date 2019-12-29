//define main input vars
var nameInp;
var realmInp;

var regex = /([0-9\s])/g;

var wowArr;
var wowAch;
var wowSts;
var comments;

//adjust window height
$('body').css("height", window.innerHeight);

//get current rating
function ajaxR() {
    //by adding the return you can now appy the wait and done params
    return $.post("main.php?ajax=true", {name: $('.nameinp').val().toLowerCase(), realm: $('.realminp').val().toLowerCase()},
    function (data)
        { axisR = data; }
    );
};

//get achievements
function ajaxA() {
    //by adding the return you can now appy the wait and done params
    
        return $.post("achs.php?ajax=true", {name: $('.nameinp').val().toLowerCase(), realm: $('.realminp').val().toLowerCase()},
        function (data)
            { axisA = data; }
        );
    
};

//get stats
function ajaxS() {
    return $.post("statistics.php?ajax=true", {name: $('.nameinp').val().toLowerCase(), realm: $('.realminp').val().toLowerCase()},
    function (data)
        { axisS = data; }
    );
}

//get comments
function get_comments() {
    return $.post("comments.php?ajax=true", {name: $('.nameinp').val().toLowerCase(), realm: $('.realminp').val().toLowerCase()},
        function(data) {
            if (data!=='') {
                comments = data; 
            } else {
                comments = 'there are no comments for this character :(';  
            };
        }
    );
}

function add_modal() {
    $('body').append("<div class='comment-modal'><textarea name='comment-textarea' class='comment-textarea'>Your comment must be below 100 characters</textarea><br><input type='button' name='submit-comment' class='submit-comment' value='add comment' onclick='submit_comment()'/></div>");
    alert('this functionality is still being developed, be patient');
};

function submit_comment() {
   alert($('.comment-textarea').val()); 
   $('.comment-modal').remove();
};




//Start getting the objects
function start() {
    nameInput = $('.nameinp').val();
    realmInput = $('.realminp').val();
    if (nameInput === '' ){
        $('.error-message-name').html('<br>please enter a valid name');
    } else if (realmInput === '') {
        $('.error-message-name').html('');
        $('.error-message-realm').html('<br>please enter a valid realm');
    } else if (nameInput.match(regex)||realmInput.match(regex)) {
        $('.error-message-name').html('');
        $('.error-message-realm').html('');
        
        if (nameInput.match(regex)) {
                $('.error-message-name').html('<br>no spaces or numbers allowed in the name xo');
            } else if (realmInput.match(regex)) {
                $('.error-message-realm').html('<br>no spaces or numbers allowed in realm');
            }
            
    } else {
    
    $( ".loader-img").toggle(); 
    
    $.when(ajaxR(), ajaxA(), ajaxS(), get_comments()).done(function() {    
         wowArr = JSON.parse(axisR);
         wowAch = JSON.parse(axisA);
         wowSts = JSON.parse(axisS);
         if (wowArr.name&&wowAch.name&&wowSts.name) {
         wow2s = wowArr.pvp.brackets.ARENA_BRACKET_2v2.rating;
         wow3s = wowArr.pvp.brackets.ARENA_BRACKET_3v3.rating;
         wow5s = wowArr.pvp.brackets.ARENA_BRACKET_5v5.rating;
         
         wowRBGs = wowArr.pvp.brackets.ARENA_BRACKET_RBG.rating;
         //Pvp Statistics
         pvpSts = wowSts.statistics.subCategories[9];
         
         rating2v2 = pvpSts.subCategories[0].statistics[24]; //highest 2s
         rating3v3 = pvpSts.subCategories[0].statistics[23]; //highest 3s
         rating5v5 = pvpSts.subCategories[0].statistics[22]; //highest 5s
         
         function getHighestDate(x) {
             y = x.lastUpdated;
             if (y === 0) {
                 return "Is yet to play";
             } else {
                return new Date(x.lastUpdated).toDateString();
             }
         }
         
         //class
         //4 is rogue, dk = 6, pally = 2, hunter=3, lock =9, priest = 5, mage = 8, druid = 11, warrior = 1, monk = 10, shaman = 7
         var playerClass;
         switch(wowArr.class) {
             case 1:
             playerClass = "Warrior";
             break;
             case 2:
             playerClass = "Paladin";
             break;
             case 3:
             playerClass = "Hunter";
             break;
             case 4:
             playerClass = "Rogue";
             break;
             case 5:
             playerClass = "Priest";
             break;
             case 6:
             playerClass = "Death Knight";
             break;
             case 7:
             playerClass = "Shaman";
             break;
             case 8:
             playerClass = "Mage";
             break;
             case 9:
             playerClass = "Lock";
             break;
             case 10:
             playerClass = "Monk";
             break;
             case 11:
             playerClass = "Druid";
             break;
         }
         
         
         //Titles
         achievementZ = [];
         
         if (wowAch.achievements.achievementsCompleted.indexOf(2090) > 1) {
             var ai = wowAch.achievements.achievementsCompleted.indexOf(2090);
             var cDate = wowAch.achievements.achievementsCompletedTimestamp[ai];
             cDate = new Date(cDate);
             
             challenger = "Challanger - <span class='glow'>" + cDate.toDateString()+"</span>";
             achievementZ.push(challenger);
         } if (wowAch.achievements.achievementsCompleted.indexOf(2093) > 1) {
             var ai = wowAch.achievements.achievementsCompleted.indexOf(2093);
             var cDate = wowAch.achievements.achievementsCompletedTimestamp[ai];
             cDate = new Date(cDate);
             
             rival = "Rival - <span class='glow'>" + cDate.toDateString()+"</span>";
             achievementZ.push(rival);
         } if (wowAch.achievements.achievementsCompleted.indexOf(2092) > 1) {
             var ai = wowAch.achievements.achievementsCompleted.indexOf(2092);
             var cDate = wowAch.achievements.achievementsCompletedTimestamp[ai];
             cDate = new Date(cDate);
             
             duelist = "Duelist - <span class='glow'>" + cDate.toDateString()+"</span>";
             achievementZ.push(duelist);
         } if (wowAch.achievements.achievementsCompleted.indexOf(2091) > 1) {
             var ai = wowAch.achievements.achievementsCompleted.indexOf(2091);
             var cDate = wowAch.achievements.achievementsCompletedTimestamp[ai];
             cDate = new Date(cDate);
             
             
             gladiator = "Gladiator - <span class='glow'>" + cDate.toDateString() +"</span>";
             achievementZ.push(gladiator);
         };     
                $('.main-content').css({'top' : 'auto', 'transform' : 'none', 'webkit-transform' : 'none', 'ms-transform' : 'none'});
                var html_content = '';
                html_content += "<div class='body-content'>";
                html_content += "<div class='data-content'>";
                html_content += "\
                                 <div class='player-title-data'><h1>" + wowArr.name + " - </h1><h1 class='class-type'>" + playerClass + "</h1></div>\
                                 <div class='arena-titles'>       \
                                 <h2> Arena Titles (Account Wide)</h2>" + achievementZ.join('<br />') + "<br /><br />\
                                 </div>\
                                 <div class='highest-arena-rating'>\
                                 <h2>Highest Arena Ratings</h2>\
                                 <span style='color: #FFFFFF;'>" + rating2v2.name + "</span>" + ": <span class='glow'>" + rating2v2.quantity + "</span><br/>" + getHighestDate(rating2v2) + "<br/><br/>\
                                 <span style='color: #FFFFFF;'>" + rating3v3.name + "</span>" + ": <span class='glow'>" + rating3v3.quantity + "</span><br/>" + getHighestDate(rating3v3) + "<br/><br/>\
                                 <span style='color: #FFFFFF;'>" + rating5v5.name + "</span>" + ": <span class='glow'>" + rating5v5.quantity + "</span><br/>" + getHighestDate(rating5v5) + "<br/><br/>\
                                 </div>\
                                 <div class='current-rating'>\
                                 <h2>Current Arena Rating</h2>2v2 Rating: <span class='glow'>" + wow2s + "</span><br />" + "3v3 Rating: <span class='glow'>" + wow3s + "</span><br/>" + "5v5 Rating: <span class='glow'>" + wow5s + "</span><br /><br />\
                                 <h2>Current RBG Rating</h2>RBG Rating: <span class='glow'>" + wowRBGs + '</span><br /><br />\
                                 </div>\
                                 <div class="new-btn"><img src="versez-btn-new.png" alt="versez go button" class="versez-go-btn" /><input type="button" class="homebtn" name="startGame" value="new" onclick="reloadW();"></div>';
                //comment system
                html_content += "<div class='comments'>";
                html_content += "\
                                <h1>Comments</h1><input type='button' class='add-comment' name='add-comment' value='add comment' onclick='add_modal()'/>\
                                <div class='comments-area'>"+comments+"</div>";
                html_content += "</div>";
                
                html_content += "</div>";
                html_content += "</div>";
                
                $('.main-content').html(html_content);
                
                urlState = realmInput.toLowerCase() + '/' + nameInput.toLowerCase();
                
                window.history.pushState('', '', urlState);
    } else {
        $('.main-content').html("<div class='body-content'><div class='data-content'><h1>Sorry We Can't Seem To Find Your Character</h1><input type='button' class='homebtn' name='startGame' value='back' onclick='reloadW();'></div></div>");
    };
    
        
    }); 
}
};

function reloadW() {
    window.location.assign('http://versez.com');
}


var available_realms;
    $.ajax({
        url: 'realm_list.php',
        method: 'POST',
        success: function (data) {
            available_realms = JSON.parse(data);
            autoComplete();
        }
    });

function autoComplete() {
    $('.realminp').autocomplete({
       source: available_realms,
       minLength: 3
    });
}


$(document).keypress(function(e) {
    if(e.which == 13) {
        start();
    }
});

var shareData = (function() {
    return function(fileName) {
        json = 'herro';
        blob = new blob([json], {type:'octet/stream'});
        url = window.URL.creatObjectURL(blob);
        
        alert('test');
        window.location.assign(url);
    };
}());