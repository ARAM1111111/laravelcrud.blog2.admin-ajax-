<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="style.css"> -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
	
</style>
	<title>AJAX CRUD</title>
</head>
<body>
	<div class="container">
      @yield('content')
    </div>
		
<script>
  $(document).on('click', '.edit-modal', function(event) {
        $('#footer_action_button').text('Update').addClass('glyphicon-check').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success').removeClass('btn-danger').addClass('edit');
        $('.modal-title').text('EDIT');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#t').val($(this).data('title'));
        $('#d').val($(this).data('description'));
        $('#myModal').modal('show');
      });

      $('.modal-footer').on('click', '.edit', function(event) {
        $.ajax({
          type:'POST',
          url:'/editItem',
          data:{
                    '_token':$('input[name=_token]').val(),
                    'id':$('#fid').val(),
                    'title':$('#t').val(),
                    'description':$('#d').val()
              },
          success:function(data) {
            $('.item'+ data.id).replaceWith("<tr class='item'"+data.id+"><td>"+data.id+"</td></td>"+data.title+"</td><td>"+data.desc+"</td><button class='edit-modal btn btn-info' data-id="+data.id+"data-title="+data.title+"data-description"+data.desc+"><span class='glyphicon glyphicon-edit'></span>EDIT</button><button class='delete-modal btn btn-danger' data-id="+data.id+"data-title="+data.title+"data-description="+data.desc+"><span class='glyphicon glyphicon-trash'></span>DELETE</button></td></tr>");

              location.reload();
          }
        });
      });

      // ============== ADD =============================

      $('#add').click(function(){
          $.ajax({
          type:'POST',
          url:'/addItem',
          data:{
                    '_token':$('input[name=_token]').val(),
                    
                    'title':$('input[name=title]').val(),
                    'description':$('input[name=description]').val(),
              },
          success:function(data) {
              if((data.errors)){
                $('.error').removeClass('hidden').text(data.errors.title).text(data.errors.description);
              }
              else{
                $('.error').remove();
                $('#table').append('.item'+ data.id).replaceWith("<tr class='item'"+data.id+"><td>"+data.id+"</td></td>"+data.title+"</td><td>"+data.desc+"</td><button class='edit-modal btn btn-info' data-id="+data.id+"data-title="+data.title+"data-description"+data.desc+"><span class='glyphicon glyphicon-edit'></span>EDIT</button><button class='delete-modal btn btn-danger' data-id="+data.id+"data-title="+data.title+"data-description="+data.desc+"><span class='glyphicon glyphicon-trash'></span>DELETE</button></td></tr>");
              }

              location.reload();
          }
        });
          $('#title').val('');
          $('#description').val('');


      });

      // ====================== DELETE ========================

      $(document).on('click', '.delete-modal', function(event) {
        $('#footer_action_button').text('DELETE').removeClass('glyphicon-check').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success').addClass('btn-danger').addClass('delete');
        $('.modal-title').text('DELETE');
        $('.id').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.title').val($(this).data('title'));
        $('#myModal').modal('show');
      });
      $('.modal-footer').on('click', '.delete', function(event) {
        $.ajax({
          type:'POST',
          url:'/delItem',
          data:{
                    '_token':$('input[name=_token]').val(),
                    'id':$('.id').text(),
                    
              },
          success:function(data) {
            $('.item'+ $('.id').text()).remove();

              location.reload();
          }
        });
      });
</script>
</body>
</html>