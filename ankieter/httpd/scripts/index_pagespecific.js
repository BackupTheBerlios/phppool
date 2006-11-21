$(document).ready(function() {

                $('#container-1').tabs({fxFade: true, fxAutoHeight: true});
                $('#container-2').tabs({fxFade: true, fxAutoHeight: true});
                
                $('#trigger-tab').after('<p><a href="#" onclick="$(\'#container-1\').triggerTab(3); return false;">Activate third tab</a></p>');
});