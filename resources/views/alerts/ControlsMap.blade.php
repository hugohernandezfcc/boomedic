<div class="direct-chat">
            <div id="rangothree">
                <div class="btn-group-vertical">
                    <a class="btn btn-default btn-flat" onclick="initMap();">
                        <b><span class="fa fa-crosshairs"></span></b>
                    </a>
                    <a class="btn btn-default btn-flat" data-widget="chat-pane-toggle" onclick="if($('#fap').hasClass('fa-arrow-circle-left')){$('#fap').removeClass('fa-arrow-circle-left'); $('#fap').addClass('fa-arrow-circle-right'); }else{ $('#fap').removeClass('fa-arrow-circle-right');$('#fap').addClass('fa-arrow-circle-left'); }">
                        <b><span class="fa fa-arrow-circle-left" id="fap"></span></b>
                    </a>
                </div>
            </div>

            <div class="direct-chat-contacts">
                <div id="rango">   
                    <div class="btn-group">
                        <button class="btn btn-default" onclick="showMy();"><b><span id="labelextra"></span></b></button>
                        <button class="btn btn-default" data-toggle="modal" data-target="#modalrango" id="rang"><b><span class="fa fa-dot-circle-o"></span> <span id="rango04"></span> km</b></button>             
                        <button class="btn btn-default" data-toggle="modal" data-target="#modal"><span class="fa fa-map-signs"></span></button>
                        <button class="btn btn-default" data-toggle="modal" data-target="#modaloksearch">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>