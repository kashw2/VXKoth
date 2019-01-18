document.addEventListener("DOMContentLoaded", function() {

var uid2guid = function(uid) {
    
    var uid = document.getElementById('uid').value;
    
    console.log(uid);
    
    var steamId = bigInt(uid);
    
    console.log(steamId);
    
    var parts = [0x42,0x45,0,0,0,0,0,0,0,0];
    
    for (var i = 2; i < 10; i++) {
        var res = steamId.divmod(256);
        steamId = res.quotient; 
        parts[i] = res.remainder.toJSNumber();
    }
    
    var wordArray = CryptoJS.lib.WordArray.create(new Uint8Array(parts));
    var hash = CryptoJS.MD5(wordArray);
    return hash.toString();
};

$(document).ready(function() { 
    
    // Above event handler not required but too lazy to change
    
    console.log("UID - GUID, Function Loaded");
    
    var uid = document.getElementById('uid').innerHTML;
    
    $("#guid").val(uid2guid(uid));
});        var uid2guid = function(uid) {
    if (!uid) {
        
        console.log( document.getElementById('uid').value);
        
        console.log("!uid");
        
        return;
    }
    
    var steamId = bigInt(uid);
    
    var parts = [0x42,0x45,0,0,0,0,0,0,0,0];
    
    for (var i = 2; i < 10; i++) {
        var res = steamId.divmod(256);
        steamId = res.quotient; 
        parts[i] = res.remainder.toJSNumber();
    }
    
    var wordArray = CryptoJS.lib.WordArray.create(new Uint8Array(parts));
    var hash = CryptoJS.MD5(wordArray);
    return hash.toString();
};

$(document).ready(function() {
    var uid = $("#uid").val();
    $("#guid").val(uid2guid(uid));
});

}, false)