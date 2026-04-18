$(function(){
var checkQuest;

var hout30;
var leem30;
var ijzer30;
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D
// AJAX CALLS :D


$.ajax({
      url: 'quests.php',
      async: false,
      type: 'post',
      // dataType: "json",
      data: {'getQuest': 'getQuest'},
      success: function(getQuest) {
          checkQuest = jQuery.parseJSON(getQuest);
          var hout30 = checkQuest[0]['hout30'];
      }
})
quest = checkQuest[0];

if(quest['hout30'] < 1){
  $.ajax({
        url: 'quests.php',
        type: 'post',
        data: {'houthakker': 'houthakker'},
        success: function(houthakker) {
            var houthakker = jQuery.parseJSON(houthakker);
            if(houthakker[0]['wood'] === '30'){
              houthakker30(houthakker[0]['id']);
              
            }
        }
  })
}

if(quest['ijzer30'] < 1){
  $.ajax({
        url: 'quests.php',
        type: 'post',
        data: {'ijzermijn': 'ijzermijn'},
        success: function(ijzermijn) {
            var ijzermijn = jQuery.parseJSON(ijzermijn);
            if(ijzermijn[0]['iron'] === '30'){
              ijzermijn30(ijzermijn[0]['id']);
              }
        }
  })
}

if(quest['leem30'] < 1){
  $.ajax({
        url: 'quests.php',
        type: 'post',
        data: {'leemgroeve': 'leemgroeve'},
        success: function(leemgroeve) {
            var leemgroeve = jQuery.parseJSON(leemgroeve);
            if(leemgroeve[0]['iron'] === '30'){
              leemgroeve30(leemgroeve[0]['id']);
              }
        }
  })
}

// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D
// FUNCTIONS THAT WILL BE CALLED AFTER THE CHECK FOR THE LEVELS :D



function ijzermijn30(villid){
  $.ajax({
      url: 'questscomplete.php',
      type: 'post',
      data: {'ijzermijn': 'ijzermijn', 'villid': villid},
      success: function(ijzermijn) {
        if(ijzermijn == '"ijzermijn"'){
          // Hier kan ik dus iets moois inzetten :$.. bijvoorbeeld show een div.
        }
      }
})
}
function leemgroeve30(villid){
  $.ajax({
      url: 'questscomplete.php',
      type: 'post',
      data: {'leemgroeve': 'leemgroeve', 'villid': villid},
      success: function(leemgroeve) {
        if(leemgroeve == '"leemgroeve"'){
          // Hier kan ik dus iets moois inzetten :$.. bijvoorbeeld show een div.
        }
      }
})
}
function houthakker30(villid){
  $.ajax({
      url: 'questscomplete.php',
      type: 'post',
      data: {'houthakker': 'houthakker', 'villid': villid},
      success: function(houthakker) {
        if(houthakker == '"houthakker"'){
          // Hier kan ik dus iets moois inzetten :$.. bijvoorbeeld show een div.
        }
      }
})
}























});