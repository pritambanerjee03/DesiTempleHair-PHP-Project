<?php include('includes/header.php');
      $searchKeyword = $_POST['search'];
?>
<div class="container1 submenushadow"></div>

    <section class="hblock anim-block skincare topimage">

    

    <div class="cantainer skincarebundles">
        <h3 class="hb-head"></h3>
        <div class="hb-inner fprod clearfix">
            
                 <div class="row" id="searchList">
                   </div> 
            
        </div>
    </div>
</section>
<script type="text/javascript">
      function loadData(page, Keyword){
            loading_show();                   
            $.ajax
            ({
                type: "POST",
                url: "ajxHandler.php",
                data: "action=getProductsBySearch&page="+page+"&Keyword="+Keyword,
                success: function(msg)
                {                                
                      loading_hide();
                      $("#searchList").html(msg);  
                      $('html, body').animate({scrollTop:0}, 'slow');                                
                }
            });
        }
        function loading_show(){
            $('#loading').html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
        }
        function loading_hide(){
            $('#loading').fadeOut('fast');
        }   
      $( document ).ready(function() {
        
        loadData(1, '<?=$searchKeyword?>');  // For first time page load default results
       // $('#container .pagination li.active').live('click',function(){
        $('#searchList').on('click', '.pagination li.active', function(){
            var page = $(this).attr('p');
            loadData(page, '<?=$searchKeyword?>');
            
        }); 
      });
</script>
<?php include('includes/footer.php');?> 