<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<html>
    <form action="<?php echo base_url("/index.php/pub/redeem_process"); ?>" method="post" accept-charset="ISO-8859-1">
        <p>SteamID:<br><input id="steamid" name="steamid" placeholder="STEAM_0:1:0000000"  size="40"></p>
        <p>Redeem Code:<br><input  name="redeem_code" placeholder="The Code you have got" size="40"></p>
        <p><input id="name" name="name" disabled placeholder="Name got from steam" size="40"></p>
        <p><img id="steamid-avatar" width="50" height="50" src="<?php echo base_url("/assets/img/id_cache/avatar.jpg"); ?>"></p>
        <input type="submit">
    </form>
</html>


<script>
    $("#steamid").focus(function() {
        console.log('in');
    }).blur(function(){
        console.log('out');
        console.log($(this).val());
        sendValue($(this).val());
        refresh_img($(this).val());

        function sendValue(str){
            // $.post("php/get_image.php",{ sendValue: str },
            $('#steamid-avatar').fadeOut(500);
            $.post("<?php echo base_url("/index.php/pub/get_img"); ?>",{ sendValue: str },

            function(data){
                $('#steamid-avatar').wrap("<a target='_blank' class='generated_link' href='"+data.player_url+"'></a>");
                $('#steamid-avatar').fadeIn(500).attr('src', ''+data.returnValue+'');
                $('#name').attr('value', ''+data.playerName+'');
                console.log(data);
            }, "json");
        }
        function refresh_img(str){
            $.post("<?php echo base_url("/index.php/pub/refresh_img"); ?>",{ sendValue: str });
        }
    }
);
</script>