(function($) {


    $(document).ready(function(){

        // Custom method to validate username
        $.validator.addMethod("alphanumeric", function(value, element) {
            console.log('method("alphanumeric"');
            return this.optional(element) || /^[ ,()+\.-a-zA-Z0-9äüöÄÜÖß]*$/i.test(value);
        }, "Bitte nur Buchstaben und Leerzeichen verwenden.");


        $.validator.methods.range = function( value, element, param ) {
            //value = parseInt(value);
            value = value.replace(/[($)\s\._\-]+/g, '');
			return this.optional( element ) || ( value >= param[ 0 ] && value <= param[ 1 ] );
        },



        // enumerate panels
        //
        numPanels = $(".multisteps-form__panel").length;
        progressContainer = $(".multisteps-form__progress");
        
        $(".multisteps-form__panel").each( function( index ) {

            idx = index + 1;
            if( idx == $(".multisteps-form__panel").length ) {
                // Last Element
                $(this).attr('id', 'thanks_panel');
            }
            else {
                // next element
                $(this).attr('id', 'panel-' +idx);
            }

            // add prev / next buttons
            //
            buttonrow = $(this).find('div.button-row');
            if( idx !== 1 ) {
                // 
                $prevbutton = '<button class="btn btn-primary js-btn-prev prev" type="button" title="Back">Back</button>';
                buttonrow.prepend($prevbutton);
            }
            if( idx !== numPanels-1 ) {
                // 
                const label = idx == 1 ? "Sounds good Let's go !" : "Next";

                $nextbutton = '<button class="btn btn-primary ml-auto js-btn-next next" type="button" title="Next">'+label+'</button>';
                buttonrow.append($nextbutton);
            }


            // add submit button
            //
            if( idx == numPanels-1 ) {
                // 
                $submitbutton = '<input class="btn btn-primary ml-auto" type="submit" value="Send request">';
                buttonrow.append($submitbutton);
            }

            // add progress steps for numPanels-1 panels
            //
            if( idx <= numPanels-1 ) {
                progressStep = '<button class="step'+idx+' multisteps-form__progress-btn" type="button" title=""></button>';
                progressContainer.append(progressStep);
            }
        });

        $('button.step1').addClass('js-active');

        // find radio buttons and bind next panel action on click
        //
        $(".multisteps-form__panel").each( function( index ) {
            
            var panel= $(this);
            var inputs = panel.find("input[type=radio]");
            
            if(inputs.length>0){
                inputs.each( function( index ) {
                    $(this).bind({
                        click: function() {
                          // Do something on click
                          setTimeout(function () {
                            panel.find('.next').trigger( "click" );
                         }, 600);
                        }
                      });

                });
            }
        });



        // form steps navigation
        //
        $(".next").click(function(){
            
            var form = $("#myform");
            form.validate({

                rules: {
                    /*
                    ebit1: {
                        required: true,
                        range:[50000,10000000]
                    },
                    ebit2: {
                        required: true,
                        range:[50000,10000000]
                    },
                    */
                    username: {
                        required: true,
                        alphanumeric: true
                    },
                    goal: {
                        required: true,
                        alphanumeric: true
                    },
                    obstacles: {
                        required: true,
                        alphanumeric: true
                    },
                    projecttype: {
                        required: true,
                    },
                    budget: {
                        required: true,
                    },
                    obstacle: {
                        required: true,
                        alphanumeric: true
                    },
                    phone: {
                        required: true,
                        alphanumeric: true
                    },
                },

                errorElement: 'span',
                errorClass: 'help-block',
                
                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-row').addClass("has-error");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-row').removeClass("has-error");
                },

                errorPlacement: function(error, element) {

                    if( element.attr("name") == 'datenschutz') {
                        error.appendTo( $(".custom-checkbox") );
                    }
                    else if( element.attr("name") == 'budget') {
                        error.appendTo( $(".budget") );
                    }
                    else if( element.attr("name") == 'projecttype') {
                        error.appendTo( $(".projecttype") );
                    }
                    else{
                        error.insertAfter(element);
                    }
                },

                submitHandler: function(a, e) {
                    //a is form object and e is event
                    e.preventDefault(); // avoid submitting the form here

                    // custom sanitization
                    //
                    /*
                    var ebit1 = $('#ebit1').val();
                    var ebit2 = $('#ebit2').val();
                    $('#ebit1').val( ebit1.replace(/[($)\s\._\-]+/g, '') );
                    $('#ebit2').val( ebit2.replace(/[($)\s\._\-]+/g, '') );
                    */

                    submitAjaxForm();
                },


                messages: {

                    username: {
                        required: "Enter your name"
                    },
                    goal: {
                        required: "Describe your goal",
                    },
                    email: {
                        required: "Enter your email address",
                    },
                    datenschutz: {
                        required: "This field is required",
                    },
                    projecttype: {
                        required: "Please make a choice",
                    },
                    budget: {
                        required: "Please make a choice",
                    },
                    obstacle: {
                        required: "What is you biggest obstacle ?",
                    },
                    phone: {
                        required: "Enter your phone number",
                    }
                }
            });
            
            if (form.valid() === true) {

                $( ".multisteps-form__panel" ).each(function( index ) {
                    if( $( this ).is(":visible") ) {
                        current_fs = $( this );
                        next_idx = index+1 + 1;
                    }
                });

                $('button.step'+next_idx).addClass('js-active');
                changeSteps(current_fs, next_idx);
            }
        });

        $('.prev').click(function() {

            $( ".multisteps-form__panel" ).each(function( index ) {
                if( $( this ).is(":visible") ) {
                    current_fs = $( this );
                    next_idx = index+1 - 1;
                }
            });

            $('button.step'+(next_idx+1)).removeClass('js-active');
            changeSteps(current_fs, next_idx);
        });

        
        
        function changeSteps(current_fs, next_idx){

            current_fs.animate({opacity: 0}, 400,function(){
                current_fs.css('display','none');
                next_fs = $( '#panel-' + next_idx );
                next_fs.css('display','block');
                next_fs.animate({opacity: 1}, 500);
                next_fs.find('input[type=text], input[type=email], textarea').focus();
                });
            
            // todo, only set when neccessary
            $('span.the_username').html($("input[name=username]").val());
            
        }



        jQuery.extend(jQuery.validator.messages, {
            range: "Range must lie between 50.000 and 10.000.000."
        });



     

    });


  
            

    //*******************************************************************************************************************/
    //                                                                                                                  */
    //                                                                                                                  */
    //                                                                                                                  */
    //                                      ajax request                                                                */
    //                                                                                                                  */
    //                                                                                                                  */
    //                                                                                                                  */
    //*******************************************************************************************************************/

    function submitAjaxForm(){
                    
        var form = $("#myform");

        var action = form.attr("action"),
                method = form.attr("method"),
                data = form.serialize();
                
                //console.log(data);
                $('#thanks_panel').prev().hide();
                $('#thanks_panel').css('display', 'block').css('opacity', 1);

        $.ajax({
            url: action,
            type: method,
            data: data
                }).done(function (data) {
                    
                    // Hide last panel + show thank you message
                    //
                    $('#thanks_panel').prev().hide();
                    $('#thanks_panel').css('display', 'flex');

                    //console.log(data);


                }).fail(function (e) {
                    
                    //console.log(data);
                    //console.log('ajax req fail');
                    //console.log(e);
                    
                }).always(function () {
            
            });
    }


})( jQuery );




jQuery(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });


    //*******************************************************************************************************************/
    //                                                                                                                  */
    //                                                                                                                  */
    //                                                                                                                  */
    //                                      numeric form fields                                                         */
    //                                                                                                                  */
    //                                                                                                                  */
    //                                                                                                                  */
    //*******************************************************************************************************************/
(function($, undefined) {

    "use strict";

    // When ready.
    $(function() {

        //min="50000" max="10000000"
        
        var $input = $( "input.ebitfield" );

        $input.on( "keyup", function( event ) {

            // When user select text in the document, also abort.
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
                return;
            }
            
            // When the arrow keys are pressed, abort.
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                return;
            }
            
            
            var $this = $( this );
            
            // Get the value.
            var input = $this.val();
            
            input = input.replace(/[\D\s\._\-]+/g, "");

            input = input ? parseInt( input, 10 ) : 0;

            $this.val( function() {
                return ( input === 0 ) ? "" : input.toLocaleString( "de-DE" );
            } );
            
        } );
        

        
    });
})(jQuery);