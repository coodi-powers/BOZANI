<h1>Welcome to the chat</h1>

<div class="row">
    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="widget">
            <div class="widget-header">
                <div class="title">
                    Chat met Bart Bollen
                </div>
            </div>
            <div class="widget-body messagesbox">
                <ul class="messages-list clearfix">
                    <li class="own_balloon">Are we meeting today?</li>
                    <li class="other_balloon">Yes, what time suits you?</li>
                    <li class="other_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="own_balloon">Are we meeting today?</li>
                    <li class="own_balloon">Are we meeting today?</li>
                    <li class="other_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="own_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="other_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="own_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="other_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="own_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                    <li class="other_balloon">I was thinking after lunch, I have a meeting in the morning</li>
                </ul>
            </div>
            <div class="widget-header">
                <div class="title">
                    Chat met Bart Bollen
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var $cont = $('.messagesbox');
    $cont[0].scrollTop = $cont[0].scrollHeight;

    $('.inp').keyup(function(e) {
        if (e.keyCode == 13) {
            $cont.append('<p>' + $(this).val() + '</p>');
            $cont[0].scrollTop = $cont[0].scrollHeight;
            $(this).val('');
        }
    })
        .focus();

</script>