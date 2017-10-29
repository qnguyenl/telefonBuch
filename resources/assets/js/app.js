
var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

var currentSelection = 0;

// Register keydown events on the whole document
$(document).keydown(function(e) {
    switch(e.keyCode) {
        case 38:
            navigate('up');
            break;
        case 40:
            navigate('down');
            break;
        case 13:
            setSelected(currentSelection);
            $(".selectable:visible").hide();
            break;
    }
});


for(var i = 0; i < $(".selectable:visible ul li").size(); i++) {
    $(".selectable:visible ul li").eq(i).data("number", i);
}

// Simulate the "hover" effect with the mouse
$(".selectable:visible ul li").hover(
    function () {
        currentSelection = $(this).data("number");
        setSelected(currentSelection);
    }, function() {
        $(".selectable:visible ul li").removeClass("selected");
    }
);


function navigate(direction) {

    // Check if any of the menu items is selected
    if($(".selectable:visible ul li.selected").size() == 0) {
        currentSelection = -1;
        console.log('t');
    }

    if(direction == 'up' && currentSelection != -1) {
        if(currentSelection != 0) {
            currentSelection--;
        }
    } else if (direction == 'down') {
        if(currentSelection !== $(".selectable:visible ul li").size() -1) {
            currentSelection++;
        }
    }

    setSelected(currentSelection);
}

function setSelected(menuitem) {
    var selectedValue = $(".selectable:visible ul li").eq(menuitem).html();
    $(".selectable:visible ul li").removeClass("selected");
    $(".selectable:visible ul li").eq(menuitem).addClass("selected");
    $(".selectable:visible ul li.selected").get(0).scrollIntoView();
    $(".selectable:visible").prev("input").val(selectedValue);
}

$(document).click(function(){
    $(".selectable:visible").hide();
});

$(document).keydown(function(e){

    if (e.keyCode == 40) {
        $("input").blur();
        return false;
    }

    //hide search results on ESC
    if (e.keyCode == 27) {
        $(".selectable:visible").hide();
        $("input").blur();
        return false;
    }

    //focus on search field on back arrow or backspace press
    if (e.keyCode == 37 || e.keyCode == 8) {
        $(".selectable:visible").focus();
    }

});

$(document).ready(function(){
    $("input[type=text]").bind('keyup click', function() {
        var me = this;
        delay(function(){
            var keyword = $(me).val(),
                name = $(me).attr('name');
            if(keyword) {
                console.log($(me).next());
                $.get("suggestor/"+name+"/"+keyword,function(result){
                    var data = JSON.parse(result).suggestions;
                    console.log(result);
                    $(me).next('.selectable').children('ul').empty();
                    if(data.length){
                        data.forEach(function (item) {
                            var value = item.kw ? item.kw : item.name;
                            $(me).next('.selectable').children('ul').append(`<li class="list-group-item">${value}</li>`);
                        });
                        $(me).next('.selectable').show();
                        $(".selectable:visible ul li").bind('click',function(){
                            $(".selectable:visible").prev("input").val($(this).html());
                            $(".selectable:visible").hide();
                        })
                    }else{
                        $(me).next('.selectable').hide();
                    }
                })
            }else{
                $(".selectable:visible").hide();
            }
        },300);
    });
});

