if ( typeof Object.create !== 'function' ) {
    Object.create = function ( obj ) {
        function F () {};
        F.prototype = obj;
        return new F();
    }
}

var getUrlParameter = function getUrlParameter ( sParam ) {
    var sPageURL = decodeURIComponent( window.location.search.substring( 1 ) ),
        sURLVariables = sPageURL.split( '&' ),
        sParameterName,
        i;

    for ( i = 0; i < sURLVariables.length; i++ ) {
        sParameterName = sURLVariables[ i ].split( '=' );

        if ( sParameterName[ 0 ] === sParam ) {
            return sParameterName[ 1 ] === undefined ? true : sParameterName[ 1 ];
        }
    }
};


(function ( $ ) {

    var order = {
        init: function ( opt, elm ) {

            var self = this;
            self.elm = elm;
            self.$elm = $( elm );
            self.thead = $( elm ).find( 'thead' );
            self.options = $.extend( {}, $.fn.setTableOrder.defaults, opt );

            self.onLoadAction();
            self.thead.on( 'click', $.proxy( self.sort, self ) );

            if(this.options.autoSubmit){
                $( 'select, input[type=text]' ).change( function () {
                    $( '#filters' ).submit();
                } );
            }
        },


        sort: function ( e ) {
            var $this = $( e.target );

            if ( typeof $this.data( 'table' ) === 'undefined' ) {
                return false;
            }
            $( this ).siblings().addClass( 'sorting' ).removeClass( 'sorting_desc sorting_asc' );
            var input_table = $( 'input[name=table]' );
            var input_order = $( 'input[name=order]' );

            (!$this.hasClass( 'sorting' ))
                ? $this.toggleClass( 'sorting_desc sorting_asc' )
                : $this.toggleClass( 'sorting sorting_asc' );

            $this.data( 'order', $this.data( 'order' ) == 'asc' ? 'desc' : 'asc' );


            input_order.val( $this.data( 'order' ) );
            input_table.val( $this.data( 'table' ) );
            if(this.options.autoSubmit){
                $( this.options.form ).submit();
            }

        },
        onLoadAction: function () {

            var tableName = getUrlParameter( 'table' );
            var orderBy = getUrlParameter( 'order' );
            if ( typeof tableName === 'undefined' ) {
                return false;
            }

            $("th[data-table='" + tableName + "']").attr('data-order', orderBy).removeClass('sorting').addClass('sorting_' +orderBy);

        },


    }

    $.fn.setTableOrder = function ( options ) {
        return this.each( function () {
            var calInst = Object.create( order );
            calInst.init( options, this )
        } );
    };

// Plugin defaults – added as a property on our plugin function.
    $.fn.setTableOrder.defaults = {
        form: 'form',
        autoSubmit: true
    };


    var tech = getUrlParameter( 'technology' );
    var blog = getUrlParameter( 'blog' );


})( jQuery );


var spinner = $('.spinnerLoader');


(function ( $ ) {

    var initAjax = {
        init: function ( opt, elm ) {

            var self = this;
            self.elm = elm;
            self.$elm = $( elm );
            self.thead = self.$elm.find( 'thead' );
            self.tbody =  self.$elm.find( 'tbody' );
            self.inputLimit = self.$elm.find('#filter-limit-select');
            self.options = $.extend( {}, $.fn.ajaxTable.defaults, opt );
            self.tableName = self.$elm.find('#filter-tableName-input');
            self.order = self.$elm.find('#filter-tableOrder-input');
            self.spinner = spinner.clone().appendTo(self.$elm.closest(self.options.spinnerWrapper)).hide();


            self.thead.on( 'click', $.proxy( self.sort, self ) );
            self.inputLimit.on( 'change', $.proxy( self.load, self ) );
            self.$elm.find('#filter-table-button').click(function (e) {
                e.preventDefault();
                $.proxy( self.load(), self );
            });
        },


        sort: function ( e ) {
            var $this = $( e.target );

            if ( typeof $this.data( 'table' ) === 'undefined' ) {
                return false;
            }


            $this.siblings().addClass( 'sorting' ).removeClass( 'sorting_desc sorting_asc' );

            (!$this.hasClass( 'sorting' ))
                ? $this.toggleClass( 'sorting_desc sorting_asc' )
                : $this.toggleClass( 'sorting sorting_asc' );

            $this.data( 'order', $this.data( 'order' ) == 'asc' ? 'desc' : 'asc' );


            this.order.val( $this.data( 'order' ) );
            this.tableName.val( $this.data( 'table' ) );


            $.proxy( this.load(), this );

        },
        load: function () {
            var tbody = this.tbody;
            var data = this.$elm.find('#filter-tableOrder-input,#filter-tableName-input,#filter-limit-select,#filter-table-searchInput').serialize()

            var $spinner = this.spinner;

            $.ajax({
                url: this.options.url,
                data: data,
                dataType:'html',
                type:'post',
                beforeSend: function(){
                    $spinner.css('display', 'flex')
                },
                complete: function(){
                    $spinner.hide();
                },
                success:function (data) {
                    tbody.html(data);
                }
            })
        },

    }

    $.fn.ajaxTable = function ( options ) {
        return this.each( function () {
            var calInst = Object.create( initAjax );
            calInst.init( options, this )
        } );
    };

// Plugin defaults – added as a property on our plugin function.
    $.fn.ajaxTable.defaults = {
        url: false,
        spinnerWrapper: '.card'
    };

})( jQuery );

function getRegions(url,val,selectedRegion) {

        spinner.css('display', 'flex');
        if (selectedRegion === undefined) {
            selectedRegion = '';
        }
        var select = $('select[name=region_id]').attr('disabled', true);

        $.ajax({
            url: url,
            type: 'POST',
            data: {'id': val}
        }).success(function (data) {
            select.attr('disabled', false).find('option')
                .remove()
                .end()
                .append(render_regions(data, selectedRegion));
            spinner.hide();

        });
}

function deleteRow(route) {
    var elm = $( '.delete-row' );
    if(!elm.length) return;
    var id = null;
    var $this = null;


    elm.click( function () {
        $this = $( this );
        id = $this.data( 'id' );

        openModal('#delete-confirm-modal');
    } );
    $('#yes-delete').click( function () {
        jQuery.ajax( {
            url: route + '/' + id,
            type: 'DELETE',
        } ).success( function ( data ) {
            if(data == 'true'){
                $this.closest( 'tr' ).fadeOut( 'slow' );
                closeModal('#delete-confirm-modal');
            }else {
                $('.modal-body').html('<p class="alert alert-danger">Unable to delete.</p>');
            }
        } );

    });
}


function render_regions(arr, selectedRegion) {
    var strOptions, selected;
    strOptions = "<option value='0'>All</option>";
    if (arr.length < 1) {
        return strOptions;
    }

    $.each(arr, function (i, returnedData) {

        (arr[i]['id'] === selectedRegion) ? selected = 'selected' : selected = false;
        strOptions += '<option ' + selected + ' value="' + arr[i]['id'] + '">' + arr[i]['state_region'] + '</option>';
    });


    return strOptions;
}

function renderAttribute(name, pipeValue, selectedValue) {
    var strOptions, selected;
    strOptions = "<option value='all'>All "+pluralize(name)+"</option>";
    var arr = pipeValue.split('|');

    $.each(arr, function (i, returnedData) {
        (returnedData === selectedValue) ? selected = 'selected' : selected = null;
        strOptions += '<option ' + selected + ' value="' + returnedData + '">' + returnedData + '</option>';
    });


    return strOptions;
}
function deleteVariantAttributes($arr){
    $.each($arr,function (i, val) {
        $('[data-attribute-index="' + val + '"]').remove();
    });
}
function addAttributeSelect(name, pipeValue, attributeIndex, inputIndex) {
    var strOptions;

    strOptions = '<select class="form-control static" data-attribute-index="'+ attributeIndex +'"  name="variations['+ inputIndex +'][_name]['+name+']">'
    strOptions += "<option value='all'>All "+pluralize(name)+"</option>";

    var arr = pipeValue.split('|');
    $.each(arr, function (i, returnedData) {
        strOptions += '<option value="' + returnedData + '">' + returnedData + '</option>';
    });

    strOptions += '</select>';

    return strOptions;
}

function getCities(url,val,selectedCity) {
    if (selectedCity === undefined) {
        selectedCity = '';
    }
    if (val == '0' || val == '') {
        $('select[name=city_id]').find('option')
            .remove()
            .end()
            .append('<option value="0">All</option>');

        return;
    }
    spinner.css('display', 'flex');

    $.ajax({
        url: url,
        type: 'POST',
        data: {'id': val}
    }).success(function (data) {
        $('select[name=city_id]').find('option')
            .remove()
            .end()
            .append(render_cities(data, selectedCity));
        spinner.hide();

    });
}
function render_cities(arr, city_id) {
    var strOptions, selected;
    strOptions = "<option value='0'>All</option>";
    if (arr.length < 1) {
        return strOptions;
    }

    $.each(arr, function (i, returnedData) {

        (arr[i]['id'] === city_id) ? selected = 'selected' : selected = false;
        strOptions += '<option ' + selected + ' value="' + arr[i]['id'] + '">' + arr[i]['city_name'] + '</option>';
    });

    return strOptions;
}
$('[data-toggle="collapse"]').each(function () {
    var checkbox = $(this).find('input[type=checkbox]');

    if(checkbox.length){
        if(checkbox.is(':checked')){
            console.log("checkbox checked");
            $($(this).data('target')).collapse("show");
        }
    }
});


// displaying modal
function openModal(modalName){
    jQuery(modalName).modal(
        {
            backdrop: 'static',
            keyboard: true,
            show: true
        }
    );
}

// closing modal
function closeModal( modalName ){
    $(function () {
        $(modalName).modal('toggle');
    });
}

if(typeof tinymce !== 'undefined'){
    tinymce.init({
        selector: 'textarea.tinymce',
        a_plugin_option: true,
        a_configuration_option: 400,
        theme: 'modern',
        plugins: [
            'advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor'
        ],
        browser_spellcheck: true,

        toolbar_items_size: 'small',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });
}


(function (root, pluralize) {
    /* istanbul ignore else */
    if (typeof require === 'function' && typeof exports === 'object' && typeof module === 'object') {
        // Node.
        module.exports = pluralize();
    } else if (typeof define === 'function' && define.amd) {
        // AMD, registers as an anonymous module.
        define(function () {
            return pluralize();
        });
    } else {
        // Browser global.
        root.pluralize = pluralize();
    }
})(this, function () {
    // Rule storage - pluralize and singularize need to be run sequentially,
    // while other rules can be optimized using an object for instant lookups.
    var pluralRules = [];
    var singularRules = [];
    var uncountables = {};
    var irregularPlurals = {};
    var irregularSingles = {};

    /**
     * Title case a string.
     *
     * @param  {string} str
     * @return {string}
     */
    function toTitleCase (str) {
        return str.charAt(0).toUpperCase() + str.substr(1).toLowerCase();
    }

    /**
     * Sanitize a pluralization rule to a usable regular expression.
     *
     * @param  {(RegExp|string)} rule
     * @return {RegExp}
     */
    function sanitizeRule (rule) {
        if (typeof rule === 'string') {
            return new RegExp('^' + rule + '$', 'i');
        }

        return rule;
    }

    /**
     * Pass in a word token to produce a function that can replicate the case on
     * another word.
     *
     * @param  {string}   word
     * @param  {string}   token
     * @return {Function}
     */
    function restoreCase (word, token) {
        // Tokens are an exact match.
        if (word === token) {
            return token;
        }

        // Upper cased words. E.g. "HELLO".
        if (word === word.toUpperCase()) {
            return token.toUpperCase();
        }

        // Title cased words. E.g. "Title".
        if (word[0] === word[0].toUpperCase()) {
            return toTitleCase(token);
        }

        // Lower cased words. E.g. "test".
        return token.toLowerCase();
    }

    /**
     * Interpolate a regexp string.
     *
     * @param  {string} str
     * @param  {Array}  args
     * @return {string}
     */
    function interpolate (str, args) {
        return str.replace(/\$(\d{1,2})/g, function (match, index) {
            return args[index] || '';
        });
    }

    /**
     * Sanitize a word by passing in the word and sanitization rules.
     *
     * @param  {string}   token
     * @param  {string}   word
     * @param  {Array}    collection
     * @return {string}
     */
    function sanitizeWord (token, word, collection) {
        // Empty string or doesn't need fixing.
        if (!token.length || uncountables.hasOwnProperty(token)) {
            return word;
        }

        var len = collection.length;

        // Iterate over the sanitization rules and use the first one to match.
        while (len--) {
            var rule = collection[len];

            // If the rule passes, return the replacement.
            if (rule[0].test(word)) {
                return word.replace(rule[0], function (match, index, word) {
                    var result = interpolate(rule[1], arguments);

                    if (match === '') {
                        return restoreCase(word[index - 1], result);
                    }

                    return restoreCase(match, result);
                });
            }
        }

        return word;
    }

    /**
     * Replace a word with the updated word.
     *
     * @param  {Object}   replaceMap
     * @param  {Object}   keepMap
     * @param  {Array}    rules
     * @return {Function}
     */
    function replaceWord (replaceMap, keepMap, rules) {
        return function (word) {
            // Get the correct token and case restoration functions.
            var token = word.toLowerCase();

            // Check against the keep object map.
            if (keepMap.hasOwnProperty(token)) {
                return restoreCase(word, token);
            }

            // Check against the replacement map for a direct word replacement.
            if (replaceMap.hasOwnProperty(token)) {
                return restoreCase(word, replaceMap[token]);
            }

            // Run all the rules against the word.
            return sanitizeWord(token, word, rules);
        };
    }

    /**
     * Pluralize or singularize a word based on the passed in count.
     *
     * @param  {string}  word
     * @param  {number}  count
     * @param  {boolean} inclusive
     * @return {string}
     */
    function pluralize (word, count, inclusive) {
        var pluralized = count === 1
            ? pluralize.singular(word) : pluralize.plural(word);

        return (inclusive ? count + ' ' : '') + pluralized;
    }

    /**
     * Pluralize a word.
     *
     * @type {Function}
     */
    pluralize.plural = replaceWord(
        irregularSingles, irregularPlurals, pluralRules
    );

    /**
     * Singularize a word.
     *
     * @type {Function}
     */
    pluralize.singular = replaceWord(
        irregularPlurals, irregularSingles, singularRules
    );

    /**
     * Add a pluralization rule to the collection.
     *
     * @param {(string|RegExp)} rule
     * @param {string}          replacement
     */
    pluralize.addPluralRule = function (rule, replacement) {
        pluralRules.push([sanitizeRule(rule), replacement]);
    };

    /**
     * Add a singularization rule to the collection.
     *
     * @param {(string|RegExp)} rule
     * @param {string}          replacement
     */
    pluralize.addSingularRule = function (rule, replacement) {
        singularRules.push([sanitizeRule(rule), replacement]);
    };

    /**
     * Add an uncountable word rule.
     *
     * @param {(string|RegExp)} word
     */
    pluralize.addUncountableRule = function (word) {
        if (typeof word === 'string') {
            uncountables[word.toLowerCase()] = true;
            return;
        }

        // Set singular and plural references for the word.
        pluralize.addPluralRule(word, '$0');
        pluralize.addSingularRule(word, '$0');
    };

    /**
     * Add an irregular word definition.
     *
     * @param {string} single
     * @param {string} plural
     */
    pluralize.addIrregularRule = function (single, plural) {
        plural = plural.toLowerCase();
        single = single.toLowerCase();

        irregularSingles[single] = plural;
        irregularPlurals[plural] = single;
    };

    /**
     * Irregular rules.
     */
    [
        // Pronouns.
        ['I', 'we'],
        ['me', 'us'],
        ['he', 'they'],
        ['she', 'they'],
        ['them', 'them'],
        ['myself', 'ourselves'],
        ['yourself', 'yourselves'],
        ['itself', 'themselves'],
        ['herself', 'themselves'],
        ['himself', 'themselves'],
        ['themself', 'themselves'],
        ['is', 'are'],
        ['was', 'were'],
        ['has', 'have'],
        ['this', 'these'],
        ['that', 'those'],
        // Words ending in with a consonant and `o`.
        ['echo', 'echoes'],
        ['dingo', 'dingoes'],
        ['volcano', 'volcanoes'],
        ['tornado', 'tornadoes'],
        ['torpedo', 'torpedoes'],
        // Ends with `us`.
        ['genus', 'genera'],
        ['viscus', 'viscera'],
        // Ends with `ma`.
        ['stigma', 'stigmata'],
        ['stoma', 'stomata'],
        ['dogma', 'dogmata'],
        ['lemma', 'lemmata'],
        ['schema', 'schemata'],
        ['anathema', 'anathemata'],
        // Other irregular rules.
        ['ox', 'oxen'],
        ['axe', 'axes'],
        ['die', 'dice'],
        ['yes', 'yeses'],
        ['foot', 'feet'],
        ['eave', 'eaves'],
        ['goose', 'geese'],
        ['tooth', 'teeth'],
        ['quiz', 'quizzes'],
        ['human', 'humans'],
        ['proof', 'proofs'],
        ['carve', 'carves'],
        ['valve', 'valves'],
        ['looey', 'looies'],
        ['thief', 'thieves'],
        ['groove', 'grooves'],
        ['pickaxe', 'pickaxes'],
        ['whiskey', 'whiskies']
    ].forEach(function (rule) {
        return pluralize.addIrregularRule(rule[0], rule[1]);
    });

    /**
     * Pluralization rules.
     */
    [
        [/s?$/i, 's'],
        [/([^aeiou]ese)$/i, '$1'],
        [/(ax|test)is$/i, '$1es'],
        [/(alias|[^aou]us|tlas|gas|ris)$/i, '$1es'],
        [/(e[mn]u)s?$/i, '$1s'],
        [/([^l]ias|[aeiou]las|[emjzr]as|[iu]am)$/i, '$1'],
        [/(alumn|syllab|octop|vir|radi|nucle|fung|cact|stimul|termin|bacill|foc|uter|loc|strat)(?:us|i)$/i, '$1i'],
        [/(alumn|alg|vertebr)(?:a|ae)$/i, '$1ae'],
        [/(seraph|cherub)(?:im)?$/i, '$1im'],
        [/(her|at|gr)o$/i, '$1oes'],
        [/(agend|addend|millenni|dat|extrem|bacteri|desiderat|strat|candelabr|errat|ov|symposi|curricul|automat|quor)(?:a|um)$/i, '$1a'],
        [/(apheli|hyperbat|periheli|asyndet|noumen|phenomen|criteri|organ|prolegomen|hedr|automat)(?:a|on)$/i, '$1a'],
        [/sis$/i, 'ses'],
        [/(?:(kni|wi|li)fe|(ar|l|ea|eo|oa|hoo)f)$/i, '$1$2ves'],
        [/([^aeiouy]|qu)y$/i, '$1ies'],
        [/([^ch][ieo][ln])ey$/i, '$1ies'],
        [/(x|ch|ss|sh|zz)$/i, '$1es'],
        [/(matr|cod|mur|sil|vert|ind|append)(?:ix|ex)$/i, '$1ices'],
        [/(m|l)(?:ice|ouse)$/i, '$1ice'],
        [/(pe)(?:rson|ople)$/i, '$1ople'],
        [/(child)(?:ren)?$/i, '$1ren'],
        [/eaux$/i, '$0'],
        [/m[ae]n$/i, 'men'],
        ['thou', 'you']
    ].forEach(function (rule) {
        return pluralize.addPluralRule(rule[0], rule[1]);
    });

    /**
     * Singularization rules.
     */
    [
        [/s$/i, ''],
        [/(ss)$/i, '$1'],
        [/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)(?:sis|ses)$/i, '$1sis'],
        [/(^analy)(?:sis|ses)$/i, '$1sis'],
        [/(wi|kni|(?:after|half|high|low|mid|non|night|[^\w]|^)li)ves$/i, '$1fe'],
        [/(ar|(?:wo|[ae])l|[eo][ao])ves$/i, '$1f'],
        [/ies$/i, 'y'],
        [/\b([pl]|zomb|(?:neck|cross)?t|coll|faer|food|gen|goon|group|lass|talk|goal|cut)ies$/i, '$1ie'],
        [/\b(mon|smil)ies$/i, '$1ey'],
        [/(m|l)ice$/i, '$1ouse'],
        [/(seraph|cherub)im$/i, '$1'],
        [/(x|ch|ss|sh|zz|tto|go|cho|alias|[^aou]us|tlas|gas|(?:her|at|gr)o|ris)(?:es)?$/i, '$1'],
        [/(e[mn]u)s?$/i, '$1'],
        [/(movie|twelve)s$/i, '$1'],
        [/(cris|test|diagnos)(?:is|es)$/i, '$1is'],
        [/(alumn|syllab|octop|vir|radi|nucle|fung|cact|stimul|termin|bacill|foc|uter|loc|strat)(?:us|i)$/i, '$1us'],
        [/(agend|addend|millenni|dat|extrem|bacteri|desiderat|strat|candelabr|errat|ov|symposi|curricul|quor)a$/i, '$1um'],
        [/(apheli|hyperbat|periheli|asyndet|noumen|phenomen|criteri|organ|prolegomen|hedr|automat)a$/i, '$1on'],
        [/(alumn|alg|vertebr)ae$/i, '$1a'],
        [/(cod|mur|sil|vert|ind)ices$/i, '$1ex'],
        [/(matr|append)ices$/i, '$1ix'],
        [/(pe)(rson|ople)$/i, '$1rson'],
        [/(child)ren$/i, '$1'],
        [/(eau)x?$/i, '$1'],
        [/men$/i, 'man']
    ].forEach(function (rule) {
        return pluralize.addSingularRule(rule[0], rule[1]);
    });

    /**
     * Uncountable rules.
     */
    [
        // Singular words with no plurals.
        'advice',
        'adulthood',
        'agenda',
        'aid',
        'alcohol',
        'ammo',
        'athletics',
        'bison',
        'blood',
        'bream',
        'buffalo',
        'butter',
        'carp',
        'cash',
        'chassis',
        'chess',
        'clothing',
        'commerce',
        'cod',
        'cooperation',
        'corps',
        'digestion',
        'debris',
        'diabetes',
        'energy',
        'equipment',
        'elk',
        'excretion',
        'expertise',
        'flounder',
        'fun',
        'gallows',
        'garbage',
        'graffiti',
        'headquarters',
        'health',
        'herpes',
        'highjinks',
        'homework',
        'housework',
        'information',
        'jeans',
        'justice',
        'kudos',
        'labour',
        'literature',
        'machinery',
        'mackerel',
        'mail',
        'media',
        'mews',
        'moose',
        'music',
        'news',
        'pike',
        'plankton',
        'pliers',
        'pollution',
        'premises',
        'rain',
        'research',
        'rice',
        'salmon',
        'scissors',
        'series',
        'sewage',
        'shambles',
        'shrimp',
        'species',
        'staff',
        'swine',
        'trout',
        'traffic',
        'transporation',
        'tuna',
        'wealth',
        'welfare',
        'whiting',
        'wildebeest',
        'wildlife',
        'you',
        // Regexes.
        /pox$/i, // "chickpox", "smallpox"
        /ois$/i,
        /deer$/i, // "deer", "reindeer"
        /fish$/i, // "fish", "blowfish", "angelfish"
        /sheep$/i,
        /measles$/i,
        /[^aeiou]ese$/i // "chinese", "japanese"
    ].forEach(pluralize.addUncountableRule);

    return pluralize;
});
