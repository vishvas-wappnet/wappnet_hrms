
   
<head>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 
<head>
       <input data-id="{{$id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"
        data-toggle="toggle" data-on="Enabled" data-off="InActive" {{$status ? 'checked' :'' }}>
    
<script>

        $(function() { 
           
            $('.toggle-class').change(function() { 
            var status = $(this).prop('checked') == true ? 1 : 0;  
            var id = $(this).data('id');  
            $.ajax({ 
                type: "get", 
                dataType: "json", 
                url: '/status-update', 
                data: 
                {
                    'status': status,
                    'id': id
                }, 
                success: function(data){ 
                console.log(data.success) 
             } 
          }); 
       }) 
    }); 
     </script>

     
                
 