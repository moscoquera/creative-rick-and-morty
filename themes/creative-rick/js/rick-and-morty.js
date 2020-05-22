var card_html="<div class=\"col-md-4 col-sm-6 col-xs-12 character\">\n" +
    "            <p class=\"origin\"></p>\n" +
    "            <img class=\"image\" />\n" +
    "            <h5 class=\"name\"></h5>\n" +
    "            <span class=\"specie\"></span>\n" +
    "        </div>"

var characters_collection=undefined;
var searchTimer, searchDelay = 250;


jQuery(document).ready(function () {
    wp.api.loadPromise.done( function() {
        init();
    } )

});


function init(){
    characters_collection = new wp.api.collections.Ram_character();
    characters_collection.on('add',new_character);
    characters_collection.on('sync',collection_synced);

    jQuery('#search_btn').click(function () {
        loadCharacters();
    });


    jQuery('#search_txt').bind('keydown blur change', function(e) {
        var _this = jQuery(this);
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            loadCharacters();
        }, searchDelay );
    });

    loadCharacters();
}

jQuery(window).on("scroll",EndOfScroll);

function new_character(character) {

    let $element= jQuery(card_html);

    $element.find('.origin').html(character.attributes.meta._ram_origin);
    $element.find('.image').attr('src',character.attributes.meta._ram_image);
    $element.find('.name').html(character.attributes.title.rendered);
    $element.find('.specie').html(character.attributes.meta._ram_species);
    jQuery('.site-main').append($element);
}

function collection_synced() {
    displayLoadingIcon(true)
}

function loadCharacters(more) {

    displayLoadingIcon();
    let filter= jQuery('#search_txt').val();
    if(more){
        try {
            characters_collection.more().then(function () {
                if (!characters_collection.hasMore()) {
                    displayLoadingIcon(true);
                }
            });
        }catch (e) {
            displayLoadingIcon(true);
        }

    }else {
        jQuery('#primary').empty();
        characters_collection.reset();
        let fetch_data = { data: { per_page: 10,orderby:'title',order:'asc' } };
        if(filter.length>0){
            fetch_data.data.search=filter;
        }
        characters_collection.fetch( fetch_data  );
    }

}

function displayLoadingIcon(hide) {
    if(hide==undefined){
        hide=false;
    }

    jQuery('.loading').removeClass('invisible visible');
    if(hide){
        jQuery('.loading').addClass('invisible');
    }else{
        jQuery('.loading').addClass('visible');
    }

}


function EndOfScroll() {
    var scrollHeight = jQuery(document).height();
    var scrollPos = jQuery(window).height() + jQuery(window).scrollTop();
    if(((scrollHeight - 50) >= scrollPos) / scrollHeight == 0){
        var _this = jQuery(this);
        displayLoadingIcon();
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            loadCharacters(true);
        }, searchDelay );
    }
}
