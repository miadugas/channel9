<?php
include_once("includes/header.php");
?>
<div class="textboxContainer">
    <input type="text" class="searchInput" placeholder="Would you like to search for something?">
</div>

<div class="results"></div>

<!-- Search after small pause -->
<script>

 $(function() {
    // get user
     var username = '<?php echo $userLoggedIn; ?>';
     var timer;

    $(".searchInput").keyup(function() {
        clearTimeout(timer);

         timer = setTimeout(function() {
             var val = $(".searchInput").val();
            
            if(val != "") {
                $.post("ajax/getSearchResults.php", { term: val, username: username }, function(data) {
                    $(".results").html(data);
                })
            }
            else {
                $(".results").html("");
            }

         }, 500);
     })

 })

</script>