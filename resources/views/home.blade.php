@extends('layouts.app')

@section('content')
<div class="container ">
    
    <div class="col-md-8">
    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ ('multipleusersdelete') }}">Delete All Selected</button>
    <table class=" table table-bordered">
  <thead>
    <tr>
      <th width="50px"><input type="checkbox" id="master"></th> 
      <th scope="col">Sno.</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">password</th>
    </tr>
  </thead>
  <tbody>
            @foreach($users as $data)
             <tr>
             <td><input type="checkbox" class="sub_chk" data-id="{{$data->id}}"></td>
                <td  id="id"> {{$data['id']}} </td>
                 <td> {{$data['name']}} </td>
                 <td> {{$data['email']}} </td>
                 <td> {{$data['password']}} </td>
                 <td><a href="{{ route('homeUpdate',['id'=>$data->id ])}}" class="btn btn-primary">Update</a></td>
                 <td><a href="{{ route('homeDelete',['id'=>$data->id ])}}" class="btn btn-danger">Delete</a></td>
                
            </tr>
          
            @endforeach
        </tbody>          
</table>
        </div>
    </div>
</div>



<script type="text/javascript">  
    $(document).ready(function () {  
  
        $('#master').on('click', function(e) {  
         if($(this).is(':checked',true))    
         {  
            $(".sub_chk").prop('checked', true);    
         } else {    
            $(".sub_chk").prop('checked',false);    
         }    
        });  
  
        $('.delete_all').on('click', function(e) {  
  
            var allVals = [];    
            $(".sub_chk:checked").each(function() {    
                allVals.push($(this).attr('data-id'));  
            });    
  
            if(allVals.length <=0)    
            {    
                alert("Please select row.");    
            }  else {    
  
                var check = confirm("Are you sure you want to delete this row?");    
                if(check == true){    
  
                    var join_selected_values = allVals.join(",");  

                   /*  alert($('meta[name="csrf-token"]').attr('content'));
                    alert(join_selected_values);
                    alert($(this).data('url'));
                    //return false; */

  
                    $.ajax({  
                        url: $(this).data('url'),  
                        
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
                        data: 'ids='+join_selected_values,  
                        success: function (data) {  
                           
                            if (data['success']) {  
                              alert('all delete');
                              $(".sub_chk:checked").each(function() {    
                                    $(this).parents("tr").remove();  
                                });  
                              return false;
                                /* 
                                alert(data['success']);   */
                            } else if (data['error']) {  
                                alert(data['error']);  
                            } else {  
                                alert('Whoops Something went wrong!!');  
                            }  
                        },  
                        error: function (data) {  
                            alert(data.responseText);  
                        }  
                    });  
  
                  $.each(allVals, function( index, value ) {  
                      $('table tr').filter("[data-row-id='" + value + "']").remove();  
                  });  
                }    
            }    
        });  
  
        $('[data-toggle=confirmation]').confirmation({  
            rootSelector: '[data-toggle=confirmation]',  
            onConfirm: function (event, element) {  
                element.trigger('confirm');  
            }  
        });  
  
        $(document).on('confirm', function (e) {  
            var eele = e.target;  
            e.preventDefault();  
  
            $.ajax({  
                url: ele.href,  
                type: 'DELETE',  
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
                success: function (data) {  
                    if (data['success']) {  
                        $("#" + data['tr']).slideUp("slow");  
                        alert(data['success']);  
                    } else if (data['error']) {  
                        alert(data['error']);  
                    } else {  
                        alert('Whoops Something went wrong!!');  
                    }  
                },  
                error: function (data) {  
                    alert(data.responseText);  
                }  
            });  
  
            return false;  
        });  
    });  
</script> 
@endsection