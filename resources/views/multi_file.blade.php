<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style type="text/css">

        .tithead{
            font-size: 40px;
            color: purple;
        }
        .title{
            font-size: 230%;
            line-height: 1.25em;
            padding-bottom: 26px;
        }

        .summary-list {
            height: 224px;
            overflow: auto;
            padding-bottom: 8px;
            margin-top: 20px;
            margin-bottom: 13px;
            border-style: none;
            border-bottom: solid 1px #d2d2d2;
        }


        .footerdiv{
            text-align: right;
            border-style: none;
            border-top: solid 1px #d2d2d2;
            padding-top: 20px;
        }
        table thead tr th label span{
            color: black;
        }
        table tbody tr td label span{
            color: black;
        }
    </style>

</head>
<body>
<div class="container">
    <div class="col s12 tithead"><center>Multi Files Download in Laravel Using <span style="color:orange" >Jquery .promise()</span> method</center></div>
    <div class="row" style="padding-top:80px">

        <div class="col s12 title">
            Choose the download you want
        </div>
        <div class="col s12" >
            <table>
                <thead>
                <tr>
                    <th>
                        <label>
                            <input type="checkbox" id="all_Chk"/>
                            <span>File Name</span>

                        </label>
                    </th>

                    <th>Size</th>
                </tr>
                </thead>

                <tbody>


                @foreach($downloads as $dw)

                
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" class="indi_chk" name="filedata[]" value="{{$dw->file_name}}"><span>{{$dw->file_title}}</span>
                        </label>
                    </td>
                    <td class="siz_file">{{$dw->file_size}}</td>
                </tr>

                @endforeach
               
               
                </tbody>
            </table>
        </div>
       
    </div>

    <div class="row footerdiv">
        <button disabled class="btn waves-effect waves-light final_sub" name="action">Download

        </button>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript">
    var g_arr;
    $('#all_Chk').on('change',function(){

       //Return the value of a property:
       //$(selector).prop(property)
//        $(this) refers to current
       console.log($(this).prop('checked'));

//        Set the property and value:
//        $(selector).prop(property,value)
       $('.indi_chk').prop('checked',$(this).prop('checked'));

       
     enablebutton();
   });

    $('.indi_chk').on('change',function(){
       
       if(false==$(this).prop('checked')){
           $('#all_Chk').prop('checked',false);

       }


       if($('.indi_chk:checked').length==$('.indi_chk').length){
           $('#all_Chk').prop('checked',true);

       }

       enablebutton();

   });

    function enablebutton(){
        var i=1;
        $('.indi_chk:checked').each(function(){
            i++;
        });

        if(i==1){
            $('button').prop('disabled',true);

        }else{
            $('button').prop('disabled',false);

        }
    }

    //download
    var func1 = function(){
       var deferred = $.Deferred();
       window.setTimeout(function(){

           var r_path=g_arr[0];
           console.log(r_path);
           window.location.href='{!! URL::to('postDownload') !!}'+'?urlpath='+r_path;

           deferred.resolve();
       }, 1000);

       return deferred.promise();
   }
   var func2 = function(){
       var deferred = $.Deferred();
       window.setTimeout(function(){

           var r_path=g_arr[1];
           console.log(r_path);
           window.location.href='{!! URL::to('postDownload') !!}'+'?urlpath='+r_path;

           deferred.resolve();
       }, 1000);

       return deferred.promise();
   }
   var func3 = function(){
       var deferred = $.Deferred();
       window.setTimeout(function(){

           var r_path=g_arr[2];
           console.log(r_path);
           window.location.href='{!! URL::to('postDownload') !!}'+'?urlpath='+r_path;

           deferred.resolve();
       }, 1000);

       return deferred.promise();
   }


    $('.final_sub').on('click',function () {

        var i=1;
        g_arr=[];

        $('.indi_chk:checked').each(function(){
            g_arr.push($(this).val());
            i++;
        });
        // i=3
        // g_rr=['abc.pdf','fhdsh.txt']

        var j=i-1;
        if(j==1){
            func1();
           
       }else if(j==2){
          func1().then(func2);
       }else if(j==3){
          func1().then(func2).then(func3);
       }




    });


</script>

</body>
</html>

