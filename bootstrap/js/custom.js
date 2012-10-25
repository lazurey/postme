 /* attach a submit handler to the form */
  $("#newAddrForm").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
        
    /* get some values from elements on the page: */
    var $form = $( this ),
        addr_tag = $form.find( 'input[name="addr_tag"]' ).val(),
        address = $form.find( '#address' ).val(),
        addr_status = $form.find( 'input[name="addr_status"]' ).val(),
        url = $form.attr( 'action' );
    /* Send the data using post and put the results in a div */
    $.post( url, { addr_tag: addr_tag,
      address: address,
      addr_status: addr_status },
      function() {
          alert(1);
          //document.location = 'my-address.php';
      }
    );
  });